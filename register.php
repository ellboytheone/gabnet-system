<?php
  $step = 1;   
  $email_step = '';
  $msg = '';
  $msg_type = '';
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
    <title>Registrar - GABnet</title>
  </head>
  <body>
    <section class="left-panel">
      <div class="grid-bg"></div>
      <figure class="left-logo">
          <div class="logo-wrap">
            <img
              src="assets/images/gabnet-logo.png"
              alt="Logo de GABnet"
              class="logo"
            />
            <figcaption class="logo-txt">
              <strong>GABnet</strong>
              <small>Portal de Informações Escolares</small>
            </figcaption>
          </div>
      </figure>
      <section class="left-copy">
        <h1>Activa a tua<br/><em>conta escolar</em></h1>
        <p>O teu acesso ao portal foi preparado pela secretaria. Segue os passos para definir a tua senha e começar a usar o GABnet.</p>
        <section class="steps-visual">
          <ol>
            <li class="sv-step" id="sv-1">
              <span class="sv-num" id="svn-1">1</span>
              <div class="sv-txt">
                <strong>Verificar o email</strong>
                <small>Insere o email que a escola te forneceu. Enviaremos um código de activação para confirmares a tua identidade.</small>
              </div>
            </li>
            <li class="sv-step" id="sv-2">
              <span class="sv-num" id="svn-2">2</span>
              <div class="sv-txt">
                <strong>Definir senha e activar</strong>
                <small>Insere o código recebido e escolhe a tua senha de acesso ao portal GABnet.</small>
              </div>
            </li>
          </ol>
        </section>
      </section>
      <footer class="left-footer">
        <p>Já registraste a tua conta? <a href="login.php">Inicia sessão &rarr;</a></p>
      </footer>
    </section>
    <main class="right-panel">
      <section class="stepper">
        <ol>
          <li class="step-node" id="node-1">
            <div class="sn-circle" id="circle-1">1</div>
            <span class="sn-label">Email</span>
          </li>
          <li class="step-node" id="node-2">
            <div class="sn-circle" id="circle-2">2</div>
            <span class="sn-label">Activação</span>
          </li>
        </ol>
      </section>

      <?php if (!empty($msg)): ?>
      <div class="reg-alert reg-alert-<?= $msg_type ?>">
        <svg viewBox="0 0 24 24">
          <?php if ($msg_tipo==='ok'): ?><polyline points="20 6 9 17 4 12"/>
          <?php else: ?><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
          <?php endif; ?>
        </svg>
        <?= htmlspecialchars($msg) ?>
      </div>
      <?php endif; ?>

      <section class="step-panel" id="panel-1">
        <section class="form-head">
          <h2>O teu <em>email</em></h2>
          <p>Insere o endereço de email que você apresentou no momento da matrícula ou do contrato.</p>
        </section>

        <form method="POST" action="register.php" id="form-p1" novalidate>
          <input type="hidden" name="act" value="check_email"/>
          <div class="field">
            <label for="email">Endereço de email <span>*</span></label>
            <div class="input-wrap">
              <svg class="input-icon" viewBox="0 0 24 24">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
              </svg>
              <input
                type="email" 
                id="email" 
                name="email"
                placeholder="o.teu@email.com"
                required 
                autocomplete="email"
                value="<?= htmlspecialchars($email_step) ?>"
              />
            </div>
          </div>
          <button type="submit" class="btn-primary" id="btn-p1">
            <svg viewBox="0 0 24 24">
              <line x1="22" y1="2" x2="11" y2="13"/>
              <polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
            Enviar código de activação
          </button>
        </form>
        <div class="back-link-2">
          <svg viewBox="0 0 24 24">
            <polyline points="15 18 9 12 15 6"/>
          </svg>
          Já tens a conta registrada? <a href="login.php">Inicia sessão</a>
        </div>
      </section>

      <section class="step-panel" id="panel-2">
        <section class="form-head">
          <h2>Activar <em>conta</em></h2>
          <p>Insere o código de 6 dígitos que enviámos e define a tua senha de acesso.</p>
        </section>

        <div class="email-confirmed">
          <svg viewBox="0 0 24 24">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
          </svg>
          <span id="email-display"><?= htmlspecialchars($email_step ?: 'o.teu@email.com') ?></span>
          <button class="alt-btn" type="button" onclick="doStep1()">Alterar</button>
        </div>

        <form method="POST" action="registro.php" id="form-p2">
          <input type="hidden" name="act"   value="activar_conta"/>
          <input type="hidden" name="email"  id="email-hidden" value="<?= htmlspecialchars($email_step) ?>"/>
          <input type="hidden" name="code" id="code-hidden" value=""/>

          <div class="field">
            <label>Código de activação <span>*</span></label>
            <small>Verifica a caixa de entrada (ou pasta de spam) do teu email.</small>
            <div class="code-wrap" id="code-wrap">
              <input class="code-digit" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" autocomplete="one-time-code" id="d0" aria-label="Dígito 1"/>
              <input class="code-digit" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" id="d1" aria-label="Dígito 2"/>
              <input class="code-digit" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" id="d2" aria-label="Dígito 3"/>
              <input class="code-digit" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" id="d3" aria-label="Dígito 4"/>
              <input class="code-digit" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" id="d4" aria-label="Dígito 5"/>
              <input class="code-digit" type="text" inputmode="numeric" maxlength="1" pattern="[0-9]" id="d5" aria-label="Dígito 6"/>
            </div>
            <div class="code-footer">
              <button type="button" class="resend-btn" id="btn-resend" onclick="resendCode()" disabled>
                Reenviar código
              </button>
              <div class="timer-wrap">
                <svg class="timer-icon" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span class="timer-txt">Expira em</span>
                <span class="timer-count" id="timer-count">30:00</span>
              </div>
            </div>
          </div>
          <div class="field">
            <label for="new-password">Nova senha <span>*</span></label>
            <small>Mínimo 6 caracteres. Esta será a senha de acesso ao GABnet.</small>
            <div class="input-wrap">
              <svg class="input-icon" viewBox="0 0 24 24">
                <rect x="3" y="11" width="18" height="11" rx="2"/>
                <path d="M7 11V7a5 5 0 0110 0v4"/>
              </svg>
              <input
                type="password" id="new-password" name="new_senha"
                placeholder="Cria uma senha segura"
                minlength="6" required autocomplete="new-password"
                oninput="testForce(this.value)"
              />
              <button
                type="button"
                class="toggle-password"
                id="toggle-password1"
                aria-label="Mostrar ou ocultar senha"
                onclick="togglePassword('new-password', 'toggle-password1')"
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
            <div class="strength-wrap" id="strength-wrap" style="display:none">
              <div class="strength-bar">
                <div class="strength-seg" id="sg1"></div>
                <div class="strength-seg" id="sg2"></div>
                <div class="strength-seg" id="sg3"></div>
                <div class="strength-seg" id="sg4"></div>
              </div>
              <div class="strength-label" id="strength-lbl"></div>
            </div>
          </div>
          <div class="field">
            <label for="confirm-password">Confirmar senha <span>*</span></label>
            <div class="input-wrap">
              <svg class="input-icon" viewBox="0 0 24 24">
                <rect x="3" y="11" width="18" height="11" rx="2"/>
                <path d="M7 11V7a5 5 0 0110 0v4"/>
              </svg>
              <input
                type="password" 
                id="confirm-password" 
                name="confirm_password"
                placeholder="Repete a senha"
                minlength="6" 
                required 
                autocomplete="new-password"
                oninput="isItEqual()"
              />
              <button
                type="button"
                class="toggle-password"
                id="toggle-password2"
                aria-label="Mostrar ou ocultar senha"
                onclick="togglePassword('confirm-password', 'toggle-password2')"
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

          <button type="submit" class="btn-primary" id="btn-p2">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Activar conta e definir senha
          </button>

          <div class="back-link-2">
            <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            <button type="button" onclick="doStep1()">Usar outro email</button>
          </div>

        </form>
      </section>
   </main>
   <script src="assets/js/script.js"></script>
   <script>
    let currentStep = <?= (int)$step ?>;
    function doStep(p){
      currentStep = p;
 
      document.querySelectorAll('.step-panel').forEach(el => el.classList.remove('active'));
      document.getElementById('panel-' + p).classList.add('active');

      for(let i = 1; i <= 2; i++){
        const node   = document.getElementById('node-' + i);
        const circle = document.getElementById('circle-' + i);
        node.classList.remove('active','done');
        if(i < p){
          node.classList.add('done');
          circle.innerHTML = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"> <polyline points="20 6 9 17 4 12"/> </svg>';
        } else if(i === p){
          node.classList.add('active');
          circle.textContent = i;
        } else {
          circle.textContent = i;
        }
      }
      for(let i = 1; i <= 2; i++){
        const sv = document.getElementById('sv-' + i);
        sv.classList.remove('active-step','done-step');
        if(i < p)       sv.classList.add('done-step');
        else if(i === p) sv.classList.add('active-step');
      }
    }

    window.addEventListener('DOMContentLoaded', function(){
      doStep(currentStep);
      if(currentStep === 2){
        startTimer();
        setTimeout(() => document.getElementById('d0').focus(), 100);
      } else {
        setTimeout(() => document.getElementById('email').focus(), 50);
      }
    });
    
    document.getElementById('form-p1').addEventListener('submit', function(e){
      e.preventDefault(); /* ← REMOVER quando PHP implementado */
      const emailEl = document.getElementById('email');
      const email   = emailEl.value.trim();
      if(!email || !email.includes('@')){ emailEl.classList.add('error'); return; }
      emailEl.classList.remove('error');

      const btn = document.getElementById('btn-p1');
      btn.classList.add('loading');
      btn.innerHTML = sendIcon() + ' A enviar...';

      /* Simulação de rede (REMOVER em produção) */
      setTimeout(function(){
        btn.classList.remove('loading');
        btn.innerHTML = sendIcon() + ' Enviar código de activação';

        document.getElementById('email-display').textContent = email;
        document.getElementById('email-hidden').value = email;
        doStep(2);
        startTimer();
        setTimeout(() => document.getElementById('d0').focus(), 100);
      }, 1000);
    });

    function sendIcon(){
      return '<svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>';
    }
    function checkIcon(){
      return '<svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
    }
   </script>
  </body>
</html>