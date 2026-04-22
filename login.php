 

<?php

/*
session_start();
if (isset($_SESSION['usuario_id'])) {
    switch ($_SESSION['papel']) {
        case 'Administrador': header('Location: dashboard/adm/index.php');       exit;
        case 'Professor':     header('Location: dashboard/professor/index.php'); exit;
        case 'Estudante':     header('Location: dashboard/aluno/index.php');     exit;
    }
} 

/* ── 2. Ligação à base de dados ──────────────────────────────── 
require_once 'config/db.php';
/*
   Conteúdo esperado de config/db.php:
   -------------------------------------------------------
   
   $host   = 'localhost';
   $dbname = 'gabnet_system';
   $user   = 'root';
   $pass   = '';

   try {
       $pdo = new PDO(
           "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
           $user, $pass,
           [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
       );
   } catch (PDOException $e) {
       die('Erro de ligação: ' . $e->getMessage());
   }
   ------------------------------------------------------- */

$error     = '';
$email_val = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = trim($_POST['password'] ?? '');
    if (empty($email) || empty($password)) {
        $error = 'Por favor, preenche o email e a password.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'O formato do email não é válido.';
    } else {

        $stmt = $pdo->prepare('
            SELECT id, nome, email, password, papel, status
            FROM usuario
            WHERE email = ?
            LIMIT 1
        ');
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if (!$usuario || !password_verify($password, $usuario['password'])) {
            $error = 'Email ou password incorrectos. Verifica os dados e tenta novamente.';
            $email_val = htmlspecialchars($email);
        } else {
            session_regenerate_id(true); 

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome']       = $usuario['nome'];
            $_SESSION['email']      = $usuario['email'];
            $_SESSION['papel']      = $usuario['papel'];

            switch ($usuario['papel']) {
                case 'Administrador': header('Location: dashboard/adm/index.php');       exit;
                case 'Professor':     header('Location: dashboard/professor/index.php'); exit;
                case 'Estudante':     header('Location: dashboard/aluno/index.php');     exit;
                default:
                    $error = 'Tipo de conta não reconhecido. Contacta o administrador.';
            }
        }
    }
}
?>
<!doctype html>
<html lang="pt-PT">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="assets/images/favicon.ico"
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
    <link rel="stylesheet" href="assets/css/auth.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
    <title>GABnet Portal de Informações</title>
  </head>
  <body>
    <section class="left-panel">
      <div class="grid-bg"></div>
      <span class="left-logo">
          <div class="logo-wrap">
            <img
              src="assets/images/gabnet-logo.png"
              alt="Logo de GABnet"
              class="logo"
            />
            <div class="logo-txt">
              <strong>GABnet</strong>
              <small>Portal de Informações Escolares</small>
            </div>
          </div>
      </span>
      <section class="left-copy">
        <span class="eyebrow">Instituto GAB do Saber</span>
        <h1>A tua escola,<br><em>sempre consigo</em></h1>
        <p>Acede a horários, comunicados e informações académicas a qualquer momento — em qualquer dispositivo.</p>
        <section class="features">
          <section class="feature-item">
            <span class="feat-icon">
              <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
            </span>
            <div class="feat-txt">
              <strong>Horários actualizados</strong>
              <small>Consulta o teu horário semanal a qualquer momento</small>
            </div>
          </section>
          <section class="feature-item">
            <span class="feat-icon">
              <svg viewBox="0 0 24 24">
                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 01-3.46 0"/>
              </svg>
            </span>
            <div class="feat-txt">
              <strong>Comunicados instantâneos</strong>
              <small>Recebe avisos importantes da escola em tempo real</small>
            </div>
          </section>
          <section class="feature-item">
            <span class="feat-icon">
              <svg viewBox="0 0 24 24">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
              </svg>
            </span>
            <div class="feat-txt">
              <strong>Acesso seguro e privado</strong>
              <small>Dados protegidos com autenticação por papel</small>
            </div>
          </section>
        </section>
      </section>
      <footer class="left-footer">
        &copy; 2026 Instituto Politécnico Privado GAB do Saber · Luanda, Angola
      </footer>
    </section>
    <main class="right-panel">
      <a href="../gabnet-system/" class="back-link">
        <svg viewBox="0 0 24 24">
          <line x1="19" y1="12" x2="5" y2="12"/>
          <polyline points="12 19 5 12 12 5"/>
        </svg>
        Voltar ao portal
      </a>
      <section class="form-head">
        <span class="tag">Área restrita</span>
        <h2>Iniciar sessão</h2>
        <p>Introduz as tuas credenciais para aceder ao teu painel pessoal.</p>
      </section>
      <?php if (!empty($error)): ?>
        <div class="alert alert-error" role="alert" aria-live="assertive">
          <svg viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          <span><?= $error?></span>
        </div>
      <?php endif; ?>
      <form method="POST" action="auth/login-auth.php" id="login-form">
        <div class="form-body">
          <div class="field">
            <label for="email">
              Endereço de email <span aria-hidden="true">*</span>
            </label>
            <div class="input-wrap">
              <svg class="input-icon" viewBox="0 0 24 24">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
              </svg>
              <input
                type="email"
                id="email"
                name="email"
                value="<?= htmlspecialchars($email_val) ?>"
                placeholder="exemplo@gabnet.ao"
                autocomplete="email"
                required
                <?= !empty($error) ? 'class="error"' : '' ?>
              />
            </div>
          </div>
          <div class="field">
            <label for="password">
              Senha <span aria-hidden="true">*</span>
            </label>
            <div class="input-wrap">
              <svg class="input-icon" viewBox="0 0 24 24">
                <rect x="3" y="11" width="18" height="11" rx="2"/>
                <path d="M7 11V7a5 5 0 0110 0v4"/>
              </svg>
              <input
                type="password"
                id="password"
                name="password"
                placeholder="A tua senha"
                autocomplete="current-password"
                required
                <?= !empty($error) ? 'class="error"' : '' ?>
              />
              <button"
                type="button"
                class="toggle-password"
                id="toggle-password"
                aria-label="Mostrar ou ocultar senha"
                onclick="togglePassword()"
              >
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
          <button type="submit" class="btn-login" id="btn-login">
            <div class="spinner"></div>
            <span class="btn-txt">Entrar na minha conta</span>
            <svg class="btn-arrow" viewBox="0 0 24 24">
              <path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/>
              <polyline points="10 17 15 12 10 7"/>
              <line x1="15" y1="12" x2="3" y2="12"/>
            </svg>
          </button>
        </div>
      </form>
      <div class="divider">acesso por tipo de conta</div>
      <!-- Info dos perfis -->
      <section class="perfis-info">
        <ul>
          <li class="perfil-pill">
            <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            <small>Aluno</small>
          </li>
          <li class="perfil-pill">
            <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            <small>Professor</small>
          </li>
          <li class="perfil-pill">
            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <small>Administrador</small>
          </li>
        </ul>
      </section>

      <!-- Rodapé do formulário -->
      <footer class="form-footer" style="margin-top:24px;">
        <p>
          Problemas com o acesso?
          <strong>Contacta a secretaria da escola</strong>
        </p>
      </footer>
      <script src="assets/js/auth.js">
        <?php if (!empty($error)): ?>
          document.getElementById('password').value = '';
          document.getElementById('email').focus();
        <?php else: ?>
          document.getElementById('email').focus();
        <?php endif; ?>
      </script>
    </main>


    <!-- ── JavaScript ─────────────────────────────────────────────── -->
    <script>
      /* Mostrar / ocultar senha */
      function toggleSenha() {
        const input   = document.getElementById('senha');
        const eyeOn   = document.getElementById('icon-eye');
        const eyeOff  = document.getElementById('icon-eye-off');
        const visivel = input.type === 'password';
        input.type    = visivel ? 'text' : 'password';
        eyeOn.style.display  = visivel ? 'none'  : 'block';
        eyeOff.style.display = visivel ? 'block' : 'none';
      }

      /* Estado loading no botão ao submeter */
      document.getElementById('login-form').addEventListener('submit', function (e) {
        const email = document.getElementById('email').value.trim();
        const senha = document.getElementById('senha').value.trim();

        /* Validação client-side rápida antes de enviar */
        if (!email || !senha) {
          e.preventDefault();
          marcarErro('email', !email);
          marcarErro('senha', !senha);
          return;
        }

        /* Activa estado de loading */
        const btn = document.getElementById('btn-login');
        btn.classList.add('loading');
        btn.setAttribute('disabled', 'true');
      });

      function marcarErro(id, temErro) {
        const el = document.getElementById(id);
        if (temErro) el.classList.add('erro');
        else         el.classList.remove('erro');
      }

      /* Remove classe de erro ao começar a escrever */
      ['email', 'senha'].forEach(function (id) {
        document.getElementById(id).addEventListener('input', function () {
          this.classList.remove('erro');
        });
      });

      /* Auto-foco no primeiro campo com erro, ou no email */
      <?php if (!empty($erro)): ?>
        document.getElementById('senha').value = '';
        document.getElementById('email').focus();
      <?php else: ?>
        document.getElementById('email').focus();
      <?php endif; ?>
    </script>

    </main>
  </body>
</html>
