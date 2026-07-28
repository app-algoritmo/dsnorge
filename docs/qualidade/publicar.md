# Publicar uma alteração

`DOC-DS-QUA-PR-001 · v1.0.0`

## Rotina

```bash
# 1. edite src/pages/, src/partials/ ou assets/js/catalogo.js

# 2. gere as páginas
python3 tools/build.py

# 3. se mexeu no catálogo, regere a imagem da home
python3 tools/gerar-disco-svg.py

# 4. se mexeu em texto de página, atualize o dicionário mestre
python3 tools/extrair-i18n.py

# 5. traduza — falha se faltar chave
python3 tools/traduzir.py

# 6. confira localmente
python3 -m http.server 8000

# 7. publique
git add -A && git commit -m "descrição da alteração" && git push
```

## O que o CI verifica antes de publicar

| Verificação | Falha quando |
|---|---|
| Raiz em dia com `src/` | alguém editou um `.html` da raiz à mão |
| Disco em dia com o catálogo | `catalogo.js` mudou e o SVG não foi regerado |
| `pt.json` em dia com o HTML | texto de página mudou e o extrator não rodou |
| `en/no/es` completos | chave nova sem tradução |
| `CNAME` | valor diferente de `dsnorge.com` |

Nenhuma dessas verificações depende de alguém lembrar. É o ponto.

## Registro

Cada publicação fica registrada no histórico do repositório, com autor, data
(ISO 8601) e o conteúdo exato da alteração. Não existe registro paralelo em
planilha — o repositório *é* o registro, conforme ISO 9001, 7.5.3.
