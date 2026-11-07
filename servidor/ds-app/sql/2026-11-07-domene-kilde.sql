-- DIGITAL SOLUTIONS — atualização de 07.11.2026: domínio próprio do cliente e origem dos pedidos
-- Execute UMA vez no phpMyAdmin (base dsnorgecom01), aba SQL, ANTES de enviar os arquivos novos.

ALTER TABLE kunder
  ADD COLUMN domene VARCHAR(100) NULL DEFAULT NULL AFTER slug,
  ADD UNIQUE KEY uk_kunder_domene (domene);

ALTER TABLE bestillinger
  ADD COLUMN kilde VARCHAR(20) NULL DEFAULT NULL AFTER arquivos,
  ADD COLUMN utm VARCHAR(150) NULL DEFAULT NULL AFTER kilde;
