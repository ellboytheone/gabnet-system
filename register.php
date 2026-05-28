<?php
  session_start();

  /* 1. Redireciona se já esta autenticado */
  if (isset($_SESSION['usuario_id'])) {
    switch ($_SESSION['papel']) {
      case 'Administrador': header('Location: dashboard/admin/'); exit;
      case 'Professor':     header('Location: dashboard/teacher/'); exit;
      case 'Estudante':     header('Location: dashboard/student/'); exit;
    }
  }

  /* 2. Ligacao a base de dados */
  require 'config/database.php';

  /* 3. Ligacao ao servico de email */
  require 'includes/mail.php';

  /* 4. Ligacao a funcoes auxiliares */
  require 'includes/functions.php';

  $passo = 1; //Variavel que indica o passo actual do processo de registo (1 ou 2)   
  $email_passo = ''; //Armazena o email inserido no passo 1 para exibir no passo 2
  $msg = ''; //Mensagem de feedback para o utilizador (erro ou sucesso)
  $msg_tipo = ''; //Indica o tipo da mensagem ('ok' para sucesso, 'erro' para erros)

  /* 5. Processamento do POST */
  //Verificar qual ação está sendo solicitada (verificar email ou activar conta)
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    /* 5a. Verificar email e enviar código de activação */
    if(isset($_POST['acao']) && $_POST['acao'] === 'verificar_email'){
      $email = trim($_POST['email']); //Armazena o email inserido pelo utilizador no passo 1
      $email_passo = $email; //O email inserido é armazenado para ser exibido no passo 2

      //Encontra pessoa (estudante, professor ou administrador) pelo email
      $pessoa = encontrarPessoa($pdo, $email);

      //Se a pessoa nao for encontrada, exibe mensagem de erro
      if(!$pessoa){
        $msg = 'Email não encontrado.';
        $msg_tipo = 'erro';

      //Se a  pessoa ja tiver um id de usuario, exibe mensagem de erro (conta ja activada)
      }elseif($pessoa['id_usuario']){
        $msg = 'Conta já activada.';
        $msg_tipo = 'erro';

      //Se a pessoa for encontrada e nao tiver conta activada, e gerado e guardado um OTP relacionado a aquela pessoa, e e enviado um email com o mesmo OTP para o email da pessoa
      }else{

        //Gera-se um numero aleatorio entre 100000 e 999999 para ser o codigo OTP
        $codigo = random_int(100000, 999999); //Armazena o numero correspondente ao OTP

        //E definido o tempo de expiracao do OTP para 20 minutos a partir do momento atual
        $expira = date('Y-m-d H:i:s', strtotime('+20 minutes')); //Armazena a data e hora de expiracao do OTP

        //Atualiza-se a tabela correspondente (estudante, professor ou administrador) para guardar o codigo OTP e a data de expiracao
        $sql = $pdo->prepare("
          UPDATE {$pessoa['tabela']}
            SET 
              otp_codigo = ?,
              otp_expira = ?
            WHERE id = ?
        ");
        $sql->execute([
          $codigo,
          $expira,
          $pessoa['id']
        ]);

        //Envia-se um email com o OTP para a pessoa encontrada
        $enviado = enviarCodigo(
          $email,
          $pessoa['nome'],
          $codigo
        );

        //Se o email for enviado com sucesso, passa-se para o passo 2 (activacao da conta), senao exibe-se uma mensagem de erro
        if($enviado){
          $passo = 2;
          $msg = 'Código enviado.';
          $msg_tipo = 'ok';
        }else{
          $msg = 'Erro ao enviar email.';
          $msg_tipo = 'erro';
        }
      }
    }

    /* 5b. Verificar o OTP inserido e ativar a conta (adicionando uma senha) */
    if(isset($_POST['acao']) && $_POST['acao'] === 'activar_conta'){
      $email = trim($_POST['email']); //Armazena o email para o qual o código foi enviado (vindo do campo oculto do formulário)
      $codigo = trim($_POST['codigo']); //Armazena o OTP inserido pelo utilizador no passo 2
      $senha = $_POST['nova_senha']; //Armazena a senha inserida pelo utilizador no passo 2
      $confirmar = $_POST['confirmar_senha']; //Armazena a confirmação de senha inserida pelo utilizador no passo 2

      $passo = 2;

      $email_passo = $email; //O email é armazenado novamente para permanecer exibido no passo 2 caso haja algum erro

      /* Verifica-se se as senhas (senha definida e confirmação) coincidem, senao e exibido uma mensagem de erro */
      if($senha !== $confirmar){
        $msg = 'As senhas não coincidem.';
        $msg_tipo = 'erro';
      }else{
        $pessoa = encontrarPessoa($pdo, $email); // Armazena os dados da pessoa encontrada

        //Se a pessoa nao for encontrada, e exibida uma mensagem de erro
        if(!$pessoa){
          $msg = 'Conta não encontrada.';
          $msg_tipo = 'erro';
            
        //Se o OTP inserido nao coincidir com o OTP gerado para aquela pessoa, e exibida uma mensagem de erro
        }elseif($pessoa['otp_codigo'] !== (string)$codigo){
          $msg = 'Código inválido.';
          $msg_tipo = 'erro';

        //Se o OTP tiver expirado (data de expiracao menor que a data e hora atual), e exibida uma mensagem de erro
        }elseif(strtotime($pessoa['otp_expira']) < time()){
          $msg = 'Código expirado.';
          $msg_tipo = 'erro';

        //Se tudo estiver nos conformes, o usuario e registrado no sistema
        }else{
          //A senha inserida e convertida em hash (Para melhoria da seguranca, e mais conveniente)
          $hash = password_hash($senha, PASSWORD_DEFAULT);

          //Aos dados do usuario correspondentes a pessoa (incluindo o hash da senha), sao inseridos no banco de dados
          $sql = $pdo->prepare("
            INSERT INTO usuario (
              nome,
              email,
              senha,
              papel,
              referencia_id
            )
            VALUES (?, ?, ?, ?, ?)
          ");
          $sql->execute([
            $pessoa['nome'],
            $email,
            $hash,
            $pessoa['papel'],
            $pessoa['id']
          ]);

          //O id do usuario recem-criado e obtido para ser associado a pessoa correspondente
          $usuario_id = $pdo->lastInsertId(); //Armazena o id do usuario recem-criado

          //A conta da pessoa e ativada, sua linha agora possui um id_usuario, que corresponde ao id do usuario recem-criado. O codigo OTP e sua data de expiracao sao limpos (definidos como NULL)
          $up = $pdo->prepare("
            UPDATE {$pessoa['tabela']}
              SET 
                otp_codigo = NULL,
                otp_expira = NULL,
                id_usuario = ?
              WHERE id = ?
          ");
          $up->execute([
            $usuario_id,
            $pessoa['id']
          ]);

          //Depois disso, direciona-se a pagina de login
          header('Location: login.php');
          exit;
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
    <title>Registrar - GABnet</title>
  </head>
  <body>
    <div class="body">
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
        <div class="reg-alert reg-alert-<?= $msg_tipo ?>">
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
            <input type="hidden" name="acao" value="verificar_email"/>
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
                  value="<?= htmlspecialchars($email_passo) ?>"
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
            <span id="email-display"><?= htmlspecialchars($email_passo ?: 'o.teu@email.com') ?></span>
            <button class="alt-btn" type="button" onclick="voltarPasso1()">Alterar</button>
          </div>
  
          <form method="POST" action="register.php" id="form-p2">
            <input type="hidden" name="acao" value="activar_conta"/>
            <input type="hidden" name="email" id="email-hidden" value="<?= htmlspecialchars($email_passo) ?>"/>
            <input type="hidden" name="codigo" id="codigo-hidden" value=""/>
  
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
                <button type="button" class="resend-btn" id="btn-reenviar" onclick="reenviarCodigo()" disabled>
                  Reenviar código
                </button>
                <div class="timer-wrap">
                  <svg class="timer-icon" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                  </svg>
                  <span class="timer-txt">Expira em</span>
                  <span class="timer-count" id="timer-count">30:00</span>
                </div>
              </div>
            </div>
            <div class="field">
              <label for="nova-senha">Nova senha <span>*</span></label>
              <small>Mínimo 6 caracteres. Esta será a senha de acesso ao GABnet.</small>
              <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24">
                  <rect x="3" y="11" width="18" height="11" rx="2"/>
                  <path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
                <input
                  type="password" id="nova-senha" name="nova_senha"
                  placeholder="Cria uma senha segura"
                  minlength="6" required autocomplete="new-password"
                  oninput="avaliarForca(this.value)"
                  />
                <button
                  type="button"
                  class="toggle-password"
                  id="toggle-password1"
                  aria-label="Mostrar ou ocultar senha"
                  onclick="togglePassword('nova-senha', 'toggle-password1')"
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
              <label for="confirmar-senha">Confirmar senha <span>*</span></label>
              <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24">
                  <rect x="3" y="11" width="18" height="11" rx="2"/>
                  <path d="M7 11V7a5 5 0 0110 0v4"/>
                </svg>
                <input
                  type="password" 
                  id="confirmar-senha" 
                  name="confirmar_senha"
                  placeholder="Repete a senha"
                  minlength="6" 
                  required 
                  autocomplete="new-password"
                  oninput="eIgual()"
                />
                <button
                  type="button"
                  class="toggle-password"
                  id="toggle-password2"
                  aria-label="Mostrar ou ocultar senha"
                  onclick="togglePassword('confirmar-senha', 'toggle-password2')"
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
              <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12"/>
              </svg>
              Activar conta e definir senha
            </button>
  
            <div class="back-link-2">
              <svg viewBox="0 0 24 24">
                <polyline points="15 18 9 12 15 6"/>
              </svg>
              <button type="button" onclick="voltarPasso1()">Usar outro email</button>
            </div>
  
          </form>
        </section>
     </main>
    </div>
   <script src="assets/js/script.js"></script>
   <script>
    let passoActual = <?= (int)$passo ?>;
    function irParaPasso(p){
      passoActual = p;

      /* Painéis de formulário */
      document.querySelectorAll('.step-panel').forEach(el => el.classList.remove('active'));
      document.getElementById('panel-' + p).classList.add('active');

      /* Stepper numérico */
      for(let i = 1; i <= 2; i++){
        const node   = document.getElementById('node-' + i);
        const circle = document.getElementById('circle-' + i);
        node.classList.remove('active','done');
        if(i < p){
          node.classList.add('done');
          circle.innerHTML = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
        } else if(i === p){
          node.classList.add('active');
          circle.textContent = i;
        } else {
          circle.textContent = i;
        }
      }

      /* Passos visuais no painel esquerdo */
      for(let i = 1; i <= 2; i++){
        const sv = document.getElementById('sv-' + i);
        sv.classList.remove('active','done');
        if(i < p)       sv.classList.add('done');
        else if(i === p) sv.classList.add('active');
      }
    }

    function voltarPasso1(){
      pararTimer();
      limparOTP();
      irParaPasso(1);
      setTimeout(() => document.getElementById('email').focus(), 50);
    }

    document.getElementById('form-p1').addEventListener('submit', function(e){
      const emailEl = document.getElementById('email');
      const email   = emailEl.value.trim();
      if(!email || !email.includes('@')){ emailEl.classList.add('error'); return; }
      emailEl.classList.remove('error');

      /* Loading */
      const btn = document.getElementById('btn-p1');
      btn.classList.add('loading');
      btn.innerHTML = iconeEnvio() + ' A enviar...';
    });

    document.getElementById('form-p2').addEventListener('submit', function(e){
      /* Monta o código a partir das caixas */
      const codigo = obterCodigo();
      document.getElementById('codigo-hidden').value = codigo;

      /* Validações client-side */
      if(codigo.length !== 6 || !/^\d{6}$/.test(codigo)){
        marcarCodigoErro(); 
        return;
      }
      const nova = document.getElementById('nova-senha').value;
      const conf = document.getElementById('confirmar-senha').value;
      if(nova.length < 6){
        document.getElementById('nova-senha').classList.add('error'); 
        return;
      }
      if(nova !== conf){
        document.getElementById('confirmar-senha').classList.add('error'); 
        return;
      }

      /* Loading */
      const btn = document.getElementById('btn-p2');
      btn.classList.add('loading');
      btn.innerHTML = iconeCheck() + ' A activar...';

      /* Simulação (remover em produção) */
      setTimeout(function(){
        btn.classList.remove('loading');
        btn.innerHTML = iconeCheck() + ' Activar conta e definir senha';
        alert('✅ Estrutura visual OK!\nQuando o PHP estiver implementado, o utilizador será redirecionado para login.php com mensagem de sucesso.');
      }, 1200);
    });
    
    //codigo de verificacao
    const digitIds = ['d0','d1','d2','d3','d4','d5'];
    digitIds.forEach(function(id, idx){
    const el = document.getElementById(id);

    el.addEventListener('input', function(){
      this.value = this.value.replace(/\D/g,'').slice(-1); /* aceita só 1 dígito numérico */
      this.classList.toggle('preenchido', !!this.value);
      this.classList.remove('erro');
      if(this.value && idx < digitIds.length - 1){
        document.getElementById(digitIds[idx + 1]).focus();
      }
    });

    el.addEventListener('keydown', function(e){
      if(e.key === 'Backspace' && !this.value && idx > 0){
        const prev = document.getElementById(digitIds[idx - 1]);
        prev.value = '';
        prev.classList.remove('preenchido');
        prev.focus();
      }
      /* Setas */
      if(e.key === 'ArrowLeft'  && idx > 0) document.getElementById(digitIds[idx-1]).focus();
      if(e.key === 'ArrowRight' && idx < digitIds.length-1) document.getElementById(digitIds[idx+1]).focus();
    });

    //colar codigo completo
    el.addEventListener('paste', function(e){
        e.preventDefault();
        const txt = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g,'');
        digitIds.forEach(function(did, i){
          const d = document.getElementById(did);
          d.value = txt[i] || '';
          d.classList.toggle('preenchido', !!d.value);
        });
        /* Foca o primeiro vazio ou o último campo */
        const primeiroVazio = digitIds.find(did => !document.getElementById(did).value);
        document.getElementById(primeiroVazio || digitIds[digitIds.length-1]).focus();
      });
    });
    //funcao que retorna o codigo digitado
    function obterCodigo(){
      return digitIds.map(id => document.getElementById(id).value).join('');
    }
    function limparOTP(){
      digitIds.forEach(function(id){
        const el = document.getElementById(id);
        el.value = ''; el.classList.remove('preenchido','erro');
      });
    }
    function marcarCodigoErro(){
      digitIds.forEach(function(id){
        document.getElementById(id).classList.add('erro');
        setTimeout(() => document.getElementById(id).classList.remove('erro'), 800);
      });
      document.getElementById('d0').focus();
    }

    function reenviarCodigo(){
      /* TODO: POST para registro.php?acao=reenviar */
      document.getElementById('btn-reenviar').disabled = true;
      limparOTP();
      iniciarTimer();
      setTimeout(() => document.getElementById('d0').focus(), 50);
    }

    //Funcoes do timer
    let timerInterval = null;
    let segundos = 20 * 60;

    function iniciarTimer(){
      segundos = 20 * 60;
      document.getElementById('btn-reenviar').disabled = true;
      document.getElementById('timer-count').classList.remove('urgente');
      actualizarTimerDisplay();
      clearInterval(timerInterval);
      timerInterval = setInterval(function(){
        segundos--;
        actualizarTimerDisplay();
        if(segundos <= 0){
          clearInterval(timerInterval);
          document.getElementById('timer-count').textContent = 'expirou';
          document.getElementById('timer-count').classList.add('urgente');
          document.getElementById('btn-reenviar').disabled = false;
        }
      }, 1000);
    }
    function pararTimer(){ clearInterval(timerInterval); }
    function actualizarTimerDisplay(){
      const m = Math.floor(segundos / 60);
      const s = segundos % 60;
      const el = document.getElementById('timer-count');
      el.textContent = String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0');
      el.classList.toggle('urgente', segundos > 0 && segundos < 120);
    }

    //Força da password e coincidencia.
    function avaliarForca(v){
      const wrap = document.getElementById('strength-wrap');
      const lbl  = document.getElementById('strength-lbl');
      const segs = [1,2,3,4].map(i => document.getElementById('sg' + i));
      if(!v){ wrap.style.display = 'none'; return; }
      wrap.style.display = 'block';
      let sc = 0;
      if(v.length >= 6)  sc++;
      if(v.length >= 10) sc++;
      if(/[A-Z]/.test(v) && /[a-z]/.test(v)) sc++;
      if(/[0-9]/.test(v) || /[^A-Za-z0-9]/.test(v)) sc++;
      const cfgs = [
        {c:'#E24B4A', t:'Muito fraca'},
        {c:'#F59E0B', t:'Fraca'},
        {c:'#3B82F6', t:'Razoável'},
        {c:'#0B7A4E', t:'Forte'},
      ];
      const cfg = cfgs[sc - 1] || cfgs[0];
      segs.forEach((s, i) => { s.style.background = i < sc ? cfg.c : 'var(--bg)'; });
      lbl.textContent = cfg.t; lbl.style.color = cfg.c;
    }
    function eIgual(){
      const nova = document.getElementById('nova-senha').value;
      const conf = document.getElementById('confirmar-senha');
      if(conf.value && conf.value !== nova) conf.classList.add('error');
      else conf.classList.remove('error');
    }

    //icones
    function iconeEnvio(){
      return '<svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>';
    }
    function iconeCheck(){
      return '<svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
    }

    //inicializar no passo certo
    window.addEventListener('DOMContentLoaded', function(){
      irParaPasso(passoActual);
      if(passoActual === 2){
        iniciarTimer();
        setTimeout(() => document.getElementById('d0').focus(), 100);
      } else {
        setTimeout(() => document.getElementById('email').focus(), 50);
      }
    });

   </script>
  </body>
</html>
