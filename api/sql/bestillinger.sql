-- DIGITAL SOLUTIONS — pedidos de landing page (Domeneshop / MySQL)
-- DOC-WEB-API-004 · v1.1.0
-- Execute uma vez no phpMyAdmin do Domeneshop, na mesma base de contatos.sql,
-- depois ponha DB_ATIVO = true em api/bestill.php (só na cópia do servidor).

CREATE TABLE IF NOT EXISTS bestillinger (
  id              INT UNSIGNED NOT NULL AUTO_INCREMENT,
  criado_em       DATETIME     NOT NULL,
  ref             VARCHAR(20)  NOT NULL,            -- DS-000123, enviado ao Stripe como client_reference_id
  modelo          ENUM('handverk','mat','velvaere') NOT NULL,
  empresa         VARCHAR(160) NOT NULL,
  land            CHAR(2)      NOT NULL DEFAULT 'NO', -- NO, BR ou XX (outro país)
  orgnr           VARCHAR(30)  NOT NULL,            -- org.nr (9 dígitos), CNPJ (14) ou nº de outro país
  contato         VARCHAR(120) NOT NULL,
  email           VARCHAR(180) NOT NULL,
  telefone        VARCHAR(40)  NOT NULL,
  subdominio      VARCHAR(40)      NULL,            -- desejado: <subdominio>.dsnorge.com
  descricao       TEXT         NOT NULL,
  horario         TEXT             NULL,            -- horário de funcionamento / área de atendimento
  facebook        VARCHAR(300)     NULL,
  instagram       VARCHAR(300)     NULL,
  arquivos        JSON             NULL,            -- nomes dos arquivos salvos fora do public_html
  idioma          CHAR(5)      NOT NULL DEFAULT 'no',
  termos_versao   VARCHAR(20)  NOT NULL,            -- versão de /vilkar.html aceita
  ip_hash         CHAR(64)         NULL,
  -- Trilha do pedido
  situacao        ENUM('novo','pago_trial','rascunho_enviado','aprovado','publicado','cancelado')
                  NOT NULL DEFAULT 'novo',
  publicado_em    DATETIME         NULL,            -- data em que o período grátis foi encerrado no Stripe
  nota            TEXT             NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uq_ref (ref),
  KEY idx_criado (criado_em),
  KEY idx_situacao (situacao),
  KEY idx_orgnr (orgnr)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Pedidos em aberto, do mais antigo para o mais novo:
-- SELECT ref, criado_em, empresa, modelo, situacao FROM bestillinger
--  WHERE situacao NOT IN ('publicado','cancelado') ORDER BY criado_em;
