-- 1. Table
CREATE TABLE md_prioridade
(
    id_prioridade   NUMBER(10) PRIMARY KEY,
    id_procedimento NUMBER(10) NOT NULL,
    nivel           VARCHAR2(10) NOT NULL
);

-- 2. Sequence
CREATE SEQUENCE seq_md_prioridade
    START WITH 1
    INCREMENT BY 1 NOCACHE
  NOCYCLE;














-- 3. Trigger
CREATE
OR REPLACE TRIGGER trg_md_prioridade_bi
BEFORE INSERT ON md_prioridade
FOR EACH ROW
WHEN (NEW.id_prioridade IS NULL)
BEGIN
SELECT seq_md_prioridade.NEXTVAL
INTO :NEW.id_prioridade
FROM dual;
END;
/
