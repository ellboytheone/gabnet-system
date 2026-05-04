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
  <body class="admin">
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
          <strong>Pedro Manuel</strong>
          <small>Auxiliar Técnico</small>
          <div class="id-badge">
            <svg viewBox="0 0 24 24">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
              <path d="M6 12v5c3 3 9 3 12 0v-5" />
            </svg>
            Administrador
          </div>
        </div>
      </div>
      <span class="nav-section">Visão Geral</span>
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
        <span class="nav-section">Gestão</span>
        <a href="manage-accounts.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87"/>
            <path d="M16 3.13a4 4 0 010 7.75"/>
          </svg>
          Gerir Contas
        </a>
        <a href="classes.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/>
            <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>
          </svg>
          Turmas
        </a>
        <a href="schedules.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2" />
            <line x1="16" y1="2" x2="16" y2="6" />
            <line x1="8" y1="2" x2="8" y2="6" />
            <line x1="3" y1="10" x2="21" y2="10" />
          </svg>
          Horários
        </a>
        <span class="nav-section">Comunicação</span>
        <a href="create-announcement.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <line x1="22" y1="2" x2="11" y2="13"/>
            <polygon points="22 2 15 22 11 13 2 9 22 2"/>
          </svg>
          Criar Comunicado
        </a>
        <a href="announcement.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 01-3.46 0"/>
          </svg>
          Comunicados
          <span class="nav-badge">3</span>
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
            GABnet &rsaquo; <strong>Painel de Administrador</strong>
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
            <h1><?= $greeting ?>, <em>Sr. Pedro</em></h1>
            <p>Tens <strong>2</strong> solicitações pendentes.</p>
          </div>
          <a href="create-announcement.php" class="announce-btn">
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
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
            </div>
            <div class="stat-body">
              <strong>155</strong>
              <small>Alunos matriculados</small>
            </div>
          </div>
          <div class="stat-card purple">
            <div class="stat-icon purple">
              <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                <path d="M16 3.13a4 4 0 010 7.75"/>
              </svg>
            </div>
            <div class="stat-body">
              <strong>15</strong>
              <small>Professores ativos</small>
            </div>
          </div>
          <div class="stat-card green">
            <div class="stat-icon green">
              <svg viewBox="0 0 24 24">
                <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/>
                <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>
              </svg>
            </div>
            <div class="stat-body">
              <strong>31</strong>
              <small>Turmas registradas</small>
            </div>
          </div>
          <div class="stat-card orange">
            <div class="stat-icon orange">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
              </svg>
            </div>
            <div class="stat-body">
              <strong>5</strong>
              <small>Solicitações pendentes</small>
            </div>
          </div>
        </section>
        <section class="main-grid">
            <div class="left-col">
              <section class="panel" id="request-panel" style="animation-delay:.3s">
                <div class="panel-header">
                  <h2 class="panel-title">
                    <svg viewBox="0 0 24 24">
                      <circle cx="12" cy="12" r="10"/>
                      <line x1="12" y1="8" x2="12" y2="12"/>
                      <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    Solicitações pendentes de professores
                  </h2>
                  <a href="announcements.php" class="panel-link">
                    Ver todas
                    <svg viewBox="0 0 24 24">
                      <polyline points="9 18 15 12 9 6"/>
                    </svg>
                  </a>
                </div>
                <div class="request-item">
                  <span class="imp-label high">Alta</span>
                  <div class="request-body">
                    <strong>Visita de estudo ao Museu Nacional</strong>
                    <div class="request-meta">
                      <span>
                        <svg viewBox="0 0 24 24">
                          <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                          <circle cx="12" cy="7" r="4"/>
                        </svg>
                        Prof. António Calunga
                      </span>
                      <span>
                        <svg viewBox="0 0 24 24">
                          <rect x="3" y="4" width="18" height="18" rx="2"/>
                          <line x1="16" y1="2" x2="16" y2="6"/>
                          <line x1="8" y1="2" x2="8" y2="6"/>
                          <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        23/04/2026
                      </span>
                    </div>
                  </div>
                  <div class="request-actions">
                    <!-- Substituir action por form POST real para aprovar/rejeitar -->
                    <button
                      class="action-btn btn-aproove"
                      onclick="aprovarSolicita()"
                      title="Aprovar e publicar">
                      <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"/>
                      </svg>
                      Aprovar
                    </button>
                    <button
                      class="action-btn btn-deny"
                      onclick="rejeitarSolicita()"
                      title="Rejeitar solicitação">
                      <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                      </svg>
                      Rejeitar
                    </button>
                  </div>
                </div>
                <div class="request-item">
                  <span class="imp-label medium">Média</span>
                  <div class="request-body">
                    <strong>Cancelamento das aulas - Quinta-feira</strong>
                    <div class="request-meta">
                      <span>
                        <svg viewBox="0 0 24 24">
                          <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                          <circle cx="12" cy="7" r="4"/>
                        </svg>
                        Prof. Assunção Baptista
                      </span>
                      <span>
                        <svg viewBox="0 0 24 24">
                          <rect x="3" y="4" width="18" height="18" rx="2"/>
                          <line x1="16" y1="2" x2="16" y2="6"/>
                          <line x1="8" y1="2" x2="8" y2="6"/>
                          <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        28/04/2026
                      </span>
                    </div>
                  </div>
                  <div class="request-actions">
                    <!-- Substituir action por form POST real para aprovar/rejeitar -->
                    <button
                      class="action-btn btn-aproove"
                      onclick="aprovarSolicita()"
                      title="Aprovar e publicar">
                      <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"/>
                      </svg>
                      Aprovar
                    </button>
                    <button
                      class="action-btn btn-deny"
                      onclick="rejeitarSolicita()"
                      title="Rejeitar solicitação">
                      <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                      </svg>
                      Rejeitar
                    </button>
                  </div>
                </div>
                <div class="request-item">
                  <span class="imp-label low">Baixa</span>
                  <div class="request-body">
                    <strong>Entrega de provas trimestrais</strong>
                    <div class="request-meta">
                      <span>
                        <svg viewBox="0 0 24 24">
                          <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                          <circle cx="12" cy="7" r="4"/>
                        </svg>
                        Prof. Humberto Kibanzala
                      </span>
                      <span>
                        <svg viewBox="0 0 24 24">
                          <rect x="3" y="4" width="18" height="18" rx="2"/>
                          <line x1="16" y1="2" x2="16" y2="6"/>
                          <line x1="8" y1="2" x2="8" y2="6"/>
                          <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        28/04/2026
                      </span>
                    </div>
                  </div>
                  <div class="request-actions">
                    <!-- Substituir action por form POST real para aprovar/rejeitar -->
                    <button
                      class="action-btn btn-aproove"
                      onclick="aprovarSolicita()"
                      title="Aprovar e publicar">
                      <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"/>
                      </svg>
                      Aprovar
                    </button>
                    <button
                      class="action-btn btn-deny"
                      onclick="rejeitarSolicita()"
                      title="Rejeitar solicitação">
                      <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                      </svg>
                      Rejeitar
                    </button>
                  </div>
                </div>
              </section>
              <section class="panel" style="animation-delay:.35s">
                <div class="panel-header">
                  <h2 class="panel-title">
                    <svg viewBox="0 0 24 24">
                      <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                      <circle cx="9" cy="7" r="4"/>
                      <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                      <path d="M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                    Contas recentes
                  </h2>
                  <a href="manage-accounts.php" class="panel-link">
                    Gerir todas
                    <svg viewBox="0 0 24 24">
                      <polyline points="9 18 15 12 9 6"/>
                    </svg>
                  </a>
                </div>
                <div class="table-wrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Utilizador</th>
                        <th>Papel</th>
                        <th>Criado em</th>
                        <th>Acções</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="td-user">
                            <div class="td-avatar">E</div>
                            <div>
                              <span class="td-name">Emmanuel Mateus</span>
                              <span class="td-email">emmanuelmateus@gabnet.ao</span>
                            </div>
                          </div>
                        </td>
                        <td><span class="role-badge student">Estudante</span></td>
                        <td class="td-data">29/04/2026</td>
                        <td>
                          <div class="td-acts">
                            <a href="manage-accounts.php?edit=1">
                              <div class="icon-btn" title="Editar conta">
                                <svg viewBox="0 0 24 24">
                                  <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                  <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                              </div>
                            </a>
                            <div class="icon-btn danger" title="Eliminar conta" onclick="deleteAccount()">
                              <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                              </svg>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="td-user">
                            <div class="td-avatar">H</div>
                            <div>
                              <span class="td-name">Humberto Kibanzala</span>
                              <span class="td-email">kibanzala@gabnet.ao</span>
                            </div>
                          </div>
                        </td>
                        <td><span class="role-badge teacher">Professor</span></td>
                        <td class="td-data">11/04/2026</td>
                        <td>
                          <div class="td-acts">
                            <a href="manage-accounts.php?edit=2">
                              <div class="icon-btn" title="Editar conta">
                                <svg viewBox="0 0 24 24">
                                  <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                  <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                              </div>
                            </a>
                            <div class="icon-btn danger" title="Eliminar conta" onclick="deleteAccount()">
                              <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                              </svg>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <div class="td-user">
                            <div class="td-avatar">G</div>
                            <div>
                              <span class="td-name">Guilherme Alberto</span>
                              <span class="td-email">guilhermealberto@gabnet.ao</span>
                            </div>
                          </div>
                        </td>
                        <td><span class="role-badge student">Estudante</span></td>
                        <td class="td-data">07/04/2026</td>
                        <td>
                          <div class="td-acts">
                            <a href="manage-accounts.php?edit=3">
                              <div class="icon-btn" title="Editar conta">
                                <svg viewBox="0 0 24 24">
                                  <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                  <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                              </div>
                            </a>
                            <div class="icon-btn danger" title="Eliminar conta" onclick="deleteAccount()">
                              <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                              </svg>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </section>
            </div>
            <div class="right-col">
              <section class="panel" id="quick-actions-panel" style="animation-delay:.4s">
                <div class="panel-header">
                  <h2 class="panel-title">
                    <svg viewBox="0 0 24 24">
                      <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                    </svg>
                    Acções rápidas
                  </h2>
                </div>
                <div class="quick-actions">
                  <a href="create-announcement.php">
                    <div class="qa-btn">
                      <div class="qa-icon blue">
                        <svg viewBox="0 0 24 24">
                          <line x1="22" y1="2" x2="11" y2="13"/>
                          <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                        </svg>
                      </div>
                      <div class="qa-txt">
                        <strong>Criar comunicado</strong>
                        <span>Publicar aviso para a escola</span>
                      </div>
                      <div class="qa-arrow">
                        <svg viewBox="0 0 24 24">
                          <polyline points="9 18 15 12 9 6"/>
                        </svg>
                      </div>
                    </div>
                  </a>
                  <a href="manage-accounts.php?act=new">
                    <div class="qa-btn">
                      <div class="qa-icon green">
                        <svg viewBox="0 0 24 24">
                          <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/>
                          <circle cx="9" cy="7" r="4"/>
                          <line x1="19" y1="8" x2="19" y2="14"/>
                          <line x1="22" y1="11" x2="16" y2="11"/>
                        </svg>
                      </div>
                      <div class="qa-txt">
                        <strong>Criar conta</strong>
                        <span>Registar aluno ou professor</span>
                      </div>
                      <div class="qa-arrow">
                        <svg viewBox="0 0 24 24">
                          <polyline points="9 18 15 12 9 6"/>
                        </svg>
                      </div>
                    </div>
                  </a>
                  <a href="classes.php?act=new">
                    <div class="qa-btn">
                      <div class="qa-icon yellow">
                        <svg viewBox="0 0 24 24">
                          <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/>
                          <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>
                        </svg>
                      </div>
                      <div class="qa-txt">
                        <strong>Nova turma</strong>
                        <span>Criar turma e definir período</span>
                      </div>
                      <div class="qa-arrow">
                        <svg viewBox="0 0 24 24">
                          <polyline points="9 18 15 12 9 6"/>
                        </svg>
                      </div>
                    </div>
                  </a>
                  <a href="schedules.php?act=new">
                    <div class="qa-btn">
                      <div class="qa-icon purple">
                        <svg viewBox="0 0 24 24">
                          <rect x="3" y="4" width="18" height="18" rx="2"/>
                          <line x1="16" y1="2" x2="16" y2="6"/>
                          <line x1="8" y1="2" x2="8" y2="6"/>
                          <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                      </div>
                      <div class="qa-txt">
                        <strong>Definir horário</strong>
                        <span>Atribuir aula a turma</span>
                      </div>
                      <div class="qa-arrow">
                        <svg viewBox="0 0 24 24">
                          <polyline points="9 18 15 12 9 6"/>
                        </svg>
                      </div>
                    </div>
                  </a>
                  <a href="manage-accounts.php">
                    <div class="qa-btn">
                      <div class="qa-icon gray">
                        <svg viewBox="0 0 24 24">
                          <circle cx="12" cy="12" r="3"/>
                          <path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/>
                        </svg>
                      </div>
                      <div class="qa-txt">
                        <strong>Gerir todas as contas</strong>
                        <span>Ver, editar, suspender</span>
                      </div>
                      <div class="qa-arrow">
                        <svg viewBox="0 0 24 24">
                          <polyline points="9 18 15 12 9 6"/>
                        </svg>
                      </div>
                    </div>
                  </a>
                </div>
              </section>
            </div>
        </section>
      </main>
    </div>
    <script src="/gabnet-system/assets/js/dashboard.js"></script>
    </body>
</html>