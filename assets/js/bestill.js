/* ============================================================
   DIGITAL SOLUTIONS — bestill.js
   Envia o pedido de landing page para api/bestill.php (Domeneshop)
   e segue para o pagamento no Stripe.

   Para ativar: publique api/bestill.php e ponha a URL abaixo.
   Com ENDPOINT vazio, o formulário avisa que o pedido online
   ainda não está ativo e indica o e-mail.

   Documento controlado: DOC-DS-JS-004 · v1.0.0
   ============================================================ */

const ENDPOINT = "";   // ex.: "https://api.dsnorge.com/bestill.php"
const MAX_TOTAL = 40 * 1024 * 1024;   // soma dos arquivos

(function bestill(){
  const form = document.getElementById("bestill");
  if (!form) return;
  const estado = document.getElementById("bestill-estado");
  const botao = form.querySelector("button[type=submit]");
  const msg = id => (document.getElementById("msg-" + id)?.textContent || "").trim();
  const mostrar = (texto, erro) => {
    estado.textContent = texto;
    estado.dataset.erro = erro ? "true" : "false";
  };

  form.addEventListener("submit", async e => {
    e.preventDefault();
    form.querySelectorAll("[aria-invalid]").forEach(el => el.removeAttribute("aria-invalid"));

    if (!form.checkValidity()) {
      form.querySelectorAll(":invalid").forEach(el => el.setAttribute("aria-invalid", "true"));
      form.querySelector(":invalid")?.focus();
      mostrar(msg("invalido"), true);
      return;
    }
    const arquivos = form.querySelector("input[type=file]").files;
    let total = 0;
    for (const f of arquivos) total += f.size;
    if (arquivos.length > 6 || total > MAX_TOTAL) {
      form.querySelector("input[type=file]").setAttribute("aria-invalid", "true");
      mostrar(msg("invalido"), true);
      return;
    }
    if (!ENDPOINT) { mostrar(msg("inativo"), true); return; }

    const dados = new FormData(form);
    dados.append("idioma", window.dsI18n?.atual || "no");
    botao.disabled = true;
    mostrar(msg("enviando"), false);

    try {
      const r = await fetch(ENDPOINT, { method: "POST", body: dados });
      const j = await r.json().catch(() => ({}));
      if (r.ok && j.redirect) {
        window.location.href = j.redirect;
        return;
      }
      if (r.status === 422 && Array.isArray(j.campos)) {
        j.campos.forEach(c => form.querySelector(`[name="${c}"], [name="${c}[]"]`)?.setAttribute("aria-invalid", "true"));
        form.querySelector("[aria-invalid=true]")?.focus();
        mostrar(msg("invalido"), true);
      } else {
        mostrar(msg("erro"), true);
      }
    } catch {
      mostrar(msg("erro"), true);
    }
    botao.disabled = false;
  });
})();
