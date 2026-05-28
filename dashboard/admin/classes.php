<?php

//$papel_permitido avisa ao auth_check, o papel de usuario permitido nesta pagina
$papel_permitido = 'Administrador';
require __DIR__ . '/../../auth/auth_check.php';

//retorna todos os dados do aluno em um array aluno[etc...]
require __DIR__ . '/../../includes/my_data.php';

//$titulo_documento avisa ao head.php qual e o titulo da pagina
$titulo_documento = 'Turmas';
//$class_body avisa qual e a class do body (para questoes de estilizacao)
$class_body = 'admin';
//$css_body avisa qual e o link css a se adicionar, ATT: que esteja dentro de assets/css/
$css_extra = ['admin.css'];
require __DIR__ . '/../../includes/head.php';

//$pagina ativa diz a pagina em que estas
$pagina_ativa = 'turmas';
require __DIR__ . '/../../includes/admin_sidebar.php';
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
            GABnet &rsaquo; <a href="index.php">Painel de Administrador</a> &rsaquo; <strong>Turmas</strong>
          </div>
        </section>
        <section class="topbar-right">
          <div class="topbar-date"><?= date('d/m/Y') ?></div>
          <span class="topbar-avatar">A</span>
        </section>
      </header>
      <main class="content">
        <section class="main-header">
          <div>
            <h1>Gestão de <em>Turmas</em></h1>
            <p>Cria, edita e consulta as turmas da escola. Clica numa turma para ver os alunos matriculados.</p>
          </div>
          <a href="#" class="announce-btn">
            <svg viewBox="0 0 24 24">
              <line x1="12" y1="5" x2="12" y2="19"/>
              <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Nova turma
          </a>
        </section>
        <div class="quick-filters">
          <a href=""
            class="qf-pill active">
            Todas
          </a>
          <a href=""
            class="qf-pill blue">
            Manhã
          </a>
          <a href=""
            class="qf-pill green">
            Tarde
          </a>
          <a href=""
            class="qf-pill purple">
            Noite
          </a>
        </div>
        <section class="classes-grid">
          <div class="class-card">
            <!-- Topo colorido -->
            <div class="cc-top morning">
              <span class="cc-period-badge">
                <svg viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="5"/>
                  <line x1="12" y1="1" x2="12" y2="3"/>
                  <line x1="12" y1="21" x2="12" y2="23"/>
                </svg>
                Manhã
              </span>
            </div>
            <!-- Corpo -->
            <div class="cc-body">
              <div class="cc-name">10ª Informática</div>
              <div class="cc-classe">10ª Classe</div>

              <!-- Barra de ocupação -->
              <div class="cc-ocupation">
                <div class="cc-oc-row">
                  <span class="cc-oc-label">Alunos matriculados</span>
                  <span class="cc-oc-val">0</span>
                </div>
              </div>
            </div>
            <div class="cc-footer">
              <button class="cc-link" onclick="openModal()">
                <svg viewBox="0 0 24 24">
                  <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                </svg>
                Ver alunos
              </button>
              <div class="cc-actions">
                <!-- Editar -->
                <button class="icon-btn edit" title="Editar turma" onclick="openEditDrawer()">
                  <svg viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                  </svg>
                </button>
                <!-- Eliminar -->
                <form method="POST" action="classes.php" style="display:inline"
                      onsubmit="return confirm('Eliminar a turma 10ª Informática? Esta acção só é possível se não tiver alunos.')">
                  <input type="hidden" name="act" value="eliminar"/>
                  <input type="hidden" name="class_id"  value=""/>
                  <button type="submit" class="icon-btn remove" title="Eliminar turma">
                    <svg viewBox="0 0 24 24">
                      <polyline points="3 6 5 6 21 6"/>
                      <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                      <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                    </svg>
                  </button>
                </form>
              </div>
            </div>
          </div>
          <div class="class-card">
            <!-- Topo colorido -->
            <div class="cc-top afternoon">
              <span class="cc-period-badge">
                <svg viewBox="0 0 24 24">
                  <path d="M17 18a5 5 0 00-10 0"/>
                  <line x1="12" y1="9" x2="12" y2="2"/>
                </svg>
                Tarde
              </span>
            </div>
            <!-- Corpo -->
            <div class="cc-body">
              <div class="cc-name">11ª Informática</div>
              <div class="cc-classe">11ª Classe</div>

              <!-- Barra de ocupação -->
              <div class="cc-ocupation">
                <div class="cc-oc-row">
                  <span class="cc-oc-label">Alunos matriculados</span>
                  <span class="cc-oc-val">0</span>
                </div>
              </div>
            </div>
            <div class="cc-footer">
              <button class="cc-link" onclick="openModal()">
                <svg viewBox="0 0 24 24">
                  <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                </svg>
                Ver alunos
              </button>
              <div class="cc-actions">
                <!-- Editar -->
                <button class="icon-btn edit" title="Editar turma" onclick="openEditDrawer()">
                  <svg viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                  </svg>
                </button>
                <!-- Eliminar -->
                <form method="POST" action="classes.php" style="display:inline"
                      onsubmit="return confirm('Eliminar a turma 10ª Informática? Esta acção só é possível se não tiver alunos.')">
                  <input type="hidden" name="act" value="eliminar"/>
                  <input type="hidden" name="class_id"  value=""/>
                  <button type="submit" class="icon-btn remove" title="Eliminar turma">
                    <svg viewBox="0 0 24 24">
                      <polyline points="3 6 5 6 21 6"/>
                      <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                      <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                    </svg>
                  </button>
                </form>
              </div>
            </div>
          </div>
          <div class="class-card">
            <!-- Topo colorido -->
            <div class="cc-top night">
              <span class="cc-period-badge">
                <svg viewBox="0 0 24 24">
                  <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
                Noite
              </span>
            </div>
            <!-- Corpo -->
            <div class="cc-body">
              <div class="cc-name">12ª Informática</div>
              <div class="cc-classe">12ª Classe</div>

              <!-- Barra de ocupação -->
              <div class="cc-ocupation">
                <div class="cc-oc-row">
                  <span class="cc-oc-label">Alunos matriculados</span>
                  <span class="cc-oc-val">0</span>
                </div>
              </div>
            </div>
            <div class="cc-footer">
              <button class="cc-link" onclick="openModal()">
                <svg viewBox="0 0 24 24">
                  <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                </svg>
                Ver alunos
              </button>
              <div class="cc-actions">
                <!-- Editar -->
                <button class="icon-btn edit" title="Editar turma" onclick="openEditDrawer()">
                  <svg viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                  </svg>
                </button>
                <!-- Eliminar -->
                <form method="POST" action="classes.php" style="display:inline"
                      onsubmit="return confirm('Eliminar a turma 10ª Informática? Esta acção só é possível se não tiver alunos.')">
                  <input type="hidden" name="act" value="eliminar"/>
                  <input type="hidden" name="class_id"  value=""/>
                  <button type="submit" class="icon-btn remove" title="Eliminar turma">
                    <svg viewBox="0 0 24 24">
                      <polyline points="3 6 5 6 21 6"/>
                      <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                      <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                    </svg>
                  </button>
                </form>
              </div>
            </div>
          </div>
          <div class="new-class-card" onclick="openDrawerCriar()">
            <div class="new-icon">
              <svg viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"/>
                <line x1="5" y1="12" x2="19" y2="12"/>
              </svg>
            </div>
            <span class="new-txt">Criar nova turma</span>
          </div>
        </section>
      </main>
    </div>
    <script src="/gabnet-system/assets/js/dashboard.js"></script>
    </body>
</html>