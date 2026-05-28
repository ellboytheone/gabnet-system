<?php

//$papel_permitido avisa ao auth_check, o papel de usuario permitido nesta pagina
$papel_permitido = 'Administrador';
require __DIR__ . '/../../auth/auth_check.php';

//retorna todos os dados do aluno em um array aluno[etc...]
require __DIR__ . '/../../includes/my_data.php';

//$titulo_documento avisa ao head.php qual e o titulo da pagina
$titulo_documento = 'Comunicados';
//$class_body avisa qual e a class do body (para questoes de estilizacao)
$class_body = 'admin';
//$css_body avisa qual e o link css a se adicionar, ATT: que esteja dentro de assets/css/
$css_extra = ['announcements.css', 'admin.css'];
require __DIR__ . '/../../includes/head.php';
//$pagina ativa diz a pagina em que estas
$pagina_ativa = 'comunicados';
require __DIR__ . '/../../includes/admin_sidebar.php';
?>
      <header class="topbar">
        <section class="topbar-left">
          <button
            class="hamburger-btn"
            onclick="toggleSidebar()"
            aria-label="Menu"
          >
            <span></span>
            <span></span>
            <span></span>
          </button>
          <div class="breadcrumb">
            GABnet &rsaquo; <a href="index.php">Painel de Administrador</a> &rsaquo; <strong>Comunicados</strong>
          </div>
        </section>
        <section class="topbar-right">
          <div class="topbar-date"><?= date('d/m/Y') ?></div>
          <span class="topbar-avatar">A</span>
        </section>
      </header>
      <main class="content">
        <header class="main-header">
          <div>
            <h1>Gestão de <em>Comunicados</em></h1>
            <p>Todos os comunicados do sistema — publicados, pendentes de aprovação e rejeitados.</p>
          </div>
          <a href="create-announcement.php" class="announce-btn">
            <svg viewBox="0 0 24 24">
              <line x1="12" y1="5" x2="12" y2="19"/>
              <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Nova comunicado
          </a>
        </header>
        <div class="quick-filters">
          <a href=""
            class="qf-pill active">
            Todos <span class="qf-count">3</span>
          </a>
          <a href="?status=posted"
            class="qf-pill">
            Publicados <span class="qf-count">1</span>
          </a>
          <a href="?status=pending"
            class="qf-pill orange">
            Pendentes <span class="qf-count">1</span>
          </a>
          <a href="?status=denied"
            class="qf-pill red">
            Rejeitados <span class="qf-count">1</span>
          </a>
        </div>
        <form method="GET" action="announcements.php" class="search-bar">
          <input type="hidden" name="status"  value=""/>
          <div class="search-wrap">
            <svg viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" name="q" value="" placeholder="Pesquisar por título ou conteúdo..."/>
          </div>
          <select name="importance" class="filter-select" onchange="this.form.submit()">
            <option value="">Todas importâncias</option>
            <option value="high">Alta</option>
            <option value="medium">Média</option>
            <option value="low">Baixa</option>
          </select>
          <button type="submit" class="btn-search">
            <svg viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            Pesquisar
          </button>
          <a href="" class="btn-clean" style="display: none">
            <svg viewBox="0 0 24 24">
              <line x1="18" y1="6" x2="6" y2="18"/>
              <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
            Limpar
          </a>
        </form>
        <section class="main-grid">
            <div class="left-col">
              <section class="panel" id="announcements-panel-s">
                <div class="panel-header">
                  <h2>
                    <svg viewBox="0 0 24 24">
                      <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                      <path d="M13.73 21a2 2 0 01-3.46 0"/>
                    </svg>
                    Comunicados recentes
                  </h2>
                  <span class="panel-header-text">7 resultados</span>
                </div>
                <div class="ann-item active" id="ci-1" onclick="lerComunicado()">
                  <div class="imp-bar high"></div>
                  <div class="ann-body">
                    <div class="ann-r1">
                      <span class="ann-title">Reunião de encarregados de educação</span>
                      <span class="imp-label high">Alta</span>
                    </div>
                    <div class="ann-r2">
                      <span class="ann-meta">
                        <svg viewBox="0 0 24 24">
                          <circle cx="12" cy="12" r="10"/>
                          <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        14/04/2026
                      </span>
                      <span class="target-tag">Todos</span>
                    </div>
                    <div class="ann-excerpt">A reunião realiza-se no dia 18 de Abril às 09h00 no salão principal da escola.</div>
                  </div>
                </div>
                <div class="ann-item" id="ci-2" onclick="lerComunicado()">
                  <div class="imp-bar medium"></div>
                  <div class="ann-body">
                    <div class="ann-r1">
                      <span class="ann-title">Calendário de exames do 2.º trimestre</span>
                      <span class="imp-label medium">Média</span>
                    </div>
                    <div class="ann-r2">
                      <span class="ann-meta">
                        <svg viewBox="0 0 24 24">
                          <circle cx="12" cy="12" r="10"/>
                          <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        12/04/2026
                      </span>
                      <span class="target-tag">Tua turma</span>
                    </div>
                    <div class="ann-excerpt">Os exames decorrem entre os dias 22 e 30 de Abril. Consulta o horário afixado.</div>
                  </div>
                </div>
                <div class="ann-item" id="ci-5" onclick="lerComunicado()">
                  <div class="imp-bar low"></div>
                  <div class="ann-body">
                    <div class="ann-r1">
                      <span class="ann-title">Inscrição para actividades extracurriculares</span>
                      <span class="imp-label low">Baixa</span>
                    </div>
                    <div class="ann-r2">
                      <span class="ann-meta">
                        <svg viewBox="0 0 24 24">
                          <circle cx="12" cy="12" r="10"/>
                          <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        10/04/2026
                      </span>
                      <span class="target-tag">Todos</span>
                    </div>
                    <div class="ann-excerpt">As inscrições para o clube de robótica e o grupo de teatro estão abertas.</div>
                  </div>
                </div>
                <div class="ann-item" id="ci-6" onclick="lerComunicado()">
                  <div class="imp-bar low"></div>
                  <div class="ann-body">
                    <div class="ann-r1">
                      <span class="ann-title">Manutenção do sistema — Sábado</span>
                      <span class="imp-label low">Baixa</span>
                    </div>
                    <div class="ann-r2">
                      <span class="ann-meta">
                        <svg viewBox="0 0 24 24">
                          <circle cx="12" cy="12" r="10"/>
                          <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        08/04/2026
                      </span>
                      <span class="target-tag">Todos</span>
                    </div>
                    <div class="ann-excerpt">O portal estará indisponível no sábado entre as 02h00 e as 06h00.</div>
                  </div>
                </div>
              </section>
            </div>
            <div class="right-col">
              <section class="reading-panel" id="reading-panel">
                <div class="reading-placeholder" id="reading-placeholder" style="display: block;">
                  <svg viewBox="0 0 24 24">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                  <p>Clica num comunicado para ler o conteúdo completo.</p>
                </div>
                <div id="rp-wrapper" class="rp-imp-high" style="display: none;">
                  <div class="rp-imp-stripe" id="rp-stripe"></div>
                  <div class="rp-header">
                    <div class="rp-badge-row">
                      <span class="imp-label high" id="rp-badge">ALta</span>
                      <span class="target-tag" id="rp-target">Todos</span>
                    </div>
                    <div class="rp-title" id="rp-title">Titulo do Comunicado</div>
                  </div>
                  <div class="rp-body">
                    <div class="rp-content" id="rp-content">Exemplo de conteudo, aqui fica o comunicado em si.</div>
                    <div class="rp-meta">
                      <div class="rp-meta-item">
                        <div class="rp-meta-label">Publicado por</div>
                        <div class="rp-meta-val" id="rp-author">Autor(a)</div>
                      </div>
                      <div class="rp-meta-item">
                        <div class="rp-meta-label">Data</div>
                        <div class="rp-meta-val" id="rp-date">10/05/2026</div>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
        </section>
      </main>
    </div>
    <script src="/gabnet-system/assets/js/dashboard.js"></script>
    </body>
</html>