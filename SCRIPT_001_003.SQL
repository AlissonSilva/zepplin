DELIMITER $$
CREATE TRIGGER tg_orcamento_item AFTER insert 
ON zeppelin.orcamento_items FOR EACH ROW
begin
	declare valor_desconto float;
	declare percentual_desconto float;
	declare valor_total_sem_desconto float;
	declare valor_total float;

	select sum(valor_desconto) into valor_desconto from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select avg(percentual_desconto) into percentual_desconto from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total_sem_desconto) into valor_total_sem_desconto from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total) into valor_total from orcamento_items oi where oi.id_orcamento = new.id_orcamento group by oi.id_orcamento ;
	
	update orcamentos set valor_desconto = valor_desconto, percentual_desconto = percentual_desconto, valor_total_sem_desconto = valor_total_sem_desconto , valor_total = valor_total where id_orcamento = new.id_orcamento;

end;
$$
DELIMITER ;


DELIMITER $$


CREATE TRIGGER tg_orcamento_item_delete AFTER delete 
ON zeppelin.orcamento_items FOR EACH ROW
begin
	declare valor_desconto_tg float;
	declare percentual_desconto_tg float;
	declare valor_total_sem_desconto_tg float;
	declare valor_total_tg float;

	select sum(valor_desconto) into valor_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select avg(percentual_desconto) into percentual_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total_sem_desconto) into valor_total_sem_desconto_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	select sum(valor_total) into valor_total_tg from orcamento_items oi where oi.id_orcamento = OLD.id_orcamento group by oi.id_orcamento ;
	
	update orcamentos set valor_desconto = valor_desconto_tg, percentual_desconto = percentual_desconto_tg, valor_total_sem_desconto = valor_total_sem_desconto_tg , valor_total = valor_total_tg where id_orcamento = OLD.id_orcamento;

end

$$
DELIMITER ;






