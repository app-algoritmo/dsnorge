# Ativar o envio direto do formulário

`DOC-DS-QUA-PR-003 · v1.0.0`

## Por que ativar

Com `ENDPOINT` vazio, o formulário abre o programa de e-mail do visitante. Isso
funciona sem servidor nenhum, mas quem acessa pelo celular ou por webmail sem
cliente configurado costuma desistir no meio — e a mensagem se perde sem deixar
rastro.

Com o endpoint ativo, cada mensagem ganha número de referência, fica registrada
no banco e alimenta o indicador «prazo da primeira resposta» declarado em
`/qualidade.html`. Um indicador que não tem de onde puxar o dado não é um
indicador.

## Passos

1. **Banco.** Crie a base e rode `api/sql/contatos.sql`.
2. **Credenciais.** Ajuste as constantes no topo de `api/contato.php`:

   > **Atenção — o repositório é público.** Edite a senha real somente na cópia
   > enviada ao servidor. A versão versionada aqui mantém o placeholder. Senha
   > que entra num commit fica no histórico para sempre; se acontecer, a
   > correção é trocar a senha no banco, não reescrever o repositório.

   `DB_NOME`, `DB_USER`, senha, `DESTINO`, `REMETENTE` e `ORIGENS`.
   O `REMETENTE` precisa ser um endereço que exista no domínio, senão o envio
   é recusado por SPF.
3. **Publicação.** Suba `api/contato.php` num host com PHP — recomendável em
   subdomínio próprio, `api.dsnorge.com`, com HTTPS.
4. **Front.** Em `assets/js/form.js`, troque:

   ```js
   const ENDPOINT = "https://api.dsnorge.com/contato.php";
   ```

5. **Teste.** Envie uma mensagem de teste e confirme três coisas: chegou em
   `info@dsnorge.com`, gravou no banco, e a página mostrou o número de referência.

## Comportamento em falha

Se o endpoint responder erro ou não responder, o formulário cai sozinho no
mailto e avisa o visitante. Nenhuma mensagem é perdida por indisponibilidade
do servidor — esse fallback não deve ser removido.

## Retenção

Os registros da base seguem os prazos declarados na Política de Privacidade:
12 meses para solicitação que não vira contrato, prazo do contrato mais 5 anos
quando vira. A rotina de expurgo é responsabilidade de quem opera o banco.
