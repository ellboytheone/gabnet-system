
<!doctype html>
<html lang="pt-PT">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="/gabnet-system/assets/images/favicon.ico"
      type="image/x-icon"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Sora:wght@100..800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/gabnet-system/assets/css/announcements.css">
    <link rel="stylesheet" href="/gabnet-system/assets/css/dashboard.css">
    <link rel="stylesheet" href="/gabnet-system/assets/css/styles.css" />
    <title>Comunicados - GABnet</title>
  </head>
  <body class="student">
    <div class="sidebar-overlay" id="overlay" onclick="toggleSidebar()"></div>
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-logo">
        <img
          src="/gabnet-system/assets/images/gabnet-logo.png"
          alt="Logo de GABnet"
          class="logo"
        />
        <div class="logo-txt">
          <strong>GABnet</strong>
          <small>Portal Escolar</small>
        </div>
      </div>
      <div class="id-card student">
        <div class="avatar-lg">E</div>
        <div class="id-info">
          <strong>Emmanuel Mateus</strong>
          <small>12.ª Classe</small>
          <div class="id-badge">
            <svg viewBox="0 0 24 24">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
              <path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
            Estudante
          </div>
        </div>
      </div>
      <span class="nav-section">
        Menu
      </span>
      <nav class="nav-links">
        <a href="index.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7"/>
            <rect x="14" y="3" width="7" height="7"/>
            <rect x="14" y="14" width="7" height="7"/>
            <rect x="3" y="14" width="7" height="7"/>
          </svg>
          Dashboard
        </a>
        <a href="announcements.php" class="nav-link active">
          <svg viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 01-3.46 0"/>
          </svg>
          Comunicados
          <span class="nav-badge">1</span>
        </a>
        <a href="schedule.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
          Horário
        </a>
        <a href="profile.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
          Meu perfil
        </a>
      </nav>
      <footer class="sidebar-footer">
        <form method="POST" action="/auth/logout.php">
          <button type="submit" class="btn-logout">
            <svg viewBox="0 0 24 24">
              <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
              <polyline points="16 17 21 12 16 7"/>
              <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Terminar sessão
          </button>
        </form>
      </footer>
    </aside>
    <div class="main-wrap">
      <header class="topbar">
        <section class="topbar-left">
          <button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
          </button>
          <div class="breadcrumb">
            GABnet &rsaquo; <a href="index.php">Painel de Estudante</a> &rsaquo; <strong>Comunicados</strong>
          </div>
        </section>
        <section class="topbar-right">
          <div class="topbar-date">
            <?= date("d/m/Y") ?>
          </div>
          <a href="profile.php">
            <div class="topbar-avatar">
              E
            </div>
          </a>
        </section>
      </header>
      <main class="content">
        <header class="main-header">
          <h1>Os teus <em>comunicados</em></h1>
          <p>Tens 1 comunicados urgentes que requerem atenção.</p>
        </header>
        <section class="filter-row">
          <a href="announcements.php" class="filter-pill active">
            Todos <span class="fp-count">7</span>
          </a>
          <a href="?imp=High" class="filter-pill high">
            Alta <span class="fp-count">1</span>
          </a>
          <a href="?imp=Medium" class="filter-pill medium">
            Média <span class="fp-count">3</span>
          </a>
          <a href="?imp=Low" class="filter-pill low">
            Baixa <span class="fp-count">3</span>
          </a>
        </section>
        <div class="main-grid">
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
                    <span class="ann-title">Titulo do Comunicado</span>
                    <span class="imp-label high">Alta</span>
                  </div>
                  <div class="ann-r2">
                    <span class="ann-meta">
                      <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                      </svg>
                      22/04/2026
                    </span>
                    <span class="target-tag">Tua turma</span>
                  </div>
                  <div class="ann-excerpt">Conteudo do comunicado, Aqui haverá mais detalhes sobre o assunto.</div>
                </div>
              </div>
              <div class="ann-item" id="ci-2" onclick="lerComunicado()">
                <div class="imp-bar medium"></div>
                <div class="ann-body">
                  <div class="ann-r1">
                    <span class="ann-title">Titulo do Comunicado</span>
                    <span class="imp-label medium">Média</span>
                  </div>
                  <div class="ann-r2">
                    <span class="ann-meta">
                      <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                      </svg>
                      27/04/2026
                    </span>
                    <span class="target-tag">Tua turma</span>
                  </div>
                  <div class="ann-excerpt">Conteudo do comunicado, Aqui haverá mais detalhes sobre o assunto.</div>
                </div>
              </div>
              <div class="ann-item" id="ci-3" onclick="lerComunicado()">
                <div class="imp-bar medium"></div>
                <div class="ann-body">
                  <div class="ann-r1">
                    <span class="ann-title">Titulo do Comunicado</span>
                    <span class="imp-label medium">Média</span>
                  </div>
                  <div class="ann-r2">
                    <span class="ann-meta">
                      <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                      </svg>
                      27/04/2026
                    </span>
                    <span class="target-tag">Tua turma</span>
                  </div>
                  <div class="ann-excerpt">Conteudo do comunicado, Aqui haverá mais detalhes sobre o assunto.</div>
                </div>
              </div>
              <div class="ann-item" id="ci-4" onclick="lerComunicado()">
                <div class="imp-bar medium"></div>
                <div class="ann-body">
                  <div class="ann-r1">
                    <span class="ann-title">Titulo do Comunicado</span>
                    <span class="imp-label medium">Média</span>
                  </div>
                  <div class="ann-r2">
                    <span class="ann-meta">
                      <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                      </svg>
                      28/04/2026
                    </span>
                    <span class="target-tag">Tua turma</span>
                  </div>
                  <div class="ann-excerpt">Conteudo do comunicado, Aqui haverá mais detalhes sobre o assunto.</div>
                </div>
              </div>
              <div class="ann-item" id="ci-5" onclick="lerComunicado()">
                <div class="imp-bar low"></div>
                <div class="ann-body">
                  <div class="ann-r1">
                    <span class="ann-title">Titulo do Comunicado</span>
                    <span class="imp-label low">Baixa</span>
                  </div>
                  <div class="ann-r2">
                    <span class="ann-meta">
                      <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                      </svg>
                      27/04/2026
                    </span>
                    <span class="target-tag">Tua turma</span>
                  </div>
                  <div class="ann-excerpt">Conteudo do comunicado, Aqui haverá mais detalhes sobre o assunto.</div>
                </div>
              </div>
              <div class="ann-item" id="ci-6" onclick="lerComunicado()">
                <div class="imp-bar low"></div>
                <div class="ann-body">
                  <div class="ann-r1">
                    <span class="ann-title">Titulo do Comunicado</span>
                    <span class="imp-label low">Baixa</span>
                  </div>
                  <div class="ann-r2">
                    <span class="ann-meta">
                      <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                      </svg>
                      27/04/2026
                    </span>
                    <span class="target-tag">Tua turma</span>
                  </div>
                  <div class="ann-excerpt">Conteudo do comunicado, Aqui haverá mais detalhes sobre o assunto.</div>
                </div>
              </div>
              <div class="ann-item" id="ci-7" onclick="lerComunicado()">
                <div class="imp-bar low"></div>
                <div class="ann-body">
                  <div class="ann-r1">
                    <span class="ann-title">Titulo do Comunicado</span>
                    <span class="imp-label low">Baixa</span>
                  </div>
                  <div class="ann-r2">
                    <span class="ann-meta">
                      <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                      </svg>
                      27/04/2026
                    </span>
                    <span class="target-tag">Tua turma</span>
                  </div>
                  <div class="ann-excerpt">Conteudo do comunicado, Aqui haverá mais detalhes sobre o assunto.</div>
                </div>
              </div>
            </section>
          </div>
          <div class="right-col">
            <section class="reading-panel" id="reading-panel">
              <div class="reading-placeholder" id="reading-placeholder">
                <svg viewBox="0 0 24 24">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
                <p>Clica num comunicado para ler o conteúdo completo.</p>
              </div>
              <div id="rp-wrapper" style="display: none;">
                <div class="rp-imp-stripe" id="rp-stripe"></div>
                <div class="rp-header">
                  <div class="rp-badge-row">
                    <span class="imp-label" id="rp-badge"></span>
                    <span class="target-tag" id="rp-target"></span>
                  </div>
                  <div class="rp-title" id="rp-title"></div>
                </div>
                <div class="rp-body">
                  <div class="rp-content" id="rp-content"></div>
                  <div class="rp-meta">
                    <div class="rp-meta-item">
                      <div class="rp-meta-label">Publicado por</div>
                      <div class="rp-meta-val" id="rp-author"></div>
                    </div>
                    <div class="rp-meta-item">
                      <div class="rp-meta-label">Data</div>
                      <div class="rp-meta-val" id="rp-date"></div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>