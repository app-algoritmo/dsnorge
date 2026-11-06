<?php
/**
 * DIGITAL SOLUTIONS — chave do assistente de chat (Anthropic).
 * 1. Copie este arquivo como  chat-nokkel.php  (sem ".eksempel").
 * 2. Troque o texto entre aspas pela sua chave da API (começa com "sk-ant-").
 * 3. Envie para ~/ds-app/chat-nokkel.php no servidor. NUNCA envie a chave para o GitHub.
 */
const ANTHROPIC_API_KEY = 'COLE_A_CHAVE_AQUI';

// Opcional: limites de uso (para controlar o custo).
// const CHAT_DAGSGRENSE = 400;   // perguntas por dia, somando todos os visitantes
// const CHAT_TIMEGRENSE = 30;    // perguntas por hora, por visitante
