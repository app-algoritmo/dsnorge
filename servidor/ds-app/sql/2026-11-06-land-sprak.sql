-- DIGITAL SOLUTIONS — atualização de 06.11.2026: país do cliente e idioma da página
-- Execute UMA vez no phpMyAdmin (base dsnorgecom01), aba SQL, ANTES de enviar os arquivos novos.

ALTER TABLE bestillinger
  MODIFY orgnr VARCHAR(30) NOT NULL,
  ADD COLUMN land CHAR(2) NOT NULL DEFAULT 'NO' AFTER empresa;

ALTER TABLE kunder
  ADD COLUMN sprak CHAR(2) NOT NULL DEFAULT 'no' AFTER tema;
