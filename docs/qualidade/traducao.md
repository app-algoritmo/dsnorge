# Traduzir uma alteração

`DOC-DS-QUA-PR-002 · v1.0.0`

## Cadeia de idiomas

```
pt (mestre)  →  en (ponte)  →  no · es
```

O português é derivado do HTML pelo `extrair-i18n.py`. Nunca se edita
`i18n/pt.json` à mão: a edição seria sobrescrita na próxima extração.

Em execução, `app.js` mescla `pt → en → alvo`. Uma chave que falte em `no.json`
cai para o inglês; se faltar também no inglês, cai para o português. A página
nunca fica em branco.

## Acrescentar texto novo

1. Escreva a página em português, com `data-i18n="chave.nova"` no elemento.
2. `python3 tools/extrair-i18n.py` — a chave entra no mestre.
3. `python3 tools/traduzir.py` — **falha**, listando a chave sem tradução.
4. Acrescente a entrada em `tools/_trad_a.py` ou `_trad_b.py`, na forma
   `"chave.nova": ("english", "norsk", "español"),`
5. `python3 tools/traduzir.py` — agora grava os três arquivos.

A falha do passo 3 é intencional. Ela existe para que ninguém publique uma
página meio traduzida sem perceber.

## Texto com marcação dentro

Se o elemento contém `<a>`, `<strong>` ou `<span class="mono">`, acrescente
`data-i18n-html` ao lado do `data-i18n`. Sem isso a troca de idioma substitui
o conteúdo por texto puro e a marcação desaparece.

A tradução, nesse caso, precisa repetir a marcação — inclusive os atributos do
link. É a razão de algumas entradas nas tabelas conterem HTML.

## Conferir

```bash
python3 tools/extrair-i18n.py --conferir
```

Mostra, por arquivo, quantas chaves existem, quais faltam e quais estão órfãs.
