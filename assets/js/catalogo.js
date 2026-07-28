/* ============================================================
   DIGITAL SOLUTIONS — catalogo.js
   Fonte única de verdade do portfólio de plataformas e serviços.
   Toda alteração de oferta comercial acontece NESTE arquivo.

   O conteúdo é o mesmo do disco de três casas em barros.no,
   recortado nas cinco frentes executadas pela Digital Solutions.
   Alterou aqui, alterou lá: mantenha os dois em paridade.

   Documento controlado: DOC-DS-CAT-001 · v1.0.0
   Idioma mestre: pt-BR.
   ============================================================ */

/* Destinos. "" faz o item abrir apenas a ficha, sem página própria. */
export const PAGINAS = {
  ds:       "/servicos.html",
  mimbai:   "https://mimbai.com",
  oslomeet: "https://oslomeet.org",
  sala:     "https://github.com/app-algoritmo/SALA-SafeLast-Analytics",
  barros:   "https://barros.no",
};

export const CONTATO = "info@dsnorge.com";

/* As duas famílias. Cada uma ocupa um arco contínuo do disco.
   Plataformas: produto nosso, licenciado. Sob medida: construído por projeto. */
export const CASAS = {
  plataformas: { nome:"Plataformas próprias", papel:"Produtos licenciados, com evolução e suporte contínuos", cor:"#22536E" },
  medida:      { nome:"Sob medida",           papel:"Sistemas e dados construídos para um caso específico",    cor:"#4E8098" },
};

/* Rampa de azul, luminosidade crescente. Todos os tons mantêm
   contraste mínimo de 4.5:1 com o rótulo branco (WCAG 2.2 AA). */
