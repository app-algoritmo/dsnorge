-- DIGITAL SOLUTIONS — Min side (editor das landingssider dos clientes)
-- Execute uma vez no phpMyAdmin do Domeneshop, na mesma base de bestillinger.sql.
-- DOC-WEB-MS-001 · v1.0.0

-- Um cliente = uma landingsside em <slug>.dsnorge.com
CREATE TABLE IF NOT EXISTS kunder (
  id              INT UNSIGNED NOT NULL AUTO_INCREMENT,
  opprettet       DATETIME     NOT NULL,
  epost           VARCHAR(180) NOT NULL,             -- login do Min side
  bestilling_ref  VARCHAR(20)      NULL,             -- DS-000123 (pedido de origem)
  slug            VARCHAR(40)  NOT NULL,             -- <slug>.dsnorge.com
  modell          ENUM('handverk','mat','velvaere') NOT NULL,
  layout          VARCHAR(10)  NOT NULL DEFAULT 'a',
  tema            VARCHAR(20)  NOT NULL DEFAULT 'babyblaa',
  sprak           CHAR(2)      NOT NULL DEFAULT 'no',   -- idioma da página e do Min side: no, pt, en, es
  utkast          LONGTEXT     NOT NULL,             -- JSON: o que o cliente está editando
  publisert       LONGTEXT         NULL,             -- JSON: o que está no ar
  publisert_layout VARCHAR(10)     NULL,
  publisert_tema  VARCHAR(20)      NULL,
  status          ENUM('utkast','venter','aktiv','av') NOT NULL DEFAULT 'utkast',
                  -- utkast: editando · venter: pediu publicação, falta ativar
                  -- aktiv: no ar · av: desligada (cancelou / não pagou)
  sist_lagret     DATETIME         NULL,
  sist_publisert  DATETIME         NULL,
  sist_innlogget  DATETIME         NULL,
  nota            TEXT             NULL,             -- anotação interna (admin)
  PRIMARY KEY (id),
  UNIQUE KEY uq_epost (epost),
  UNIQUE KEY uq_slug (slug),
  KEY idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Links de login enviados por e-mail (guardamos só o hash do código)
CREATE TABLE IF NOT EXISTS innlogging (
  token_hash      CHAR(64)     NOT NULL,
  epost           VARCHAR(180) NOT NULL,
  opprettet       DATETIME     NOT NULL,
  utloper         DATETIME     NOT NULL,
  brukt           DATETIME         NULL,
  ip_hash         CHAR(64)         NULL,
  PRIMARY KEY (token_hash),
  KEY idx_epost (epost, opprettet),
  KEY idx_ip (ip_hash, opprettet)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Limpeza ocasional (pode rodar quando quiser):
-- DELETE FROM innlogging WHERE opprettet < NOW() - INTERVAL 30 DAY;
