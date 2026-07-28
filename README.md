# dsnorge.com

Site institucional da **Digital Solutions** — plataformas próprias e sistemas
sob medida. Estático, multilíngue (pt-BR · en · nb-NO · es), sem dependência
de terceiros em tempo de execução.

**Produção:** https://dsnorge.com
**Repositório:** https://github.com/app-algoritmo/dsnorge
**Registro:** org.nr 996 041 468 — Brønnøysundregistrene, Norge

---

## A regra que sustenta tudo

**Você nunca edita os `.html` da raiz.** Eles são gerados.

```
src/partials/ + src/pages/   →   python3 tools/build.py   →   *.html na raiz
```

Cabeçalho, rodapé, metadados, código de documento e versão existem em um lugar
só. Editar a raiz à mão quebra isso — e o workflow do GitHub **reprova o deploy**
quando detecta divergência. Esse é o controle de informação documentada exigido
pela ISO 9001, cláusula 7.5, e é a razão de ele ser automático em vez de
depender de disciplina.

---

## Estrutura

```
.
├── *.html                    gerados — não editar
├── sitemap.xml               gerado
│
├── src/
│   ├── partials/             head · header · footer (fonte única)
│   └── pages/                conteúdo de cada página + bloco <!--meta-->
│
├── assets/
│   ├── css/                  base (tokens) · layout · components
│   ├── fonts/                IBM Plex Sans/Serif/Mono — self-hosted, SIL OFL 1.1
│   ├── img/                  logo-ds.png · favicon/ · og/  ·  disco.svg (gerado)
│   │   └── marca/            logo-ds-original.png — arquivo original recebido
│   └── js/
│       ├── catalogo.js       CATÁLOGO COMERCIAL — fonte única do disco
│       ├── disco.js          renderização do disco e da ficha de serviço
│       ├── form.js           formulário de contato
│       └── app.js            navegação, idiomas, revelação, consentimento
│
├── i18n/                     pt (mestre) · en · no · es
├── api/                      contato.php + sql/contatos.sql
├── tools/                    build.py · extrair-i18n.py · traduzir.py
│                             gerar-disco-svg.py
├── docs/qualidade/           procedimentos e registros
├── .well-known/              security.txt (RFC 9116)
└── .github/workflows/        publicação com verificação
```

---

## Comandos

```bash
python3 tools/build.py               # gera as páginas e o sitemap
python3 tools/gerar-disco-svg.py     # regera a imagem estática do disco
python3 tools/extrair-i18n.py        # regera i18n/pt.json a partir do HTML
python3 tools/traduzir.py            # regera en/no/es a partir das tabelas
python3 -m http.server 8000          # visualizar em http://localhost:8000
```

**Depois de mexer em qualquer coisa:**

```bash
python3 tools/build.py && python3 tools/extrair-i18n.py && python3 tools/traduzir.py
```

Se `traduzir.py` sair com erro, é porque uma chave nova entrou no HTML e não
tem tradução. Ele não grava nada nesse caso — de propósito. Tradução parcial
silenciosa é pior que erro visível.

---

## Como alterar cada coisa

### Plataformas, serviços e preços
Somente `assets/js/catalogo.js`. É a fonte única: o disco interativo, a vitrine,
a ficha de cada item e o seletor do formulário de contato saem todos dele.
Depois de editar, rode `python3 tools/gerar-disco-svg.py`.

> **Paridade com o barros.no.** O conteúdo destas cinco frentes é o mesmo do
> disco de três casas em `app-algoritmo/barros`, recortado no que a Digital
> Solutions executa. Alterou aqui, altere lá — e vice-versa. Os dois catálogos
> descrevem os mesmos itens comerciais para o mesmo cliente.

### Texto das páginas
`src/pages/<pagina>.html`, em português. Depois:

```bash
python3 tools/build.py
python3 tools/extrair-i18n.py    # o pt.json se atualiza sozinho
python3 tools/traduzir.py        # aponta o que falta traduzir e falha se faltar
```

O português é o idioma mestre — o dicionário é derivado do HTML, nunca o
contrário. Chave ausente numa tradução cai para o inglês, nunca quebra a página.

**Texto com marcação dentro** (um `<a>`, um `<span class="mono">`) precisa do
atributo `data-i18n-html` junto do `data-i18n`. Sem ele a troca de idioma
substitui por texto puro e a marcação some.

### Menu, rodapé, metadados
`src/partials/`. Vale para todas as páginas de uma vez.

### Cores e tipografia
`assets/css/base.css`, bloco `:root`. As cores das cinco fatias e das duas
famílias ficam em `catalogo.js` — são dado comercial, não decoração.

> **Restrição de contraste.** Os rótulos das fatias são brancos sobre a cor da
> fatia. Qualquer tom novo precisa de contraste ≥ 4.5:1 contra `#FFFFFF` para
> manter a WCAG 2.2 AA. A rampa atual (`#1E4A68` → `#3F7A9E`) fica entre 4.68:1
> e 8.9:1. Clarear além de `#3F7A9E` reprova a norma.

### Imagens da marca

Entregues pela Digital Solutions e instaladas. Para trocar, substituir o
arquivo mantendo nome e caminho — não há script a rodar.

| Arquivo | Tamanho |
|---|---|
| `assets/img/favicon/favicon.ico` | 16 · 32 · 48 |
| `assets/img/favicon/favicon.svg` | vetorial |
| `assets/img/favicon/favicon-96x96.png` | 96×96 |
| `assets/img/favicon/apple-touch-icon.png` | 180×180, opaco |
| `assets/img/favicon/web-app-manifest-192x192.png` | 192×192 |
| `assets/img/favicon/web-app-manifest-512x512.png` | 512×512 |
| `assets/img/og/og-default.png` | 1200×630 |

