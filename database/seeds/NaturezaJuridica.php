<?php

use Illuminate\Database\Seeder;

class NaturezaJuridica extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('natureza_juridicas')->insert (
            array(
                array('cod_natureza_juridica'=>'101-5','natureza_juridica'=>'Órgão Público do Poder Executivo Federal','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'102-3','natureza_juridica'=>'Órgão Público do Poder Executivo Estadual ou do Distrito Federal','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'103-1','natureza_juridica'=>'Órgão Público do Poder Executivo Municipal','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'104-0','natureza_juridica'=>'Órgão Público do Poder Legislativo Federal','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'105-8','natureza_juridica'=>'Órgão Público do Poder Legislativo Estadual ou do Distrito Federal','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'106-6','natureza_juridica'=>'Órgão Público do Poder Legislativo Municipal','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'107-4','natureza_juridica'=>'Órgão Público do Poder Judiciário Federal','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'108-2','natureza_juridica'=>'Órgão Público do Poder Judiciário Estadual','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'110-4','natureza_juridica'=>'Autarquia Federal','representante'=>'Administrador ou Presidente','qualificacao'=>'05 ou 16'),
                array('cod_natureza_juridica'=>'111-2','natureza_juridica'=>'Autarquia Estadual ou do Distrito Federal','representante'=>'Administrador ou Presidente','qualificacao'=>'05 ou 16'),
                array('cod_natureza_juridica'=>'112-0','natureza_juridica'=>'Autarquia Municipal','representante'=>'Administrador ou Presidente','qualificacao'=>'05 ou 16'),
                array('cod_natureza_juridica'=>'113-9','natureza_juridica'=>'Fundação Federal','representante'=>'Presidente','qualificacao'=>'16'),
                array('cod_natureza_juridica'=>'114-7','natureza_juridica'=>'Fundação Estadual ou do Distrito Federal','representante'=>'Presidente','qualificacao'=>'16'),
                array('cod_natureza_juridica'=>'115-5','natureza_juridica'=>'Fundação Municipal','representante'=>'Presidente','qualificacao'=>'16'),
                array('cod_natureza_juridica'=>'116-3','natureza_juridica'=>'Órgão Público Autônomo Federal','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'117-1','natureza_juridica'=>'Órgão Público Autônomo Estadual ou do Distrito Federal','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'118-0','natureza_juridica'=>'Órgão Público Autônomo Municipal','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'119-8','natureza_juridica'=>'Comissão Polinacional','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'120-1','natureza_juridica'=>'Fundo Público','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'121-0','natureza_juridica'=>'Associação Pública','representante'=>'Presidente','qualificacao'=>'16'),
                array('cod_natureza_juridica'=>'201-1','natureza_juridica'=>'Empresa Pública','representante'=>'Administrador, Diretor ou Presidente','qualificacao'=>'05, 10 ou 16'),
                array('cod_natureza_juridica'=>'203-8','natureza_juridica'=>'Sociedade de Economia Mista','representante'=>'Diretor ou Presidente','qualificacao'=>'10 ou 16'),
                array('cod_natureza_juridica'=>'204-6','natureza_juridica'=>'Sociedade Anônima Aberta','representante'=>'Administrador, Diretor ou Presidente','qualificacao'=>'05, 10 ou 16'),
                array('cod_natureza_juridica'=>'205-4','natureza_juridica'=>'Sociedade Anônima Fechada','representante'=>'Administrador, Diretor ou Presidente','qualificacao'=>'05, 10 ou 16'),
                array('cod_natureza_juridica'=>'206-2','natureza_juridica'=>'Sociedade Empresária Limitada','representante'=>'Administrador ou Sócio-Administrador','qualificacao'=>'05 ou 49'),
                array('cod_natureza_juridica'=>'207-0','natureza_juridica'=>'Sociedade Empresária em Nome Coletivo','representante'=>'Sócio-Administrador','qualificacao'=>'49'),
                array('cod_natureza_juridica'=>'208-9','natureza_juridica'=>'Sociedade Empresária em Comandita Simples','representante'=>'Sócio Comanditado','qualificacao'=>'24'),
                array('cod_natureza_juridica'=>'209-7','natureza_juridica'=>'Sociedade Empresária em Comandita por Ações','representante'=>'Diretor ou Presidente','qualificacao'=>'10 ou 16'),
                array('cod_natureza_juridica'=>'212-7','natureza_juridica'=>'Sociedade em Conta de Participação','representante'=>'Procurador ou Sócio Ostensivo','qualificacao'=>'17 ou 31'),
                array('cod_natureza_juridica'=>'213-5','natureza_juridica'=>'Empresário (Individual)','representante'=>'Empresário','qualificacao'=>'50'),
                array('cod_natureza_juridica'=>'214-3','natureza_juridica'=>'Cooperativa','representante'=>'Diretor ou Presidente','qualificacao'=>'10 ou 16'),
                array('cod_natureza_juridica'=>'215-1','natureza_juridica'=>'Consórcio de Sociedades','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'216-0','natureza_juridica'=>'Grupo de Sociedades','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'217-8','natureza_juridica'=>'Estabelecimento, no Brasil, de Sociedade Estrangeira','representante'=>'Procurador','qualificacao'=>'17'),
                array('cod_natureza_juridica'=>'219-4','natureza_juridica'=>'Estabelecimento, no Brasil, de Empresa Binacional Argentino-Brasileira','representante'=>'Procurador','qualificacao'=>'17'),
                array('cod_natureza_juridica'=>'221-6','natureza_juridica'=>'Empresa Domiciliada no Exterior','representante'=>'Procurador','qualificacao'=>'17'),
                array('cod_natureza_juridica'=>'222-4','natureza_juridica'=>'Clube/Fundo de Investimento','representante'=>'Responsável','qualificacao'=>'43'),
                array('cod_natureza_juridica'=>'223-2','natureza_juridica'=>'Sociedade Simples Pura','representante'=>'Administrador ou Sócio-Administrador','qualificacao'=>'05 ou 49'),
                array('cod_natureza_juridica'=>'224-0','natureza_juridica'=>'Sociedade Simples Limitada','representante'=>'Administrador ou Sócio-Administrador','qualificacao'=>'05 ou 49'),
                array('cod_natureza_juridica'=>'225-9','natureza_juridica'=>'Sociedade Simples em Nome Coletivo','representante'=>'Sócio-Administrador','qualificacao'=>'49'),
                array('cod_natureza_juridica'=>'226-7','natureza_juridica'=>'Sociedade Simples em Comandita Simples','representante'=>'Sócio Comanditado','qualificacao'=>'24'),
                array('cod_natureza_juridica'=>'227-5','natureza_juridica'=>'Empresa Binacional','representante'=>'Diretor','qualificacao'=>'10'),
                array('cod_natureza_juridica'=>'228-3','natureza_juridica'=>'Consórcio de Empregadores','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'229-1','natureza_juridica'=>'Consórcio Simples','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'230-5','natureza_juridica'=>'Empresa Individual de Responsabilidade Limitada (de Natureza Empresária)','representante'=>'Administrador, Procurador ou Titular Pessoa Física Residente ou Domiciliado no Brasil','qualificacao'=>'05, 17 ou 65'),
                array('cod_natureza_juridica'=>'231-3','natureza_juridica'=>'Empresa Individual de Responsabilidade Limitada (de Natureza Simples)','representante'=>'Administrador, Procurador ou Titular Pessoa Física Residente ou Domiciliado no Brasil','qualificacao'=>'05,17 ou 65'),
                array('cod_natureza_juridica'=>'303-4','natureza_juridica'=>'Serviço Notarial e Registral (Cartório)','representante'=>'Tabelião ou Oficial de Registro','qualificacao'=>'32 ou 42'),
                array('cod_natureza_juridica'=>'306-9','natureza_juridica'=>'Fundação Privada','representante'=>'Administrador, Diretor, Presidente ou Fundador','qualificacao'=>'05, 10, 16 ou 5'),
                array('cod_natureza_juridica'=>'307-7','natureza_juridica'=>'Serviço Social Autônomo','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'308-5','natureza_juridica'=>'Condomínio Edilício','representante'=>'Administrador ou Síndico (Condomínio)','qualificacao'=>'05 ou 19'),
                array('cod_natureza_juridica'=>'310-7','natureza_juridica'=>'Comissão de Conciliação Prévia','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'311-5','natureza_juridica'=>'Entidade de Mediação e Arbitragem','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'312-3','natureza_juridica'=>'Partido Político','representante'=>'Administrador ou Presidente','qualificacao'=>'05 ou 16'),
                array('cod_natureza_juridica'=>'313-1','natureza_juridica'=>'Entidade Sindical','representante'=>'Administrador ou Presidente','qualificacao'=>'05 ou 16'),
                array('cod_natureza_juridica'=>'320-4','natureza_juridica'=>'Estabelecimento, no Brasil, de Fundação ou Associação Estrangeiras','representante'=>'Procurador','qualificacao'=>'17'),
                array('cod_natureza_juridica'=>'321-2','natureza_juridica'=>'Fundação ou Associação domiciliada no exterior','representante'=>'Procurador','qualificacao'=>'17'),
                array('cod_natureza_juridica'=>'322-0','natureza_juridica'=>'Organização Religiosa','representante'=>'Administrador, Diretor ou Presidente','qualificacao'=>'05, 10 ou 16'),
                array('cod_natureza_juridica'=>'323-9','natureza_juridica'=>'Comunidade Indígena','representante'=>'Responsável Indígena','qualificacao'=>'61'),
                array('cod_natureza_juridica'=>'324-7','natureza_juridica'=>'Fundo Privado','representante'=>'Administrador','qualificacao'=>'5'),
                array('cod_natureza_juridica'=>'399-9','natureza_juridica'=>'Associação Privada','representante'=>'Administrador, Diretor ou Presidente','qualificacao'=>'05, 10 ou 16'),
                array('cod_natureza_juridica'=>'401-4','natureza_juridica'=>'Empresa Individual Imobiliária','representante'=>'Titular','qualificacao'=>'34'),
                array('cod_natureza_juridica'=>'408-1','natureza_juridica'=>'Contribuinte Individual','representante'=>'Produtor Rural','qualificacao'=>'59'),
                array('cod_natureza_juridica'=>'409-0','natureza_juridica'=>'Candidato a Cargo Político Eletivo','representante'=>'Candidato a Cargo Político Eletivo','qualificacao'=>'51'),
                array('cod_natureza_juridica'=>'501-0','natureza_juridica'=>'Organização Internacional','representante'=>'Representante de Organização Internacional','qualificacao'=>'41'),
                array('cod_natureza_juridica'=>'502-9','natureza_juridica'=>'Representação Diplomática Estrangeira','representante'=>'Diplomata, Cônsul, Ministro de Estado das Relações Exteriores ou Cônsul Honorário','qualificacao'=>'39, 40, 46 ou 60'),
                array('cod_natureza_juridica'=>'503-7','natureza_juridica'=>'Outras Instituições Extraterritoriais','representante'=>'Representante da Instituição Extraterritorial','qualificacao'=>'62')
            )
        );
    }
}
