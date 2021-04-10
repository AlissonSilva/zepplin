

DELIMITER $$
CREATE TRIGGER tg_cliente_pf_update AFTER UPDATE
ON pessoa_fisicas FOR EACH ROW
BEGIN
	if new.cliente <> old.cliente && new.cliente = 0 then 
    	DELETE FROM clientes WHERE id_pessoa_fisica = new.id_pessoa_fisica;
    elseif new.cliente <> old.cliente && new.cliente = 1 THEN
    	INSERT INTO clientes (id_pessoa_fisica) VALUES (new.id_pessoa_fisica);
    end if; 
END;
$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER tg_cliente_pf_insert AFTER insert 
ON zeppelin.pessoa_fisicas FOR EACH ROW
BEGIN
	IF NEW.cliente = 1 THEN
    	INSERT INTO clientes (id_pessoa_fisica) VALUES (new.id_pessoa_fisica);
	END IF; 
end;
$$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER tg_cliente_pj_insert AFTER insert 
ON zeppelin.pessoa_juridicas FOR EACH ROW
BEGIN
	IF NEW.cliente = 1 THEN
    	INSERT INTO clientes ( id_pessoa_juridica) VALUES (new.id_pessoa_juridica);
	END IF; 
end;
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER tg_cliente_pj_update AFTER UPDATE
ON pessoa_juridicas FOR EACH ROW
BEGIN
	if new.cliente <> old.cliente && new.cliente = 0 then 
    	DELETE FROM clientes WHERE id_pessoa_juridica = new.id_pessoa_juridica;
    elseif new.cliente <> old.cliente && new.cliente = 1 THEN
    	INSERT INTO clientes (id_pessoa_juridica) VALUES (new.id_pessoa_juridica);
    end if; 
end;
$$
DELIMITER ;


