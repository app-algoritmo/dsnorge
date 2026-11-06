# Servidor (Domeneshop) — Min side e páginas dos clientes

Estas pastas vão para o webhotell, **não** para o GitHub Pages:

| Pasta aqui        | No servidor     | Endereço                                   |
|-------------------|-----------------|--------------------------------------------|
| `servidor/side`   | `~/side`        | minside.dsnorge.com e `<slug>.dsnorge.com` |
| `servidor/ds-app` | `~/ds-app`      | (privada, fora da web)                     |
| `api/bestill.php` | `~/api`         | api.dsnorge.com/bestill.php                |

- A senha do banco fica **só** em `~/ds-app/config.php` no servidor. Aqui ela é `TROCAR_ESTA_SENHA`.
- Tabelas: `ds-app/sql/minside.sql` (e `api/sql/bestillinger.sql`), rodadas uma vez no phpMyAdmin.
- Cada cliente novo: Domeneshop → Webhotell → Webadresser → `<slug>.dsnorge.com` → pasta `side`; depois «Aktiver» em minside.dsnorge.com/admin.
