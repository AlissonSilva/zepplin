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
create or replace TRIGGER tg_orcamento_item AFTER insert 
ON orcamento_items FOR EACH ROW
begin
	declare valor_desconto_tg float;
	declare percentual_desconto_tg float;
	declare valor_total_sem_desconto_tg float;
	declare valor_total_tg float;

	select sum(valor_desconto) into valor_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select avg(percentual_desconto) into percentual_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total_sem_desconto) into valor_total_sem_desconto_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total) into valor_total_tg from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	
	update orcamentos set valor_desconto = valor_desconto_tg, percentual_desconto = percentual_desconto_tg, valor_total_sem_desconto = valor_total_sem_desconto_tg , valor_total = valor_total_tg where id_orcamento = new.id_orcamento;

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

	select sum(valor_desconto) into valor_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select avg(percentual_desconto) into percentual_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total_sem_desconto) into valor_total_sem_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total) into valor_total_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;


	if old.id_orcamento is null then
		set valor_desconto_tg = 0;
		set percentual_desconto_tg = 0;
		set valor_total_sem_desconto_tg = 0;
		set valor_total_tg = 0;
	end if;

	update orcamentos set valor_desconto = ifnull(valor_desconto_tg,0), percentual_desconto = ifnull(percentual_desconto_tg,0), valor_total_sem_desconto = ifnull(valor_total_sem_desconto_tg,0) , valor_total = ifnull(valor_total_tg,0) where id_orcamento = OLD.id_orcamento;

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