export const CATEGORIAS = [

  /* ═══════════ PLATAFORMAS PRÓPRIAS ═══════════ */

  { id:"ia", titulo:"IA MIMBAI com Claude", curto:"IA MIMBAI", casa:"plataformas", cor:"#1E4A68",
    marca:"MIMBAI · Digital Solutions",
    intro:"Plataforma de IA que gera as entregas do dia a dia — projeto, planilha, deck, análise — dentro da sua empresa.",
    servicos:[
      { nome:"Assistente Geral", tipo:"Produto", resumo:"Chat corporativo multilíngue com histórico salvo na base da empresa.",
        formato:"Assinatura mensal por usuário", pagina:PAGINAS.mimbai,
        inclui:["Português, inglês, norueguês e espanhol","Contexto acumulado ao longo da conversa",
          "Histórico por usuário e por projeto","Modelo Claude por trás das respostas"] },
      { nome:"Gerador de Projetos", tipo:"Produto", resumo:"Um briefing vira dashboard de projeto completo.",
        formato:"Incluído no plano Pro", pagina:PAGINAS.mimbai,
        inclui:["Cronograma com marcos","Orçamento estimado","KPIs de acompanhamento","Análise de risco por frente"] },
      { nome:"Excel & Relatórios", tipo:"Produto", resumo:"Planilhas, painéis de KPI e relatórios gerados sob demanda.",
        formato:"Incluído no plano Pro", pagina:PAGINAS.mimbai,
        inclui:["Planilha pronta para download","Painel de indicadores",
          "Relatório de desempenho por período","Exportação em XLSX"] },
      { nome:"Apresentações", tipo:"Produto", resumo:"Deck montado a partir do briefing, já na identidade da marca.",
        formato:"Incluído no plano Pro", pagina:PAGINAS.mimbai,
        inclui:["Estrutura narrativa do deck","Identidade visual da empresa aplicada",
          "Gráficos alimentados pelos seus dados","Versão para conselho e versão comercial"] },
      { nome:"Finanças & ROI", tipo:"Produto", resumo:"Cálculo de retorno, projeções e leitura contábil assistida.",
        formato:"Incluído no plano Pro", pagina:PAGINAS.mimbai,
        inclui:["Cálculo de ROI por iniciativa","Triple bottom line",
          "Projeções financeiras plurianuais","Análise de desvio contra o orçado"] },
      { nome:"RH & Pessoas", tipo:"Produto", resumo:"Avaliações, onboarding e descrições de cargo padronizadas.",
        formato:"Incluído no plano Pro", pagina:PAGINAS.mimbai,
        inclui:["Avaliação de desempenho","Plano de onboarding por função","Descrição de cargos","Roteiro de feedback"] },
      { nome:"Content Engine", tipo:"Produto", resumo:"Conteúdo institucional e de campanha, adaptado por idioma.",
        formato:"Incluído no plano Pro", pagina:PAGINAS.mimbai,
        inclui:["Copy institucional","Conteúdo de campanha","Adaptação por idioma e mercado","Tom de voz da marca configurado"] },
      { nome:"RegTech", tipo:"Produto", resumo:"Módulo regulatório: consulta assistida e redação de procedimentos.",
        formato:"Complemento contratado à parte", pagina:PAGINAS.mimbai,
        marca:"MIMBAI × Inteligência Sanitária",
        inclui:["Consulta regulatória assistida","Redação de procedimentos operacionais",
          "Checklist de conformidade","Curadoria técnica da Inteligência Sanitária"] },
    ]},

  { id:"b2b", titulo:"B2B MIMBAI · Oslo Meet", curto:"B2B MIMBAI", casa:"plataformas", cor:"#265676",
    marca:"Oslo Meet · Digital Solutions",
    intro:"Rede de negócios com matching por IA entre Europa, Brasil, China e países nórdicos.",
    servicos:[
      { nome:"Matching B2B", tipo:"Produto", resumo:"O algoritmo aponta as empresas compatíveis, com score de aderência.",
        formato:"Assinatura anual", pagina:PAGINAS.oslomeet,
        inclui:["Perfil da empresa analisado por IA","Score de compatibilidade cross-border",
          "Feed de oportunidades priorizado","Quatro mercados: Europa, Brasil, China e Nórdicos"] },
      { nome:"AI Concierge", tipo:"Serviço", resumo:"A introdução entre as duas empresas é facilitada pela plataforma.",
        formato:"Plano Business ou superior", pagina:PAGINAS.oslomeet,
        inclui:["Apresentação formal entre as partes","Agenda de reunião coordenada",
          "Contexto de negócio enviado antes","Acompanhamento do primeiro contato"] },
      { nome:"Plano Starter", tipo:"Produto", resumo:"Para startups e pequenas empresas começarem na rede.",
        formato:"€165/ano com MVA incluído", pagina:PAGINAS.oslomeet,
        inclui:["Perfil com IA","5 matches por mês","Acesso aos eventos da comunidade","Feed básico de oportunidades"] },
      { nome:"Plano Business", tipo:"Produto", resumo:"Para quem faz da rede um canal ativo de negócio.",
        formato:"€425/ano com MVA incluído", pagina:PAGINAS.oslomeet,
        inclui:["Tudo do Starter","Matches ilimitados","Introduções pelo AI Concierge",
          "Destaque no feed de oportunidades","Prioridade nos eventos"] },
      { nome:"Plano Partner", tipo:"Produto", resumo:"Para patrocinadores e líderes de ecossistema.",
        formato:"€1.300/ano com MVA incluído", pagina:PAGINAS.oslomeet,
        inclui:["Tudo do Business","Critérios de matching sob medida","Eventos próprios na plataforma",
          "Visibilidade de marca e espaço de fala","Gerente de sucesso dedicado"] },
      { nome:"Founding Member", tipo:"Produto", resumo:"As 50 primeiras empresas mantêm metade do preço de forma vitalícia.",
        formato:"50% vitalício · vagas limitadas", pagina:PAGINAS.oslomeet,
        inclui:["Preço vitalício com 50% de desconto","Selo de membro fundador",
          "Acesso antecipado a novos recursos","Voz na definição do roadmap"] },
    ]},

  { id:"sala", titulo:"SALA · Safe-Load Analytics", curto:"SALA", casa:"plataformas", cor:"#2F6283",
    marca:"Digital Solutions",
    intro:"IA biomecânica que atua antes da lesão ocorrer — desenhada para transporte e logística na Noruega.",
    servicos:[
      { nome:"Monitoramento de risco (Rᵢ)", tipo:"Produto", resumo:"Índice de risco calculado em tempo real para cada operador.",
        formato:"Assinatura por operador monitorado", pagina:PAGINAS.sala,
        inclui:["Compressão lombar L5/S1 durante o levantamento",
          "Fator de superfície: gelo e neve elevam o esforço até 3×",
          "Exposição a vibração pela ISO 2631-1","Fadiga acumulada na jornada"] },
      { nome:"Painel HMS", tipo:"Produto", resumo:"O supervisor acompanha a distribuição de risco da equipe e age no turno.",
        formato:"Incluído na assinatura", pagina:PAGINAS.sala,
        inclui:["Faixas de risco: baixo 0–30, moderado 31–65, crítico 66–100",
          "Alerta em tempo real ao supervisor","Histórico por operador e por turno",
          "Escalonamento automático em faixa crítica"] },
      { nome:"Relatório de conformidade", tipo:"Serviço", resumo:"Trilha documental pronta para auditoria de segurança do trabalho.",
        formato:"Relatório trimestral", pagina:PAGINAS.sala,
        inclui:["Aderência ao Arbeidsmiljøloven § 4-4","Registro de alertas e ações tomadas",
          "Evidência para auditoria externa","Parecer técnico assinado"] },
      { nome:"Estudo de impacto econômico", tipo:"Serviço", resumo:"Quanto o afastamento custa hoje e o que muda com o SALA.",
        formato:"Projeto pontual", pagina:PAGINAS.sala,
        marca:"Digital Solutions × Barros Consultoria",
        inclui:["Custo atual de sykefravær","Projeção de redução de afastamento",
          "Efeito sobre o prêmio de seguro","Payback dentro do primeiro ano"] },
    ]},

  /* ═══════════ SOB MEDIDA ═══════════ */

  { id:"crm", titulo:"CRM & Extranet", curto:"CRM", casa:"medida", cor:"#376E91",
    marca:"Digital Solutions",
    intro:"Vendas, clientes e suporte no mesmo painel — com área externa para o cliente acompanhar o contrato.",
    servicos:[
      { nome:"CRM de vendas", tipo:"Produto", resumo:"Funil do primeiro contato ao fechamento.",
        formato:"Assinatura mensal por usuário", pagina:PAGINAS.ds,
        inclui:["Estágios: novo, qualificado, proposta, negociação, fechado","Valor em pipeline por estágio",
          "Histórico de negociação por cliente","Painel de leads ativos e negócios fechados"] },
      { nome:"Base de clientes", tipo:"Produto", resumo:"Cadastro, contatos e histórico em um lugar só.",
        formato:"Incluído no CRM", pagina:PAGINAS.ds,
        inclui:["Cadastro completo da empresa","Contatos por função","Histórico de interações","Documentos vinculados"] },
      { nome:"Suporte e chamados", tipo:"Produto", resumo:"Abertura, acompanhamento e fechamento de chamados.",
        formato:"Incluído no CRM", pagina:PAGINAS.ds,
        inclui:["Novo chamado com categoria","Status: aberto, em andamento, resolvido",
          "Tempo de resposta por chamado","Painel de chamados abertos"] },
      { nome:"Extranet do cliente", tipo:"Serviço", resumo:"O cliente acompanha o andamento sem precisar telefonar.",
        formato:"Implantação + assinatura", pagina:PAGINAS.ds,
        inclui:["Acesso por e-mail corporativo do cliente","Documentos compartilhados",
          "Status do contrato e das entregas","Canal direto de solicitação"] },
    ]},

  { id:"dev", titulo:"Desenvolvimento & Dados", curto:"Dev", casa:"medida", cor:"#3F7A9E",
    marca:"Digital Solutions",
    intro:"Tecnologia sob medida: do site ao algoritmo que resolve um problema que o software de prateleira não cobre.",
    servicos:[
      { nome:"Desenvolvimento web", tipo:"Serviço", resumo:"Sites, aplicações e landing pages focados em velocidade e SEO.",
        formato:"Projeto fechado", pagina:PAGINAS.ds,
        inclui:["Site corporativo ou aplicação web","Performance e SEO desde a estrutura",
          "Design responsivo","Publicação e domínio configurados"] },
      { nome:"Algoritmos e software sob medida", tipo:"Serviço", resumo:"Solução construída para um problema específico do seu negócio.",
        formato:"Projeto fechado", pagina:PAGINAS.ds,
        inclui:["Levantamento do problema real","Algoritmo otimizado para o caso",
          "Testes e documentação","Transferência de conhecimento ao time"] },
      { nome:"Automação de processos", tipo:"Serviço", resumo:"RPA e integrações que retiram a tarefa repetitiva da rotina da equipe.",
        formato:"Projeto + manutenção", pagina:PAGINAS.ds,
        inclui:["RPA com Selenium ou Playwright","Scripts de integração entre sistemas",
          "Rotinas agendadas","Monitoramento de falha"] },
      { nome:"Dados & BI", tipo:"Serviço", resumo:"Coleta, tratamento e visualização com Python.",
        formato:"Projeto + assinatura do painel", pagina:PAGINAS.ds,
        inclui:["Coleta e limpeza de dados","Python, Pandas e NumPy","Painéis de visualização",
          "Apoio à decisão com indicadores acordados"] },
    ]},
];

/* Lista achatada, usada pelo seletor do formulário de contato. */
export function listaServicos(){
  const out = [];
  CATEGORIAS.forEach(cat => {
    cat.servicos.forEach(s => {
      out.push({
        valor: `${cat.id}::${s.nome}`,
        casa: CASAS[cat.casa].nome,
        categoria: cat.titulo,
        nome: s.nome,
        tipo: s.tipo,
      });
    });
  });
  return out;
}
