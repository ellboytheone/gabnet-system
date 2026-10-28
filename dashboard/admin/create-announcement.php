<?php

//$papel_permitido avisa ao auth_check, o papel de usuario permitido nesta pagina
$papel_permitido = 'Administrador';
require __DIR__ . '/../../auth/auth_check.php';

//retorna todos os dados do aluno em um array aluno[etc...]
require __DIR__ . '/../../includes/my_data.php';

//$titulo_documento avisa ao head.php qual e o titulo da pagina
$titulo_documento = 'Criar Comunicado';
//$class_body avisa qual e a class do body (para questoes de estilizacao)
$class_body = 'admin';
//$css_body avisa qual e o link css a se adicionar, ATT: que esteja dentro de assets/css/
$css_extra = ['announcements.css', 'admin.css'];
require __DIR__ . '/../../includes/head.php';
//$pagina ativa diz a pagina em que estas
$pagina_ativa = 'criar comunicado';
require __DIR__ . '/../../includes/admin_sidebar.php';

$titulo = '';
$mensagem = '';
$importancia = '';
$filtro = '';
$turma = null;
$encarregados = 0;
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo       = trim($_POST['titulo']);
    $importancia  = $_POST['importancia'];
    $filtro      = $_POST['destino'];
    $turma        = $_POST['turma'] ?? null;
    $mensagem     = trim($_POST['mensagem']);
    $encarregados = isset($_POST['encarregados']) ? 1 : 0;
    
    $stmt = $pdo->prepare("
        INSERT INTO comunicado
        (
            titulo,
            conteudo,
            importancia,
            filtro,
            id_turma,
            id_autor,
            estado
        )
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([
        $titulo,
        $mensagem,
        $importancia,
        $filtro,
        $turma,
        $_SESSION['usuario_id'],
        'Aceite'
    ]);
}

