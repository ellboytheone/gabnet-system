<!doctype html>
<html lang="pt-PT">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro - GABnet</title>
    <link rel="stylesheet" href="../tcc-web-system/css/styles.css" />
  </head>
  <body>
    <header>
      <nav id="header-nav">
        <a href="../tcc-web-system/index.html">Voltar ao início</a>
        <img src="../tcc-web-system/assets/images/gabnet-logo.png" alt="Logo do GABnet" />
        <a href="../tcc-web-system/login.php" class="change-auth-link">Iniciar Sessão</a>
      </nav>
    </header>
    <main>
        <h2>Registrar</h2>
        <form action="../tcc-web-system/auth/signin.php" method="POST">
          <div class="input-box">
            <label for="first-name">Primeiro nome</label>
            <input type="text" name="first-name" id="first-name" />
          </div>
          <div class="input-box">
            <label for="last-name">Último nome</label>
            <input type="text" name="last-name" id="last-name" />
          </div>
          <div class="input-box">
            <label for="sign-email">E-mail:</label>
            <input type="email" name="sign-email" id="sign-email" required />
          </div>
          <div class="input-box">
            <label for="sign-password">Senha:</label>
            <input
              type="password"
              name="signpassword"
              id="sign-password"
              required
            />
          </div>
          <div id="sign-code-box">
            <label for="sign-code">Código de Registro:</label>
            <br />
            <input
              type="text"
              name="sign-code"
              id="sign-code"
              maxlength="8"
              minlength="8"
              required
            />
          </div>
          <button onclick="toggleAuth()" type="submit">Registrar</button>
        </form>
        <p>
          Já tens conta?
          <a href="javascript:void(0)" class="change-auth-links" id="login-link"
            >Entrar</a
          >
        </p>
    </main>
  </body>
</html>