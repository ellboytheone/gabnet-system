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
    <link rel="stylesheet" href="/gabnet-system/assets/css/profile.css">
    <link rel="stylesheet" href="/gabnet-system/assets/css/dashboard.css">
    <link rel="stylesheet" href="/gabnet-system/assets/css/styles.css" />
    <title>Meu Perfil - GABnet</title>
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
          <small>12ª Classe</small>
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
        <a href="schedule.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
          Horário
        </a>
        <a href="profile.php" class="nav-link active">
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
            GABnet &rsaquo; <a href="index.php">Painel de Estudante</a> &rsaquo; <strong>Meu Perfil</strong>
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
          <h1>
            Seu <em>perfil</em>
          </h1>
          <p>Consulta os teus dados académicos e gere as informações da tua conta.</p>
        </header>
        <section class="my-data-section">
          <div class="panel">
            <div class="panel-header">
              <h2 class="locked">
                <svg viewBox="0 0 24 24">
                  <rect x="3" y="11" width="18" height="11" rx="2"/>
                  <path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
                Dados académicos
              </h2>
              <span class="panel-header-text locked-pill">Só leitura</span>
            </div>
            <div class="panel-body">
              <div class="readonly-grid">
                <div class="ro-field ro-full">
                  <div class="ro-label">
                    <svg viewBox="0 0 24 24">
                      <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                      <circle cx="12" cy="7" r="4"/>
                    </svg>
                    Nome completo
                  </div>
                  <div class="ro-value">Emmanuel Roberto Muhongo Campos Mateus</div>
                </div>
                <div class="ro-field">
                  <div class="ro-label">
                    <svg viewBox="0 0 24 24">
                      <line x1="9" y1="18" x2="15" y2="18"/>
                      <line x1="12" y1="2" x2="12" y2="22"/>
                    </svg>
                    N.º de inscrição
                  </div>
                  <div class="ro-value">INF-2022-001</div>
                </div>
                <div class="ro-field">
                  <div class="ro-label">
                    <svg viewBox="0 0 24 24">
                      <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/>
                      <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>
                    </svg>
                    Turma
                  </div>
                  <div class="ro-value">12ª Informática</div>
                </div>
                <div class="ro-field">
                  <div class="ro-label">
                    <svg viewBox="0 0 24 24">
                      <circle cx="12" cy="12" r="10"/>
                      <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    Período
                  </div>
                  <div class="ro-value">Manhã</div>
                </div>
                <div class="ro-field">
                  <div class="ro-label">
                    <svg viewBox="0 0 24 24">
                      <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                      <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    Email do encarregado
                  </div>
                  <div class="ro-value">encarregado@email.com</div>
                </div>
                <div class="ro-field">
                  <div class="ro-label">
                    <svg viewBox="0 0 24 24">
                      <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 .93h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 8.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                    </svg>
                    Telefone do encarregado
                  </div>
                  <div class="ro-value">+244 923 456 789</div>
                </div>
              </div>
              <div class="block-notice">
                <svg viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="10"/>
                  <line x1="12" y1="8" x2="12" y2="12"/>
                  <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                Estes dados são geridos pela secretaria da escola. Para corrigir qualquer informação, contacta o administrador do sistema ou diriges-te pessoalmente à secretaria.
              </div>
            </div>
          </div>
          <div class="panel identity-card">
            <div class="id-banner">
              <div class="id-avatar">E</div>
            </div>
            <div class="id-body">
              <div class="id-name">Emmanuel Mateus</div>
              <div class="id-email">emmnanuelmateus@gabnet.ao</div>
              <div class="id-divider"></div>

              <div class="id-field">
                <span class="id-field-label">Inscrição</span>
                <span class="id-field-val">INF-2022-001</span>
              </div>
              <div class="id-field">
                <span class="id-field-label">Classe</span>
                <span class="id-field-val">12ª Classe</span>
              </div>
              <div class="id-field">
                <span class="id-field-label">Turma</span>
                <span class="id-field-val">12ª Informática</span>
              </div>
              <div class="id-field">
                <span class="id-field-label">Período</span>
                <span class="id-field-val">Manhã</span>
              </div>

              <div class="card-id-badge">Conta activa</div>
              <div class="id-since">Membro desde 12/04/2026</div>

              <div class="lock-notice">
                <svg viewBox="0 0 24 24">
                  <rect x="3" y="11" width="18" height="11" rx="2"/>
                  <path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
                Dados académicos geridos pela secretaria. Contacta o administrador para alterações.
              </div>
            </div>
          </div>
        </section>
        <section class="panel edit-email">
          <div class="panel-header">
            <h2>
              <svg viewBox="0 0 24 24">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
              </svg>
              Alterar endereço de email
            </h2>
            <span class="panel-header-text editable-pill">Editável</span>
          </div>
          <div class="panel-body">
            <?php if (!empty($msg_email)): ?>
            <div class="alert alert-<?= $tipo_email ?>" role="alert">
              <svg viewBox="0 0 24 24">
                <?php if ($tipo_email === 'ok'): ?>
                  <polyline points="20 6 9 17 4 12"/>
                <?php elseif ($tipo_email === 'aviso'): ?>
                  <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                  <line x1="12" y1="9" x2="12" y2="13"/>
                  <line x1="12" y1="17" x2="12.01" y2="17"/>
                <?php else: ?>
                  <circle cx="12" cy="12" r="10"/>
                  <line x1="12" y1="8" x2="12" y2="12"/>
                  <line x1="12" y1="16" x2="12.01" y2="16"/>
                <?php endif; ?>
              </svg>
              <?= htmlspecialchars($msg_email) ?>
            </div>
            <?php endif; ?>
            <form method="POST" action="profile.php" id="form-email">
              <input type="hidden" name="act" value="alterar_email"/>
              <div class="form-grid">
                <div class="field">
                  <label>Email actual</label>
                  <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24">
                      <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                      <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    <input type="email" value="emmanuelmateus@gabnet.ao" disabled style="opacity:.6;cursor:not-allowed"/>
                  </div>
                </div>
                <div class="field">
                  <label for="new_email">Novo email <span>*</span></label>
                  <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24">
                      <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                      <polyline points="22,6 12,13 2,6"/>
                    </svg>
                    <input type="email" id="new_email" name="new_email" placeholder="novo@email.com" required autocomplete="email"/>
                  </div>
                </div>
                <div class="field">
                  <label for="pw_confirm_email">Confirmar com a senha actual <span>*</span></label>
                  <small>Precisamos da tua senha para confirmar esta alteração</small>
                  <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24">
                      <rect x="3" y="11" width="18" height="11" rx="2"/>
                      <path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                    <input type="password" id="pw_confirm_email" name="pw_confirm" placeholder="A tua senha actual" required autocomplete="current-password"/>
                    <button type="button" class="eye-btn" id="confirm-email-toggle" onclick="togglePassword()" aria-label="Mostrar senha">
                      <svg id="icon-eye" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                      </svg>
                      <svg id="icon-eye-off" viewBox="0 0 24 24" style="display:none">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/>
                        <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <div class="form-footer-row">
                <span class="form-note">O email é usado para aceder ao sistema.</span>
                <button type="submit" class="btn-save" id="btn-email">
                  <svg viewBox="0 0 24 24">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                  Guardar email
                </button>
              </div>
            </form>
          </div>
        </section>
        <section class="panel edit-password">
          <div class="panel-header">
            <h2>
              <svg viewBox="0 0 24 24">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
              </svg>
              Alterar senha
            </h2>
            <span class="panel-header-text editable-pill">Editável</span>
          </div>
          <div class="panel-body">
            <?php if (!empty($msg_senha)): ?>
            <div class="alert alert-<?= $tipo_senha ?>" role="alert">
              <svg viewBox="0 0 24 24">
                <?php if ($tipo_senha === 'ok'): ?>
                  <polyline points="20 6 9 17 4 12"/>
                <?php elseif ($tipo_senha === 'aviso'): ?>
                  <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                  <line x1="12" y1="9" x2="12" y2="13"/>
                  <line x1="12" y1="17" x2="12.01" y2="17"/>
                <?php else: ?>
                  <circle cx="12" cy="12" r="10"/>
                  <line x1="12" y1="8" x2="12" y2="12"/>
                  <line x1="12" y1="16" x2="12.01" y2="16"/>
                <?php endif; ?>
              </svg>
              <?= htmlspecialchars($msg_senha) ?>
            </div>
            <?php endif; ?>
            <form method="POST" action="profile.php" id="form-senha">
              <input type="hidden" name="acao" value="alterar_senha"/>
              <div class="form-grid">

                <div class="field">
                  <label for="senha_actual">Senha actual <span>*</span></label>
                  <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24">
                      <rect x="3" y="11" width="18" height="11" rx="2"/>
                      <path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                    <input type="password" id="actual_password" name="senha_actual" placeholder="A tua senha actual" required autocomplete="current-password"/>
                    <button type="button" class="eye-btn" onclick="togglePassword('actual_password', this.id)" aria-label="Mostrar senha">
                      <svg id="icon-eye" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                      </svg>
                      <svg id="icon-eye-off" viewBox="0 0 24 24" style="display:none">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/>
                        <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                      </svg>
                    </button>
                  </div>
                </div>

                <div class="field">
                  <label for="nova_senha">Nova senha <span>*</span></label>
                  <small>Mínimo de 6 caracteres</small>
                  <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24">
                      <rect x="3" y="11" width="18" height="11" rx="2"/>
                      <path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                    <input type="password" id="new_password" name="nova_senha" placeholder="Cria uma nova senha" required autocomplete="new-password" oninput="avaliarForca(this.value)"/>
                    <button type="button" class="eye-btn" onclick="togglePassword('new_password',this.id)" aria-label="Mostrar senha">
                      <svg id="eye3a" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                      </svg>
                      <svg id="eye3b" viewBox="0 0 24 24" style="display:none">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/>
                        <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                      </svg>
                    </button>
                  </div>
                  <div class="strength-wrap" id="strength-wrap" style="display:none">
                    <div class="strength-bar">
                      <div class="strength-seg" id="seg1"></div>
                      <div class="strength-seg" id="seg2"></div>
                      <div class="strength-seg" id="seg3"></div>
                      <div class="strength-seg" id="seg4"></div>
                    </div>
                    <div class="strength-label" id="strength-label"></div>
                  </div>
                </div>

                <div class="field">
                  <label for="confirmar_senha">Confirmar nova senha <span>*</span></label>
                  <div class="input-wrap">
                    <svg class="input-icon" viewBox="0 0 24 24">
                      <rect x="3" y="11" width="18" height="11" rx="2"/>
                      <path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                    <input type="password" id="confirm_password" name="confirmar_senha" placeholder="Repete a nova senha" required autocomplete="new-password" oninput="verificarCoinc()"/>
                    <button type="button" class="eye-btn" onclick="togglePassword('confirm_password', this.id)" aria-label="Mostrar senha">
                      <svg id="eye4a" viewBox="0 0 24 24">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                      </svg>
                      <svg id="eye4b" viewBox="0 0 24 24" style="display:none">
                        <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94"/>
                        <path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                      </svg>
                    </button>
                  </div>
                </div>

              </div>
              <div class="form-footer-row">
                <span class="form-note">Usa uma senha que não uses noutros serviços.</span>
                <button type="submit" class="btn-save" id="btn-senha">
                  <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                  Alterar senha
                </button>
              </div>
            </form>
          </div>
        </section>
      </main>
    </div>
  </body>
</html>