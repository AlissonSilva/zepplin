create or replace
algorithm = UNDEFINED view `vw_clientes` as
select
    `c`.`id_cliente` as `id_cliente`,
    case
        when `pf`.`nome` is null then `pj`.`razao_social`
        else `pf`.`nome`
    end as `nome`,
    case
        when `pf`.`cpf` is null then `pj`.`cnpj`
        else `pf`.`cpf`
    end as `documento`,
    (
    select
        count(0)
    from
        `orcamentos` `o2`
    where
        `o2`.`id_cliente` = `c`.`id_cliente`) as `count_orcamento`
from
    ((`clientes` `c`
left join `pessoa_fisicas` `pf` on
    (`c`.`id_pessoa_fisica` = `pf`.`id_pessoa_fisica`))
left join `pessoa_juridicas` `pj` on
    (`c`.`id_pessoa_juridica` = `pj`.`id_pessoa_juridica`))
where
    exists(
    select
        1
    from
        `veiculos` `v`
    where
        `v`.`id_cliente` = `c`.`id_cliente`
    limit 1)
;

create or replace
algorithm = UNDEFINED view `vw_item_orcamento` as
select
    `oi`.`id_orcamento_item` as `id_orcamento_item`,
    `oi`.`id_orcamento` as `id_orcamento`,
    `p2`.`id_produto` as `cod_item`,
    `p2`.`descricao` as `descricao`,
    `p2`.`unidade` as `unidade`,
    `p2`.`preco` as `valor_unitario`,
    `oi`.`quantidade` as `quantidade`,
    `oi`.`valor_desconto` as `valor_desconto`,
    `oi`.`percentual_desconto` as `percentual_desconto`,
    `oi`.`valor_total` as `valor_total`
from
    (`orcamento_items` `oi`
join `produtos` `p2` on
    (`oi`.`id_produto` = `p2`.`id_produto`))
union all
select
    `oi2`.`id_orcamento_item` as `id_orcamento_item`,
    `oi2`.`id_orcamento` as `id_orcamento`,
    `s2`.`id_servico` as `cod_item`,
    `s2`.`descricao` as `descricao`,
    `s2`.`unidade` as `unidade`,
    `s2`.`preco` as `valor_unitario`,
    `oi2`.`quantidade` as `quantidade`,
    `oi2`.`valor_desconto` as `valor_desconto`,
    `oi2`.`percentual_desconto` as `percentual_desconto`,
    `oi2`.`valor_total` as `valor_total`
from
    (`orcamento_items` `oi2`
join `servicos` `s2` on
    (`oi2`.`id_servico` = `s2`.`id_servico`));


create or replace
algorithm = UNDEFINED view `vw_dashboard_one` as
select
    sum(case when `o`.`status_orcamento` = 'aberto' then 1 else 0 end) as `quantidade_aberta`,
    sum(case when `o`.`status_orcamento` = 'cancelado' then 1 else 0 end) as `quantidade_cancelado`,
    sum(case when `o`.`status_orcamento` = 'aprovado' then 1 else 0 end) as `quantidade_aprovado`,
    sum(case when `o`.`status_orcamento` = 'aberto' then `o`.`valor_total` else 0 end) as `valor_em_aberto`,
    sum(case when `o`.`status_orcamento` = 'aprovado' then `o`.`valor_total` else 0 end) as `valor_recebido`
from
    `orcamentos` `o`;

create or replace
algorithm = UNDEFINED view `vw_itens` as
select
    `p`.`id_produto` as `id_produto`,
    `p`.`descricao` as `descricao`,
    `p`.`unidade` as `unidade`,
    `p`.`preco` as `preco`,
    `p`.`ativo` as `ativo`,
    `p`.`estoque` as `estoque`,
    'produto' as `tipo`
from
    `produtos` `p`
union all
select
    `s`.`id_servico` as `id_servico`,
    `s`.`descricao` as `descricao`,
    `s`.`unidade` as `unidade`,
    `s`.`preco` as `preco`,
    `s`.`ativo` as `ativo`,
    1 as `estoque`,
    'servico' as `tipo`
from
    `servicos` `s`;