| `assets/img/logo-ds.png` | 328×112, fundo transparente |

O wordmark é dimensionado pela altura: 27 px no cabeçalho, 30 px no rodapé.
Ao substituir, manter fundo transparente, aparar a margem vazia e atualizar os
atributos `width`/`height` em `src/partials/header.html` e `footer.html` —
eles precisam bater com o arquivo, senão o navegador distorce.

`assets/img/marca/` guarda os originais recebidos. Não é usado pelo site.

### Nova página
1. Crie `src/pages/nova.html` começando pelo bloco `<!--meta {...} -->`
2. `python3 tools/build.py`
3. Acrescente o link em `src/partials/header.html` ou `footer.html`

---

## Formulário de contato

Destino: **info@dsnorge.com**.

Dois modos, controlados por uma constante em `assets/js/form.js`:

| `ENDPOINT` | Comportamento |
|---|---|
| `""` (atual) | Abre o programa de e-mail do visitante com a mensagem montada |
| URL do PHP | Envia por HTTPS, gera número de referência, grava no banco |

O segundo é o recomendado: não depende de o visitante ter cliente de e-mail
configurado, e é ele que alimenta o indicador «prazo da primeira resposta» da
página de conformidade. Se o servidor cair, o formulário volta sozinho ao mailto —
nenhuma mensagem se perde.

Para ativar, ver `docs/qualidade/formulario.md`.

> **Este repositório é público.** A senha do banco em `api/contato.php` é um
> placeholder e deve continuar assim aqui. Preencha a senha real **apenas na
> cópia que vai para o servidor**, nunca num commit. O histórico do git guarda
> tudo o que já foi commitado, mesmo depois de removido — uma senha que entra
> por engano precisa ser trocada no banco, não apagada do repositório.

O seletor de serviços é montado a partir de `catalogo.js`, agrupado por família.
A ficha de cada item no disco leva para `/contato.html?servico=id::Nome`, que
pré-seleciona a opção correspondente.

---

## Publicação

O site vai ao ar por GitHub Actions a cada `push` na `main`, depois de o
workflow verificar quatro coisas: a raiz está em dia com `src/`; o `disco.svg`
está em dia com o catálogo; o `pt.json`
está em dia com o HTML; e `en/no/es` não têm chave faltando.

**Configuração única, no GitHub:**

1. Settings → Pages → Source: **GitHub Actions**
2. Settings → Pages → Custom domain: `dsnorge.com`
3. **Enforce HTTPS** assim que o certificado for emitido

**DNS, no registrador de `dsnorge.com`:**

| Tipo | Nome | Valor |
|---|---|---|
| A | `@` | `185.199.108.153` |
| A | `@` | `185.199.109.153` |
| A | `@` | `185.199.110.153` |
| A | `@` | `185.199.111.153` |
| CNAME | `www` | `app-algoritmo.github.io.` |

> **Atenção.** Os caminhos do site são absolutos (`/assets/…`). Isso é correto
> para `dsnorge.com`, mas **quebra** em `app-algoritmo.github.io/dsnorge/`.
> Configure o domínio antes de conferir o resultado — o preview do GitHub sem
> domínio vai aparecer sem estilo, e isso é esperado.

> **Migração do CNAME.** O arquivo `CNAME` já contém `dsnorge.com`. O valor
> anterior, `ds.barros.no`, deve ser removido do DNS do `barros.no` **depois**
> de o certificado de `dsnorge.com` ser emitido, não antes — senão o domínio
> antigo fica apontando para lugar nenhum durante a janela de propagação.

---

## Formulário de contato: modo atual

O formulário opera por e-mail direto — abre o programa do visitante com a
mensagem pronta para `info@dsnorge.com`. Publicar `api/contato.php` é opcional
e está documentado em `docs/qualidade/formulario.md`: troca o mailto por envio
com número de referência e registro em banco, que é o que alimenta o indicador
«prazo da primeira resposta» declarado em `/qualidade.html`.

---

## Padrões atendidos

- **WCAG 2.2 AA** — contraste verificado, navegação por teclado, foco visível,
  `prefers-reduced-motion`, estrutura semântica, skip link
- **EN 301 549** — acessibilidade para o mercado europeu
- **GDPR / personopplysningsloven / LGPD** — consentimento prévio, painel de
  cookies, prazos de retenção declarados, direitos do titular
- **ISO 9001:2015** — informação documentada (7.5) imposta pelo build e pelo CI
- **ISO/IEC 27001 e 27701** — controles declarados em `/qualidade.html`
- **ISO/IEC 12207 e 25010** — ciclo de vida e critérios de aceite dos projetos
- **ISO 639-1 · 8601 · 3166-1 · 4217 · 10646** — códigos e formatos
- **RFC 9116** — canal de divulgação de vulnerabilidade em `/.well-known/`
- **Zero terceiros em runtime** — fontes, estilos e scripts saem do próprio
  domínio. Nenhuma requisição sai para fora ao carregar a página

A página `/qualidade.html` declara isso publicamente **e** declara que a
empresa não é certificada. As duas afirmações andam juntas.

---

## Licença

Código sob MIT (`LICENSE`). Conteúdo editorial, catálogo comercial e identidade
visual são de titularidade da Digital Solutions — ver `/termos-de-uso.html`.
Fontes IBM Plex sob SIL Open Font License 1.1.

---

`DOC-DS-README-001 · v1.0.0` · contato: info@dsnorge.com
