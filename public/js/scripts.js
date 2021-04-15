function deletarRegistroPerfil(valor, perfil) {
    if (confirm("Deseja excluir o perfil " + perfil + "?")) {
        $.ajax({
            type: 'GET',
            url: '/admin/perfil/deletar/' + valor,
            success: function (e) {
                if (e.status == 'false') {
                    alert(e.msg);
                } else {
                    alert(e.msg);
                    document.location.reload(true);
                }
            }
        });
    }
}

function deletarRegistroCidade(valor, cidade) {
    if (confirm("Deseja excluir a cidade " + cidade + "?")) {
        $.ajax({
            type: 'GET',
            url: '/admin/cidades/deletar/' + valor,
            success: function (e) {
                if (e.status == 'false') {
                    alert(e.msg);
                } else {
                    alert(e.msg);
                    document.location.reload(true);

                }
            }
        });
    }
}

function validarCNPJ(cnpj) {

    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '') return false;

    if (cnpj.length != 14)
        return false;

    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;

    return true;

}

$(document).ready(function () {

    $(".celular").mask("(99) 9999-9999?9");
    $(".celular").blur(function (event) {
        if ($(this).val().length == 15) {
            $('.celular').mask('(99) 99999-999?9');
        } else {
            $('.celular').mask('(99) 9999-9999?9');
        }
    });

    $(".telefone").mask("(99) 9999-9999");
    $(".telefone").blur(function (event) {
        if ($(this).val().length == 15) {
            $('.telefone').mask('(99) 9999-9999');
        } else {
            $('.telefone').mask('(99) 9999-9999');
        }
    });

    $('.cnpj').mask("99.999.999/9999-99");


    $(".cpf").mask("999.999.999-99");
    $('.cpf').blur(function () {
        var cpf = $('.cpf').val().replace(/[^0-9]/g, '').toString();

        if (cpf.length == 11) {

            var v = [];

            //Calcula o primeiro dígito de verificação.
            v[0] = 1 * cpf[0] + 2 * cpf[1] + 3 * cpf[2];
            v[0] += 4 * cpf[3] + 5 * cpf[4] + 6 * cpf[5];
            v[0] += 7 * cpf[6] + 8 * cpf[7] + 9 * cpf[8];
            v[0] = v[0] % 11;
            v[0] = v[0] % 10;

            //Calcula o segundo dígito de verificação.
            v[1] = 1 * cpf[1] + 2 * cpf[2] + 3 * cpf[3];
            v[1] += 4 * cpf[4] + 5 * cpf[5] + 6 * cpf[6];
            v[1] += 7 * cpf[7] + 8 * cpf[8] + 9 * v[0];
            v[1] = v[1] % 11;
            v[1] = v[1] % 10;

            //Retorna Verdadeiro se os dígitos de verificação são os esperados.
            if ((v[0] != cpf[9]) || (v[1] != cpf[10])) {
                alert('CPF inválido : ' + cpf);
                //$('.cpf').val('');
                //$('.cpf').focus();
            } else {
                $.ajax({
                    type: 'GET',
                    url: '/admin/pessoafisica/verificarcpfexistente/' + $('.cpf').val(),
                    success: function (e) {
                        $.each(e, function (index, retorno) {
                            if (retorno.status == 'false') {
                                alert(retorno.msg);
                            }
                        })
                        if (e.status == 'false') {
                            alert(e.msg);
                        }
                    }
                });
            }
        } else {
            alert('CPF inválido: 2' + cpf);
            //$('.cpf').focus();
        }
    });


    $(".cep").mask("99.999-999");


    $('.estado').change(function () {
        let id = $(this).val();
        //alert(id);
        let option = '';
        $.ajax({
            type: 'GET',
            url: '/admin/estados/visualizarmunicipios/' + id,
            success: function (e) {
                $.each(e, function (index, retorno) {
                    console.log(index + ' : ' + retorno.cidade);
                    option = option + '<option value="' + retorno.id_cidade + '">' + retorno.cidade + '</option>';
                    $('.cidade').html(option);
                });
            }
        });
    });

    $('#adicionarCidade').click(function () {
        let cidade = $('#cidade').val();
        let id_estado = $('#id_estado').val();
        let ibge = $('#ibge').val();
        let ddd = $('.ddd').val();
        $.ajax({
            type: 'POST',
            url: '/admin/cidades/inserir',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { _token: $('meta[name="csrf-token"]').attr('content'), cidade: cidade, id_estado: id_estado, ibge: ibge, ddd: ddd },
            success: function (e) {
                if (e.tipo == 'false') {
                    //alert(e.tipo);
                    $('#resultadoCidade').html(e.msg);
                } else {
                    $('#resultadoCidade').html(e.msg);
                }

            }
        });
    });

    $('#adicionarServico').click(function () {

        let descricao = $('#descricao_servico').val();
        let preco = $('#preco_servico').val();
        let unidade = $('#unidade_servico').val();
        let ativo = $('#ativo_servico').prop('checked');

        $.ajax({
            type: 'POST',
            url: '/admin/servicos/inserir',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { _token: $('meta[name="csrf-token"]').attr('content'), descricao: descricao, preco: preco, unidade: unidade, ativo: ativo },
            success: function (e) {
                $('#resultadoServico').html(e.msg);
                /* if (e.tipo == 'true') {
                     $('#resultadoServico').html(e.msg);
                 } else {
                     $('#resultadoServico').html(e.msg);
                 }*/
            }
        });
    });


    $('#adicionarProduto').click(function () {

        let descricao = $('#descricao_produto').val();
        let preco = $('#preco_produto').val();
        let unidade = $('#unidade_produto').val();
        let ativo = $('#ativo_produto').prop('checked');

        $.ajax({
            type: 'POST',
            url: '/admin/produtos/inserir',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: { _token: $('meta[name="csrf-token"]').attr('content'), descricao: descricao, preco: preco, unidade: unidade, ativo: ativo },
            success: function (e) {
                $('#resultadoProduto').html(e.msg);
                /* if (e.tipo == 'true') {
                     $('#resultadoProduto').html(e.msg);
                 } else {
                     $('#resultadoProduto').html(e.msg);
                 }*/
            }
        });
    });


    $('#adicionarPF').click(function () {
        let nome = $('#nome-pf').val();
        let dtnascimento = $('#dtnascimento-pf').val();
        let cpf = $('#cpf-pf').val();
        let rg = $('#rg-pf').val();
        let orgaoexpedidor = $('#orgaoexpedidor-pf').val();
        let sexo = $('#sexo-pf').val();
        let telefone = $('#telefone-pf').val();
        let celular = $('#celular-pf').val();
        let email = $('#email-pf').val();
        let id_estado = $('#estado-pf').val();
        let id_cidade = $('#cidade-pf').val();
        let cep = $('#cep-pf').val();
        let endereco = $('#endereco-pf').val();
        let numero = $('#numero-pf').val();
        let bairro = $('#bairro-pf').val();
        let cliente = $('#cliente-pf').prop('checked');
        let fornecedor = $('#fornecedor-pf').prop('checked');
        let complemento = $('#complemento-pf').val();

        $.ajax({
            type: 'POST',
            url: '/admin/pessoafisica/inserir',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), nome: nome, dtnascimento: dtnascimento,
                cpf: cpf, sexo: sexo, rg: rg, orgaoexpedidor: orgaoexpedidor, email: email, id_cidade: id_cidade, cep: cep, endereco: endereco, numero: numero, complemento: complemento, bairro: bairro, telefone: telefone, celular: celular,
                fornecedor: fornecedor, cliente: cliente
            },
            success: function (e) {
                //alert(e.teste);
                $('#resultadoPF').html(e.msg);
                /* if (e.tipo == 'true') {
                     $('#resultadoServico').html(e.msg);
                 } else {
                     $('#resultadoServico').html(e.msg);
                 }*/
            }
        });
    });

    $('#adicionarPJ').click(function () {
        let razao_social = $('#razao_socail-pj').val();
        let fantasia = $('#fantasia-pj').val();
        let cnpj = $('#cnpj-pj').val();
        let data_abertura = $('#data_abertura-pj').val();
        let cod_natureza_juridica = $('#cod_natureza_juridica-pj').val();
        let telefone = $('#telefone-pj').val();
        let celular = $('#celular-pj').val();
        let email = $('#email-pj').val();
        let id_estado = $('#estado-pj').val();
        let id_cidade = $('#cidade-pj').val();
        let cep = $('#cep-pj').val();
        let endereco = $('#endereco-pj').val();
        let numero = $('#numero-pj').val();
        let bairro = $('#bairro-pj').val();
        let cliente = $('#cliente-pj').prop('checked');
        let fornecedor = $('#fornecedor-pj').prop('checked');
        let complemento = $('#complemento-pj').val();
        $.ajax({
            type: 'post',
            url: '/admin/pessoajuridica/inserir',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), razao_social: razao_social, fantasia: fantasia, cnpj: cnpj, data_abertura: data_abertura,
                cod_natureza_juridica: cod_natureza_juridica, telefone: telefone, celular: celular, email: email, id_estado: id_estado, id_cidade: id_cidade, cep: cep, endereco: endereco, numero: numero, bairro: bairro,
                cliente: cliente, fornecedor: fornecedor, complemento: complemento
            },
            success: function (e) {
                $('#resultadoPJ').html(e.msg);
            }
        });
    });

    $('#adicionarPerfil').click(function () {
        let descricao = $('#descricao-pl').val();
        let ativo = $('#ativo-pl').prop('checked');
        let admin = $('#admin-pl').prop('checked');
        $.ajax({
            type: 'post',
            url: '/admin/perfil/inserir',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), descricao: descricao, ativo: ativo, admin: admin
            },
            success: function (e) {
                $('#resultadoPerfil').html(e.msg);
            }
        });
    });

    $('#adicionarVeiculo').click(function () {

        let id_cliente = $('#id_cliente').val();
        let descricao_veiculo = $('#descricao_veiculo').val();
        let modelo = $('#modelo').val();
        let fabricante = $('#fabricante').val();
        let placa = $('#placa').val();
        let ano = $('#ano').val();
        let fabricacao = $('#fabricacao').val();
        let cor = $('#cor').val()
        let observacao = $('#observacao').val();

        $.ajax({
            type: 'post',
            url: '/admin/veiculos/inserir',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), descricao_veiculo: descricao_veiculo, modelo: modelo, fabricante: fabricante,
                placa: placa, ano: ano, fabricacao: fabricacao, cor: cor, observacao: observacao, id_cliente: id_cliente
            },
            success: function (e) {
                $('#resultadoVeiculo').html(e.msg);

            }
        });
    });

    $('#atualizarVeiculo').click(function(){
        let id_cliente = $('#id_cliente').val();
        let descricao_veiculo = $('#descricao_veiculo').val();
        let modelo = $('#modelo').val();
        let fabricante = $('#fabricante').val();
        let placa = $('#placa').val();
        let ano = $('#ano').val();
        let fabricacao = $('#fabricacao').val();
        let cor = $('#cor').val()
        let observacao = $('#observacao').val();
        let id_veiculo = $('#veiculo').val();
        let metodo = $('#metodo').val();

        $.ajax({
            type: 'put',
            url: '/admin/veiculos/atualizar/',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), id_veiculo: id_veiculo, descricao_veiculo: descricao_veiculo, modelo: modelo, fabricante: fabricante,
                placa: placa, ano: ano, fabricacao: fabricacao, cor: cor, observacao: observacao, id_cliente: id_cliente, metodo: metodo
            },
            success: function (e) {
                $('#resultadoVeiculo').html(e);
            }

        });
    });

    $('#salvarOrcamento').click(function () {
        let id_orcamento = $('#id_orcamento').val();
        var rowCount = $('#resultado_itemorcamento').find('tr').length;
        if (rowCount <= 1) {
            alert('Erro ao salvar o orçamento! Verificar a quantidade de itens');
        } else {
            $.ajax({
                type: 'post',
                url: '/admin/orcamento/salvar/',
                header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), salve: 1, id_orcamento: id_orcamento
                },
                success: function (e) {
                    alert('Orçamento salvo com sucesso');
                    window.location.reload();
                }
            });
        }
    });

    $('#aprovarOrcamento').click(function () {
        let id_orcamento = $('#id_orcamento').val();
        var rowCount = $('#resultado_itemorcamento').find('tr').length;
        if (rowCount <= 1) {
            alert('Erro ao aprovar o orçamento! Verificar a quantidade de itens');
        } else {
            $.ajax({
                type: 'post',
                url: '/admin/orcamento/aprovar/',
                header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), id_orcamento: id_orcamento
                },
                success: function (e) {
                    alert('Orçamento aprovado com sucesso');
                    window.location.reload();
                }
            });
        }
    });

    $('#cancelarOrcamento').click(function () {
        let id_orcamento = $('#id_orcamento').val();
        $.ajax({
            type: 'post',
            url: '/admin/orcamento/cancelar/',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), id_orcamento: id_orcamento
            },
            success: function (e) {
                alert('Orçamento cancelado');
                window.location.reload();
            }
        });

    });


    $('#adicionarUsuario').click(function () {
        let name = $('#name').val();
        let perfil = $('#perfil').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let ativo = $('#ativo').prop('checked');

        $.ajax({
            type: 'post',
            url: '/admin/user/inserir/',
            header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'), name: name, perfil: perfil, email: email, ativo: ativo, password: password
            },
            success: function (e) {
                $('#resultadoUsuario').html(e.msg);
            }
        });
    });


})