create or replace
algorithm = UNDEFINED view `vw_orcamento_qtd_item` as
select
    `oi`.`id_orcamento` as `id_orcamento`,
    sum(`oi`.`quantidade`) as `total`
from
    `orcamento_items` `oi`
group by
    `oi`.`id_orcamento`;

create or replace
algorithm = UNDEFINED view `vw_forma_pagamento` as
select
    `p`.`id_pagamento` as `id_pagamento`,
    `p`.`descricao` as `forma_pagamento`,
    `a`.`id_agente` as `id_agente`,
    `p`.`numero_parcelas` as `numero_parcelas`,
    `p`.`intervalo_parcelas` as `intervalo_parcelas`,
    `b`.`id_banco` as `id_banco`
from
    ((`pagamentos` `p`
join `agentes` `a` on
    (`p`.`id_agente` = `a`.`id_agente`))
join `bancos` `b` on
    (`a`.`id_banco` = `b`.`id_banco`))
where
    `p`.`status_pagamento` = 1;
	
	
DELIMITER $$
create or replace trigger tg_orcamento_item after insert 
ON orcamento_items FOR EACH ROW
begin
	declare valor_desconto_tg float;
	declare percentual_desconto_tg float;
	declare valor_total_sem_desconto_tg float;
	declare valor_total_tg float;
	declare quantidade int;
	declare quantidade_prod int;

	select estoque into quantidade_prod from produtos where id_produto = new.id_produto;

	set quantidade = new.quantidade;

	select sum(valor_desconto) into valor_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select avg(percentual_desconto) into percentual_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total_sem_desconto) into valor_total_sem_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total) into valor_total_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	
	update orcamentos set valor_desconto = valor_desconto_tg, percentual_desconto = percentual_desconto_tg, valor_total_sem_desconto = valor_total_sem_desconto_tg , valor_total = valor_total_tg where id_orcamento = new.id_orcamento;
	
	update produtos set estoque = (quantidade_prod - quantidade) where id_produto = new.id_produto;
end
$$
DELIMITER ;


DELIMITER $$
create or replace TRIGGER tg_orcamento_item_delete AFTER delete 
ON orcamento_items FOR EACH ROW
begin
	declare valor_desconto_tg float;
	declare percentual_desconto_tg float;
	declare valor_total_sem_desconto_tg float;
	declare valor_total_tg float;
	declare quantidade int;
	declare quantidade_prod int;

	select sum(valor_desconto) into valor_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select avg(percentual_desconto) into percentual_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total_sem_desconto) into valor_total_sem_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total) into valor_total_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;

	select estoque into quantidade_prod from produtos where id_produto = old.id_produto;

	set quantidade = old.quantidade;

	if old.id_orcamento is null then
		set valor_desconto_tg = 0;
		set percentual_desconto_tg = 0;
		set valor_total_sem_desconto_tg = 0;
		set valor_total_tg = 0;
	end if;

	update orcamentos set valor_desconto = ifnull(valor_desconto_tg,0), percentual_desconto = ifnull(percentual_desconto_tg,0), valor_total_sem_desconto = ifnull(valor_total_sem_desconto_tg,0) , valor_total = ifnull(valor_total_tg,0) where id_orcamento = OLD.id_orcamento;
	update produtos set estoque = (quantidade_prod + quantidade) where id_produto = old.id_produto;
end
$$
DELIMITER ;


DELIMITER $$
create or replace TRIGGER tg_cliente_pf_insert AFTER insert 
ON pessoa_fisicas FOR EACH ROW
BEGIN
	IF NEW.cliente = 1 THEN
    	INSERT INTO clientes (id_pessoa_fisica) VALUES (new.id_pessoa_fisica);
	END IF; 
end
$$
DELIMITER ;

DELIMITER $$
create or replace TRIGGER tg_cliente_pf_update AFTER UPDATE
ON pessoa_fisicas FOR EACH ROW
BEGIN
	if new.cliente <> old.cliente && new.cliente = 0 then 
    	DELETE FROM clientes WHERE id_pessoa_fisica = new.id_pessoa_fisica;
    elseif new.cliente <> old.cliente && new.cliente = 1 THEN
    	INSERT INTO clientes (id_pessoa_fisica) VALUES (new.id_pessoa_fisica);
    end if; 
