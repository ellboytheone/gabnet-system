
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
    <link rel="stylesheet" href="/gabnet-system/assets/css/schedule.css">
    <link rel="stylesheet" href="/gabnet-system/assets/css/dashboard.css">
    <link rel="stylesheet" href="/gabnet-system/assets/css/styles.css" />
    <title>Horário - GABnet</title>
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
        <a href="announcements.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 01-3.46 0"/>
          </svg>
          Comunicados
          <span class="nav-badge">1</span>
        </a>
        <a href="schedule.php" class="nav-link active">
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
            GABnet &rsaquo; <a href="index.php">Painel de Estudante</a> &rsaquo; <strong>Horário</strong>
          </div>
        </section>
        <section class="topbar-right">
          <div class="topbar-date">
            <?= date('d/m/Y') ?>
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
          <h1>O teu <em>horário</em></h1>
          <p>12ª Informática · Período da Manhã · 13 aulas semanais</p>
        </header>
        <section class="next-lesson-card">
          <div class="nl-icon">
            <svg viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10"/>
              <polyline points="12 6 12 12 16 14"/>
            </svg>
          </div>
          <div class="nl-info">
            <div class="nl-label">Próxima aula</div>
            <div class="nl-disc">Electrotecnia</div>
            <div class="nl-meta">Prof. António Calunga</div>
          </div>
          <div class="nl-hour">
            <strong>09:00</strong>
            <span>até 10:30</span>
          </div>
        </section>
        <section class="current-lesson-card" style="display: none;">
          <div class="cl-pulse">
            <svg viewBox="0 0 24 24">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
              <path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
          </div>
          <div class="cl-info">
            <div class="cl-label">Aula em curso agora</div>
            <div class="cl-disc">Matemática</div>
            <div class="cl-meta">Prof. Humberto Kibanzala</div>
          </div>
          <div class="cl-hour">
            <strong id="hour-live"><?= date('H:i') ?></strong>
            <span>09:00 – 10:30</span>
          </div>
        </section>
        <div class="main-grid schedule">
          <section class="view-bar" style="display: none;">
            <div class="view-toggle">
              <a href="?view=week">
                <button class="vt-btn active">
                  <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                  </svg>
                  Semana
                </button>
              </a>
              <a href="?view=day&day=Segunda">
                <button class="vt-btn">
                  <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                  </svg>
                  Dia
                </button>
              </a>
            </div>
          </section>
          <section class="panel" id="schedule-panel">
            <div class="schedule-container">
              <div class="panel-header">
                <h2>
                  <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                  </svg>
                  12.ª Informática - Horário semanal 
                </h2>
                <p class="panel-header-text">
                  13 aulas · 5 disciplinas 
                </p>
              </div>
              <div class="week-grid-wrap">
                <div class="week-grid">
                  <div class="wg-header today">
                    Segunda
                    <span class="today-dot"></span>
                  </div>
                  <div class="wg-header">
                    Terça
                  </div>
                  <div class="wg-header">
                    Quarta
                  </div>
                  <div class="wg-header">
                    Quinta
                  </div>
                  <div class="wg-header">
                    Sexta
                  </div>

                  <div class="week-day-col today">
                    <div class="wd-lesson active">
                      <div class="wd-lesson-discipline">Matemática</div>
                      <div class="wd-lesson-teacher">Prof. Humberto Kibanzala</div>
                      <div class="wd-lesson-hour">07:30-09:00</div>
                      <div class="now-badge">
                        <span class="now-dot"></span>Agora
                      </div> 
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Base de Dados</div>
                      <div class="wd-lesson-teacher">Prof. Timóteo José</div>
                      <div class="wd-lesson-hour">09:30-11:00</div>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Electrotecnia</div>
                      <div class="wd-lesson-teacher">Prof. António Calunga</div>
                      <div class="wd-lesson-hour">11:30-13:00</div>
                    </div>
                  </div>
                  <div class="week-day-col">
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Matemática</div>
                      <div class="wd-lesson-teacher">Prof. Humberto Kibanzala</div>
                      <div class="wd-lesson-hour">07:30-09:00</div>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Electrotecnia</div>
                      <div class="wd-lesson-teacher">Prof. António Calunga</div>
                      <div class="wd-lesson-hour">11:30-13:00</div>
                    </div>
                  </div>
                  <div class="week-day-col">
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Matemática</div>
                      <div class="wd-lesson-teacher">Prof. Humberto Kibanzala</div>
                      <div class="wd-lesson-hour">07:30-09:00</div>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Base de Dados</div>
                      <div class="wd-lesson-teacher">Prof. Timóteo José</div>
                      <div class="wd-lesson-hour">09:30-11:00</div>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Electrotecnia</div>
                      <div class="wd-lesson-teacher">Prof. António Calunga</div>
                      <div class="wd-lesson-hour">11:30-13:00</div>
                    </div>
                  </div>
                  <div class="week-day-col">
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Matemática</div>
                      <div class="wd-lesson-teacher">Prof. Humberto Kibanzala</div>
                      <div class="wd-lesson-hour">07:30-09:00</div>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Electrotecnia</div>
                      <div class="wd-lesson-teacher">Prof. António Calunga</div>
                      <div class="wd-lesson-hour">11:30-13:00</div>
                    </div>
                  </div>
                  <div class="week-day-col">
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Matemática</div>
                      <div class="wd-lesson-teacher">Prof. Humberto Kibanzala</div>
                      <div class="wd-lesson-hour">07:30-09:00</div>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Base de Dados</div>
                      <div class="wd-lesson-teacher">Prof. Timóteo José</div>
                      <div class="wd-lesson-hour">09:30-11:00</div>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Electrotecnia</div>
                      <div class="wd-lesson-teacher">Prof. António Calunga</div>
                      <div class="wd-lesson-hour">11:30-13:00</div>
                    </div>
                  </div>

                  <div class="week-footer-cell">
                    <span>3</span> aulas
                  </div>
                  <div class="week-footer-cell">
                    <span>2</span> aulas
                  </div>
                  <div class="week-footer-cell">
                    <span>3</span> aulas
                  </div>
                  <div class="week-footer-cell">
                    <span>2</span> aulas
                  </div>
                  <div class="week-footer-cell">
                    <span>3</span> aulas
                  </div>
                </div>
              </div>
              <div style="height: 25px;"></div>
            </div>
          </section>
        </div>
      </main>
    </div>
  </body>
</html>