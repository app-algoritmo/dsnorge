# Publicar o repositório app-algoritmo/dsnorge

`DOC-DS-QUA-PR-004 · v2.0.0`

Procedimento para levar esta entrega ao ar pela primeira vez, num
repositório recém-criado e vazio.

---

## 1. Criar o repositório

No GitHub, `app-algoritmo` → **New repository**:

| Campo | Valor | Por quê |
|---|---|---|
| Repository name | `dsnorge` | Casa com o domínio e com o e-mail |
| Visibility | **Public** | `/qualidade.html` afirma que o repositório é público para que as declarações técnicas sejam verificáveis. Privado torna a frase falsa. |
| Add README | **Off** | Já existe um no pacote |
| Add .gitignore | **No** | Já existe um no pacote |
| Add license | **No license** | Já existe `LICENSE` (MIT) no pacote |

Os três «off» não são preferência: qualquer um deles cria um commit inicial
que conflita com o primeiro push.

Depois de criado, no topo da página do repositório, ⚙ ao lado de **About**:

- Website: `https://dsnorge.com`
- Topics: `static-site` `multilingual` `wcag` `github-pages` `norway` `iso-9001`

---

## 2. Ligar o GitHub Pages **antes** do primeiro push

Settings → Pages → Source: **GitHub Actions**.

Se o push vier primeiro, o workflow roda, passa nas verificações e falha na
publicação por não haver destino configurado.

---

## 3. Subir o conteúdo

```bash
cd caminho/onde/descompactou
git init
git branch -M main
git remote add origin git@github.com:app-algoritmo/dsnorge.git

# conferir antes de subir — tudo deve passar sem alterar arquivo nenhum
python3 tools/build.py
python3 tools/gerar-disco-svg.py
python3 tools/extrair-i18n.py
python3 tools/traduzir.py
git status                     # se algo apareceu como modificado, commit junto

git add -A
git commit -m "Site v1.0.0 — catálogo DS, 5 frentes, 26 itens, 4 idiomas"
git push -u origin main
```

Acompanhe a aba **Actions**. O workflow reprova o deploy se a raiz divergir de
`src/`, se o disco divergir do catálogo, se os ativos de marca divergirem do
original, ou se faltar tradução.

---

## 4. Apontar o domínio

Settings → Pages → Custom domain: `dsnorge.com`.

No registrador de `dsnorge.com`:

| Tipo | Nome | Valor |
|---|---|---|
| A | `@` | `185.199.108.153` |
| A | `@` | `185.199.109.153` |
| A | `@` | `185.199.110.153` |
| A | `@` | `185.199.111.153` |
| CNAME | `www` | `app-algoritmo.github.io.` |

Marque **Enforce HTTPS** assim que o certificado for emitido. Pode levar
algumas horas.

> Enquanto o domínio não estiver ativo, o preview em
> `app-algoritmo.github.io/dsnorge/` aparece **sem estilo**. Os caminhos do
> site são absolutos (`/assets/…`), corretos para o domínio próprio e
> quebrados no subcaminho. Isso é esperado e não é defeito.

---

## 5. Encerrar o endereço antigo

Só **depois** de `https://dsnorge.com` responder com certificado válido:

1. Remova o registro `ds` do DNS de `barros.no`, ou configure um 301 para
   `https://dsnorge.com` — melhor para quem tem o link salvo.
2. Se existir um repositório anterior servindo `ds.barros.no`, arquive-o
   em vez de apagar:
   Settings → General → Danger Zone → **Archive this repository**.
   O histórico fica preservado e legível, sem receber commits novos.

Fazer isso antes do certificado deixa o endereço antigo apontando para lugar
nenhum durante a janela de propagação.

---

## Registro

Data de publicação, autor e conteúdo exato de cada alteração ficam no
histórico do repositório. Não há registro paralelo — o repositório é o
registro, conforme ISO 9001, 7.5.3.