END
$$
DELIMITER ;

DELIMITER $$
create or replace TRIGGER tg_cliente_pj_insert AFTER insert 
ON pessoa_juridicas FOR EACH ROW
BEGIN
	IF NEW.cliente = 1 THEN
    	INSERT INTO clientes ( id_pessoa_juridica) VALUES (new.id_pessoa_juridica);
	END IF; 
end
$$
DELIMITER ;

DELIMITER $$
create or replace TRIGGER tg_cliente_pj_update AFTER UPDATE
ON pessoa_juridicas FOR EACH ROW
BEGIN
	if new.cliente <> old.cliente && new.cliente = 0 then 
    	DELETE FROM clientes WHERE id_pessoa_juridica = new.id_pessoa_juridica;
    elseif new.cliente <> old.cliente && new.cliente = 1 THEN
    	INSERT INTO clientes (id_pessoa_juridica) VALUES (new.id_pessoa_juridica);
    end if; 
end
$$
DELIMITER ;

create or replace
algorithm = UNDEFINED view `vw_orcamento_pagamento` as
select 
op.id_orcamento,
vfp.forma_pagamento,
op.parcelas,
op.valor_parcela,
op.valor_total 
from orcamento_pagamentos op 
inner join vw_forma_pagamento vfp on op.id_pagamento = vfp.id_pagamento;

create or replace
algorithm = UNDEFINED view `vw_orcamento_pagamento_consolidado` as
select 
vop.id_orcamento, 
cast(sum(valor_parcela) as decimal(10,2)) as valor_parcela, 
cast(sum(valor_total) as decimal(10,2)) as valor_total_recebido, 
(select valor_total from orcamentos o where o.id_orcamento = vop.id_orcamento) as valor_total,
(select valor_total from orcamentos o where o.id_orcamento = vop.id_orcamento) - cast(sum(valor_total) as decimal(10,2)) as valor_a_receber
from vw_orcamento_pagamento vop group by vop.id_orcamento;

create or replace view vw_cobranca as
select 
c.id_cobranca,
c.id_pagamento,
vc.nome,
vc.documento,
c.num_parcela,
c.valor_parcela,
c.status_pagamento,
c.data_geracao,
c.data_pagamento,
c.data_recebimento,
c.data_vencimento 
from cobrancas c 
inner join orcamentos o on c.id_orcamento = o.id_orcamento 
inner join vw_clientes vc on c.id_cliente = vc.id_cliente 
inner join pagamentos p on c.id_pagamento = p.id_pagamento 
;

DELIMITER $$

CREATE OR REPLACE PROCEDURE `sp_cobranca`(in in_id_orcamento int, in in_id_pagamento int, in in_id_orcamento_pagamento int)
begin
declare p_id_banco int;
declare p_id_cliente int;
declare p_id_agente int;
declare p_data_vencimento date;
declare p_data_pagamento date default '1900-01-01';
declare p_data_recebimento date default '1900-01-01';
declare p_status_pagamento varchar(20) default 'aberto';
declare p_num_parcela int;
declare p_valor_parcela decimal(10,2);
declare p_valor_recebido decimal(10,2) default (0.00);
declare p_valor_desconto decimal(10,2) default (0.00);
declare p_valor_multa decimal(10,2) default (0.00);
declare p_valor_juros decimal(10,2) default (0.00);
declare p_valor_total decimal(10,2) default (0.00);
declare j int;

set j = 1;

select 
orcamento_pagamentos.parcelas into p_num_parcela
from orcamento_pagamentos
inner join orcamentos on orcamento_pagamentos.id_orcamento = orcamentos.id_orcamento
    where 
    	orcamento_pagamentos.id_orcamento = in_id_orcamento
    and
    	orcamento_pagamentos.id_pagamento = in_id_pagamento
   and 
   		orcamento_pagamentos.id_orcamento_pagamento = in_id_orcamento_pagamento
    ;

