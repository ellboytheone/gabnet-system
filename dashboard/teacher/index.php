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
    <link rel="stylesheet" href="/gabnet-system/assets/css/dashboard.css" />
    <link rel="stylesheet" href="/gabnet-system/assets/css/styles.css" />
    <title>Meu Painel - GABnet</title>
  </head>
  <body class="teacher">
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
      <div class="id-card">
        <div class="avatar-lg">P</div>
        <div class="id-info">
          <strong>Antônio Calunga</strong>
          <small>Engenharia Electrônia</small>
          <div class="id-badge">
            <svg viewBox="0 0 24 24">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
              <path d="M6 12v5c3 3 9 3 12 0v-5" />
            </svg>
            Professor
          </div>
        </div>
      </div>
      <span class="nav-section"> Menu </span>
      <nav class="nav-links">
        <a href="index.php" class="nav-link active">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7" />
            <rect x="14" y="3" width="7" height="7" />
            <rect x="14" y="14" width="7" height="7" />
            <rect x="3" y="14" width="7" height="7" />
          </svg>
          Dashboard
        </a>
        <a href="schedule.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2" />
            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />
          </svg>
          Horário Completo
        </a>
        <a href="announce.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9" />
            <path d="M13.73 21a2 2 0 01-3.46 0" />
          </svg>
          Solicitar Comunicado
        </a>
        <a href="profile.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
            <circle cx="12" cy="7" r="4" />
          </svg>
          Meu perfil
        </a>
      </nav>
      <footer class="sidebar-footer">
        <form method="POST" action="/auth/logout.php">
          <button type="submit" class="btn-logout">
            <svg viewBox="0 0 24 24">
              <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
              <polyline points="16 17 21 12 16 7" />
              <line x1="21" y1="12" x2="9" y2="12" />
            </svg>
            Terminar sessão
          </button>
        </form>
      </footer>
    </aside>
    <div class="main-wrap">
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
            GABnet &rsaquo; <strong>Painel de Professor</strong>
          </div>
        </section>
        <section class="topbar-right">
          <div class="topbar-date"><?= date('d/m/Y') ?></div>
          <a href="profile.php">
            <div class="topbar-avatar">A</div>
          </a>
        </section>
      </header>
      <main class="content">
        <section class="greeting">
          <div class="greeting-text">
            <?php $h=(int)date('H'); $greeting=$h<12?'Bom dia':($h<18?'Boa
            tarde':'Boa noite'); ?>
            <h1><?= $greeting ?>, <em>Prof. Antônio</em></h1>
            <p>Tens <strong>2</strong> aula(s) hoje (Dia). Bom trabalho!</p>
          </div>
          <a href="announce.php" class="announce-btn">
            <svg viewBox="0 0 24 24">
              <line x1="22" y1="2" x2="11" y2="13"/>
              <polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
            Solicitar anúncio
          </a>
        </section>
        <section class="stats-grid">
          <div class="stat-card blue">
            <div class="stat-icon blue">
              <svg viewBox="0 0 24 24">
                <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z" />
                <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z" />
              </svg>
            </div>
            <div class="stat-body">
              <strong>3</strong>
              <small>Disciplinas lecionadas</small>
            </div>
          </div>
          <div class="stat-card purple">
            <div class="stat-icon purple">
              <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                <circle cx="9" cy="7" r="4" />
                <path d="M23 21v-2a4 4 0 00-3-3.87" />
                <path d="M16 3.13a4 4 0 010 7.75" />
              </svg>
            </div>
            <div class="stat-body">
              <strong>4</strong>
              <small>Turmas atribuidas</small>
            </div>
          </div>
          <div class="stat-card green">
            <div class="stat-icon green">
              <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2" />
                <line x1="16" y1="2" x2="16" y2="6" />
                <line x1="8" y1="2" x2="8" y2="6" />
                <line x1="3" y1="10" x2="21" y2="10" />
              </svg>
            </div>
            <div class="stat-body">
              <strong>9</strong>
              <small>Aulas esta semana</small>
            </div>
          </div>
          <div class="stat-card orange">
            <div class="stat-icon orange">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <polyline points="12 6 12 12 16 14" />
              </svg>
            </div>
            <div class="stat-body">
              <strong>2</strong>
              <small>Total de aulas hoje</small>
            </div>
          </div>
        </section>
        <section class="main-grid">
          <div class="left-col">
            <section class="panel" id="schedule-panel" style="animation-delay: 0.25s">
              <div class="panel-header">
                <h2 class="panel-title">
                  <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2" />
                    <line x1="16" y1="2" x2="16" y2="6" />
                    <line x1="8" y1="2" x2="8" y2="6" />
                    <line x1="3" y1="10" x2="21" y2="10" />
                  </svg>
                  Horário semanal
                </h2>
                <a href="schedule.php" class="panel-link">
                  Ver completo
                  <svg viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6" />
                  </svg>
                </a>
              </div>
              <div class="days-nav">
                <button
                  class="day-btn today active"
                  onclick="showDay('', this)"
                  data-dia=""
                >
                  <span class="day-name">Segunda</span>
                  <span class="day-count">2 aulas</span>
                </button>
                <button class="day-btn" onclick="showDay('', this)" data-dia="">
                  <span class="day-name">Terça</span>
                  <span class="day-count">3 aulas</span>
                </button>
                <button class="day-btn" onclick="showDay('', this)" data-dia="">
                  <span class="day-name">Quarta</span>
                  <span class="day-count">1 aula</span>
                </button>
                <button class="day-btn" onclick="showDay('', this)" data-dia="">
                  <span class="day-name">Quinta</span>
                  <span class="day-count">2 aulas</span>
                </button>
                <button class="day-btn" onclick="showDay('', this)" data-dia="">
                  <span class="day-name">Sexta</span>
                  <span class="day-count">1 aula</span>
                </button>
              </div>
              <div class="classes-container">
                <div class="day-classes" id="dia-tal>">
                  <div class="class-row">
                    <div class="class-hour-col">
                      <span class="hour-start">09:00</span>
                      <div class="hour-sep"></div>
                      <span class="hour-end">11:30</span>
                    </div>
                    <div class="class-content">
                      <div class="class-main">
                        <strong>Electrotecnia</strong>
                        <span class="class-tag">
                          <svg viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                          </svg>
                          Turma 12INF - 1
                        </span>
                      </div>
                      <span class="class-badge b-active">Em curso</span>
                    </div>
                  </div>
                  <div class="class-row">
                    <div class="class-hour-col">
                      <span class="hour-start">09:00</span>
                      <div class="hour-sep"></div>
                      <span class="hour-end">11:30</span>
                    </div>
                    <div class="class-content">
                      <div class="class-main">
                        <strong>Introdução à Electrônica</strong>
                        <span class="class-tag">
                          <svg viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                          </svg>
                          Turma 11INF - 1
                        </span>
                      </div>
                      <span class="class-badge b-future">A seguir</span>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section class="panel" id="request-panel" style="animation-delay: 0.35s">
              <div class="panel-header">
                <h2 class="panel-title">  
                  <svg viewBox="0 0 24 24">
                    <line x1="22" y1="2" x2="11" y2="13"/>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                  </svg>
                  Solicitar anúncio
                </h2>
                <a href="announce.php" class="panel-link">
                    Fazer pedido
                    <svg viewBox="0 0 24 24">
                      <polyline points="9 18 15 12 9 6" />
                    </svg>
                </a>
              </div>
              <div class="requests-form">
                <div class="last-request pending">
                  <!--Aguarda Aprovação-->
                  <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                  </svg>
                  <!-- Aprovado
                    <svg viewBox="0 0 24 24">
                      <polyline points="20 6 9 17 4 12"/>
                    </svg>
                  -->
                  <!-- Rejeitado
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                  -->
                  <div>
                    <strong style="display:block; margin-bottom:2px; font-size:.78rem">
                      Aguarda Aprovação
                    </strong>
                    <span style="font-size:.73rem; opacity:.85">Aula Prática na Sexta-feira</span>
                  </div>
                </div>
                <form method="POST" action="solicitar-anuncio.php" id="form-solic">
                  <div class="form-field">
                    <label for="title">Título <span>*</span></label>
                    <input type="text" id="title" name="title" placeholder="Ex: Cancelamento de aulas..." maxlength="150" required/>
                  </div>
                  <div class="form-field">
                    <label for="imp">Importância <span>*</span></label>
                    <select id="imp" name="importancia" required>
                      <option value="" disabled selected>Selecionar...</option>
                      <option value="Baixa">Baixa</option>
                      <option value="Média">Média</option>
                      <option value="Alta">Alta</option>
                    </select>
                  </div>
                  <div class="form-field">
                    <label for="content">Mensagem <span>*</span></label>
                    <textarea id="content" name="content" placeholder="Descreve o conteúdo do anúncio..." maxlength="1000" required></textarea>
                  </div>
                  <div class="form-field include-parents-field">
                    <input type="checkbox" name="include-parents" id="include-parents"/>
                    <label for="include-parents">Incluir Encarregados?</label>
                  </div>
                  <button type="submit" class="btn-submit">
                    <svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    Enviar solicitação
                  </button>
                  <p class="form-note">Será publicado após aprovação do Administrador.</p>
                </form>
              </div>
            </section>
          </div>
          <div class="right-col">
            <section class="panel" id="announcements-panel" style="animation-delay: 0.45s">
              <div class="panel-header">
                <h2>
                  <svg viewBox="0 0 24 24">
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 01-3.46 0"/>
                  </svg>
                  Comunicados recentes
                </h2>
              </div>
              <div class="announcements-container">
                <div class="announce-item">
                  <div class="imp-dot high"></div>
                  <div class="announce-body">
                    <strong>Titulo do comunicado</strong>
                    <span>12/05/2026</span>
                  </div>
                  <span class="imp-label high">Alta</span>
                </div>
                <div class="announce-item">
                  <div class="imp-dot medium"></div>
                  <div class="announce-body">
                    <strong>Titulo do comunicado</strong>
                    <span>12/05/2026</span>
                  </div>
                  <span class="imp-label medium">Média</span>
                </div>
                <div class="announce-item">
                  <div class="imp-dot low"></div>
                  <div class="announce-body">
                    <strong>Titulo do comunicado</strong>
                    <span>12/05/2026</span>
                  </div>
                  <span class="imp-label low">Baixa</span>
                </div>
              </div>
            </section>
          </div>
        </section>
      </main>
    </div>
    <script src="/gabnet-system/assets/js/dashboard.js"></script>
    <script>
      function showDay(dia, btn) {
        document
          .querySelectorAll(".day-classes")
          .forEach((el) => el.classList.remove("visible"));
        document
          .querySelectorAll(".day-btn")
          .forEach((el) => el.classList.remove("active"));
        const p = document.getElementById("day-" + dia);
        if (p) p.classList.add("visible");
        btn.classList.add("active");
      }
    </script>
  </body>
</html>