?>
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
            GABnet &rsaquo; <a href="index.php">Painel de Administrador</a> &rsaquo; <strong>Criar Comunicado</strong>
          </div>
        </section>
        <section class="topbar-right">
          <div class="topbar-date"><?= date('d/m/Y') ?></div>
          <span class="topbar-avatar">A</span>
        </section>
      </header>
      <main class="content">
        <header class="main-header">
          <div class="main-header-text">
            <h1>Criar <em>Comunicado</em></h1>
            <p>Publica um aviso para toda a escola ou para um grupo específico. A pré-visualização actualiza em tempo real.</p>
          </div>
        </header>
        <section class="panel" id="request-panel">
          <div class="panel-header">
            <h2 class="panel-title">  
              <svg viewBox="0 0 24 24">
                <line x1="22" y1="2" x2="11" y2="13"/>
                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
              </svg>
              Criar comunicado
            </h2>
          </div>
          <div class="requests-form">
            <form method="POST" action="create-announcement.php" id="form-solic">
              <div class="form-field">
                <label for="title">Título <span>*</span></label>
                <input type="text" id="title" name="titulo" placeholder="Ex: Cancelamento de aulas..." maxlength="150" required/>
              </div>
              <div class="form-field">
                <label>Nível de importância <span>*</span></label>
                <div class="imp-cards">
                  <div class="imp-card">
                    <input type="radio" id="imp-b" name="importancia" value="Baixa"/>
                    <label for="imp-b" class="low">
                      <div class="imp-icon ii-low">
                        <svg viewBox="0 0 24 24">
                          <circle cx="12" cy="12" r="10"/>
                          <line x1="12" y1="8" x2="12" y2="12"/>
                          <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                      </div>
                      <div class="imp-lbl">Baixa</div>
                      <div class="imp-desc">Informação geral</div>
                    </label>
                  </div>
                  <div class="imp-card">
                    <input type="radio" id="imp-m" name="importancia" value="Média"/>
                    <label for="imp-m" class="medium">
                      <div class="imp-icon ii-medium">
                        <svg viewBox="0 0 24 24">
                          <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                          <line x1="12" y1="9" x2="12" y2="13"/>
                          <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                      </div>
                      <div class="imp-lbl">Média</div>
                      <div class="imp-desc">Requer atenção</div>
                    </label>
                  </div>
                  <div class="imp-card">
                    <input type="radio" id="imp-a" name="importancia" value="Alta"/>
                    <label for="imp-a" class="high">
                      <div class="imp-icon ii-high">
                        <svg viewBox="0 0 24 24">
                          <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"/>
                          <line x1="12" y1="8" x2="12" y2="12"/>
                          <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                      </div>
                      <div class="imp-lbl">Alta</div>
                      <div class="imp-desc">Urgente — destaque</div>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-field">
                <label for="target">Destino<span>*</span></label>
                <select id="target" name="destino" required>
                  <option value="" disabled selected>Selecionar...</option>
                  <option value="Todos">Todos</option>
                  <option value="Alunos">Alunos</option>
                  <option value="Professores">Professores</option>
                  <option value="Administradores">Administradores</option>
                  <option value="Turma">Turma</option>
                </select>
                <select id="target-class" name="turma" style="display: none;">
                  <option value="" disabled selected>Selecione a turma</option>
                  <?php foreach($turmas as $t): ?>
                      <option value="<?= $t['id'] ?>">
                          <?= $t['nome'] ?>
                      </option>
                  <?php endforeach; ?>

                </select>
              </div>
              <div class="form-field">
                <label for="content">Mensagem <span>*</span></label>
                <textarea id="content" name="mensagem" placeholder="Descreve o conteúdo do anúncio..." maxlength="1000" required></textarea>
              </div>
              <div class="form-field include-parents-field">
                <input type="checkbox" name="encarregados" id="include-parents"/>
                <label for="include-parents">Incluir Encarregados?</label>
              </div>
              <button type="submit" class="btn-submit">
                <svg viewBox="0 0 24 24">
                  <line x1="22" y1="2" x2="11" y2="13"/>
                  <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                </svg>
                Publicar comunicado
              </button>
            </form>
          </div>
        </section>    
        <section class="request-section">
          <div class="request-head">
            <h2>Solicitações <em>pendentes</em></h2>
            <span class="request-count">3 aguardam aprovação</span>
          </div>
          <div class="empty-request" style="display: none;">
            <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            <p>Sem solicitações pendentes. Tudo em ordem!</p>
          </div>
          <div class="request-grid">
            <div class="request-card">
              <div id="request card rp-wrapper-1" class="rp-imp-high">
                <div class="rp-imp-stripe"></div>
                <div class="rp-header">
                  <div class="rp-badge-row">
                    <span class="imp-label high" id="rp-badge-1">ALta</span>
                    <span class="target-tag" id="rp-target-1">Todos</span>
                  </div>
                  <div class="rp-title" id="rp-title-1">Titulo do Comunicado</div>
                </div>
                <div class="rp-body">
                  <div class="rp-content" id="rp-content-1">Exemplo de conteudo, aqui fica o comunicado em si.</div>
                  <div class="rp-meta">
                    <div class="rp-meta-item">
                      <div class="rp-meta-label">Publicado por</div>
                      <div class="rp-meta-val" id="rp-author-1">Autor(a)</div>
                    </div>
                    <div class="rp-meta-item">
                      <div class="rp-meta-label">Data</div>
                      <div class="rp-meta-val" id="rp-date-1">10/05/2026</div>
                    </div>
                  </div>
                </div>
                <div class="request-card-foot">
                  <form method="POST" action="create-announcement.php" style="display:inline"
                        onsubmit="return confirm('Aprovar e publicar o comunicado de X?')">
                    <input type="hidden" name="act" value="aprovar"/>
                    <input type="hidden" name="cid"  value=""/>
                    <button type="submit" class="btn-aprovar">
                      <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"/>
                      </svg>
                      Aprovar
                    </button>
                  </form>
                  <form method="POST" action="create-announcement.php" style="display:inline"
                        onsubmit="return confirm('Rejeitar a solicitação de X?')">
                    <input type="hidden" name="act" value="rejeitar"/>
                    <input type="hidden" name="cid"  value=""/>
                    <button type="submit" class="btn-rejeitar">
                      <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                      </svg>
                      Rejeitar
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <div class="request-card">
              <div id="rp-wrapper-2" class="rp-imp-medium">
                <div class="rp-imp-stripe"></div>
                <div class="rp-header">
                  <div class="rp-badge-row">
                    <span class="imp-label medium" id="rp-badge-2">Média</span>
                    <span class="target-tag" id="rp-target-2">Todos</span>
                  </div>
                  <div class="rp-title" id="rp-title-2">Titulo do Comunicado</div>
                </div>
                <div class="rp-body">
                  <div class="rp-content" id="rp-content-2">Exemplo de conteudo, aqui fica o comunicado em si.</div>
                  <div class="rp-meta">
                    <div class="rp-meta-item">
                      <div class="rp-meta-label">Publicado por</div>
                      <div class="rp-meta-val" id="rp-author-2">Autor(a)</div>
                    </div>
                    <div class="rp-meta-item">
                      <div class="rp-meta-label">Data</div>
                      <div class="rp-meta-val" id="rp-date-2">10/05/2026</div>
                    </div>
                  </div>
                </div>
                <div class="request-card-foot">
                  <form method="POST" action="create-announcement.php" style="display:inline"
                        onsubmit="return confirm('Aprovar e publicar o comunicado de X?')">
                    <input type="hidden" name="act" value="aprovar"/>
                    <input type="hidden" name="cid"  value=""/>
                    <button type="submit" class="btn-aprovar">
                      <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"/>
                      </svg>
                      Aprovar
                    </button>
                  </form>
                  <form method="POST" action="create-announcement.php" style="display:inline"
                        onsubmit="return confirm('Rejeitar a solicitação de X?')">
                    <input type="hidden" name="act" value="rejeitar"/>
                    <input type="hidden" name="cid"  value=""/>
                    <button type="submit" class="btn-rejeitar">
                      <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                      </svg>
                      Rejeitar
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <div class="request-card">
              <div id="rp-wrapper-3" class="rp-imp-low">
                <div class="rp-imp-stripe" id="rp-stripe-3"></div>
                <div class="rp-header">
                  <div class="rp-badge-row">
                    <span class="imp-label low" id="rp-badge-3">Baixa</span>
                    <span class="target-tag" id="rp-target-3">Todos</span>
                  </div>
                  <div class="rp-title" id="rp-title-3">Titulo do Comunicado</div>
                </div>
                <div class="rp-body">
                  <div class="rp-content" id="rp-content-3">Exemplo de conteudo, aqui fica o comunicado em si.</div>
                  <div class="rp-meta">
                    <div class="rp-meta-item">
                      <div class="rp-meta-label">Publicado por</div>
                      <div class="rp-meta-val" id="rp-author-3">Autor(a)</div>
                    </div>
                    <div class="rp-meta-item">
                      <div class="rp-meta-label">Data</div>
                      <div class="rp-meta-val" id="rp-date-3">10/05/2026</div>
                    </div>
                  </div>
                </div>
                <div class="request-card-foot">
                  <form method="POST" action="create-announcement.php" style="display:inline"
                        onsubmit="return confirm('Aprovar e publicar o comunicado de X?')">
                    <input type="hidden" name="act" value="aprovar"/>
                    <input type="hidden" name="cid"  value=""/>
                    <button type="submit" class="btn-aprovar">
                      <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"/>
                      </svg>
                      Aprovar
                    </button>
                  </form>
                  <form method="POST" action="create-announcement.php" style="display:inline"
                        onsubmit="return confirm('Rejeitar a solicitação de X?')">
                    <input type="hidden" name="act" value="rejeitar"/>
                    <input type="hidden" name="cid"  value=""/>
                    <button type="submit" class="btn-rejeitar">
                      <svg viewBox="0 0 24 24">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                      </svg>
                      Rejeitar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
    <script>

      const targetSelect = document.getElementById('target');
      const classSelect = document.getElementById('target-class');

      targetSelect.addEventListener('change', () => {

        if(targetSelect.value === 'Turma') {
          classSelect.style.display = 'block';
          classSelect.required = true;

        } else {
          classSelect.style.display = 'none';
          classSelect.required = false;
          classSelect.value = '';
        }

      });
    </script>
    <script src="/gabnet-system/assets/js/dashboard.js"></script>
  </body>
</html>