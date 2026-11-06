<?php
/**
 * DIGITAL SOLUTIONS — configuração do Min side e das páginas dos clientes.
 * Fica em ~/ds-app/config.php (fora de qualquer pasta pública).
 *
 * O repositório é público: troque a senha SÓ na cópia do servidor.
 * DOC-WEB-MS-002 · v1.0.0
 */
declare(strict_types=1);

const DB_HOST  = 'dsnorgecom01.mysql.domeneshop.no';
const DB_NOME  = 'dsnorgecom01';
const DB_USER  = 'dsnorgecom01';
const DB_SENHA = 'TROCAR_ESTA_SENHA';      // senha do banco MySQL (a do phpMyAdmin)

const BASE_DOMENE  = 'dsnorge.com';
const SIDE_HOST    = 'side.dsnorge.com';    // páginas: side.dsnorge.com/<slug>
const MINSIDE_HOST = 'minside.dsnorge.com'; // área do cliente

// true: o primeiro «Publiser» do cliente já põe a página no ar (você recebe aviso).
// false: a página espera você clicar em «Aktiver» no /admin.
const AUTO_AKTIVER = true;
const HTTPS        = true;

const REMETENTE = 'no-reply@dsnorge.com';
const DESTINO   = 'info@dsnorge.com';       // avisos para você

// Quem entra no painel /admin (login pelo mesmo link no e-mail)
const ADMIN_EPOST = ['info@dsnorge.com', 'paulofernandodebarros@gmail.com'];

// Pastas privadas (fora da web)
define('DATA_DIR', __DIR__ . '/data');                       // sessões e controle
define('BESTILLING_FILER', dirname(__DIR__) . '/bestillinger-filer'); // fotos do pedido
// Pasta pública das imagens dos clientes (dentro de ~/side)
define('MEDIA_DIR', dirname(__DIR__) . '/side/m');

// Só para testes no computador: grava os e-mails num arquivo em vez de enviar.
const EPOST_TIL_FIL = '';