select 
orcamento_pagamentos.valor_parcela into p_valor_parcela
from orcamento_pagamentos
inner join orcamentos on orcamento_pagamentos.id_orcamento = orcamentos.id_orcamento
    where 
    	orcamento_pagamentos.id_orcamento = in_id_orcamento
    and
	    orcamento_pagamentos.id_pagamento = in_id_pagamento
    and 
    	orcamento_pagamentos.id_orcamento_pagamento = in_id_orcamento_pagamento
   ;

select 
orcamento_pagamentos.id_agente into p_id_agente
from orcamento_pagamentos
inner join orcamentos on orcamento_pagamentos.id_orcamento = orcamentos.id_orcamento
    where 
    	orcamento_pagamentos.id_orcamento = in_id_orcamento
    and
	    orcamento_pagamentos.id_pagamento = in_id_pagamento
	and 
		orcamento_pagamentos.id_orcamento_pagamento = in_id_orcamento_pagamento;
   
select 
orcamento_pagamentos.id_banco into p_id_banco
from orcamento_pagamentos
inner join orcamentos on orcamento_pagamentos.id_orcamento = orcamentos.id_orcamento
    where 
    	orcamento_pagamentos.id_orcamento = in_id_orcamento
    and
    	orcamento_pagamentos.id_pagamento = in_id_pagamento
    and 
   		orcamento_pagamentos.id_orcamento_pagamento = in_id_orcamento_pagamento;


select 
orcamentos.id_cliente into p_id_cliente
from orcamento_pagamentos
inner join orcamentos on orcamento_pagamentos.id_orcamento = orcamentos.id_orcamento
    where 
    	orcamento_pagamentos.id_orcamento = in_id_orcamento
    and
    	orcamento_pagamentos.id_pagamento = in_id_pagamento
    and 
   		orcamento_pagamentos.id_orcamento_pagamento = in_id_orcamento_pagamento;
   

	while(j <= p_num_parcela) do

		insert
			into
			cobrancas
      (id_cliente, id_orcamento, data_geracao, data_vencimento, data_pagamento, data_recebimento, status_pagamento,id_agente,id_banco ,id_pagamento, num_parcela, valor_parcela, valor_recebido, valor_desconto, valor_multa, valor_juros, valor_total, created_at)
				values
			(p_id_cliente, in_id_orcamento, cast(now() as date), DATE_ADD(cast(now() as date), INTERVAL j MONTH), '1900-01-01',  '1900-01-01', p_status_pagamento, p_id_agente, p_id_banco, in_id_pagamento,j,p_valor_parcela, 0.0, 0.0,0.0,0.0,0.0, now() );
        set j = j+1;
		end while;
end
$$
DELIMITER ;


DELIMITER $$
create or replace TRIGGER tg_orcamentos_update AFTER UPDATE
ON orcamentos FOR EACH ROW
begin
	declare validador int;
	declare i int;
	declare new_id_pagamento int;
	declare new_id_orcamento_pagamento int;

	set i = 0;
	if new.status_orcamento = 'aprovado' then 
		select count(1) into validador from orcamento_pagamentos where id_orcamento = new.id_orcamento;
		while i < validador do
			select 
					id_pagamento into new_id_pagamento
				from orcamento_pagamentos 
				where 
					id_orcamento = new.id_orcamento 
					and 
					not exists (
						select 1 from cobrancas 
							where 
								id_orcamento = new.id_orcamento 
							and 
								cobrancas.id_pagamento = orcamento_pagamentos.id_pagamento)
				limit  1;
			
				select 
					id_orcamento_pagamento into new_id_orcamento_pagamento
				from orcamento_pagamentos 
				where 
					id_orcamento = new.id_orcamento 
					and 
					not exists (
						select 1 from cobrancas 
							where 
								id_orcamento = new.id_orcamento 
							and 
								cobrancas.id_pagamento = orcamento_pagamentos.id_pagamento)
				limit  1;
				
			call sp_cobranca(new.id_orcamento, new_id_pagamento, new_id_orcamento_pagamento);
			set i = i + 1;
		end while;
	end if;
end
$$
DELIMITER ;
