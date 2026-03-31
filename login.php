<!doctype html>
<html lang="pt-PT">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio de Sessão - GABnet</title>
    <link rel="stylesheet" href="../tcc-web-system/css/styles.css" />
  </head>
  <body>
    <header>
      <nav id="header-nav">
        <a href="../tcc-web-system/index.html">Voltar ao início</a>
        <img src="../tcc-web-system/assets/images/gabnet-logo.png" alt="Logo do GABnet" />
        <a href="../tcc-web-system/signin.php" class="change-auth-link">Registrar</a>
      </nav>
    </header>
    <main>
      <h2>Iniciar Sessão</h2>
      <form action="../tcc-web-system/auth/login.php" method="POST">
        <div class="input-box">
          <label for="email">E-mail</label>
          <input type="email" name="login-email" id="email" required />
        </div>
        <div class="input-box">
          <label for="password">Senha:</label>
          <input type="password" name="login-password" id="password" required />
        </div>
        <a href="../tcc-web-system/recover.php"> Esqueceste a senha? </a>
        <br />
        <button type="submit">Iniciar</button>
        <br />
      </form>
      <p>
        Nunca te registraste?
        <a href="../tcc-web-system/signin.php" id="signin-link">Registrar</a>
      </p>
    </main>
    <footer>
      <p>&copy;2026 Todos os direitos reservados - Sistema GABnet</p>
    </footer>
    <script src="../tcc-web-system/js/script.js"></script>
  </body>
</html>
