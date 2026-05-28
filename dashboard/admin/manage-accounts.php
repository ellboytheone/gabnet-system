<?php

//$papel_permitido avisa ao auth_check, o papel de usuario permitido nesta pagina
$papel_permitido = 'Administrador';
require __DIR__ . '/../../auth/auth_check.php';

//retorna todos os dados do aluno em um array aluno[etc...]
require __DIR__ . '/../../includes/my_data.php';

//$titulo_documento avisa ao head.php qual e o titulo da pagina
$titulo_documento = 'Gerir Contas';
//$class_body avisa qual e a class do body (para questoes de estilizacao)
$class_body = 'admin';
//$css_body avisa qual e o link css a se adicionar, ATT: que esteja dentro de assets/css/
$css_extra = ['admin.css'];
require __DIR__ . '/../../includes/head.php';

//$pagina ativa diz a pagina em que estas
$pagina_ativa = 'contas';
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
            GABnet &rsaquo; <a href="index.php">Painel de Administrador</a> &rsaquo; <strong>Gerir Contas</strong>
          </div>
        </section>
        <section class="topbar-right">
          <div class="topbar-date"><?= date('d/m/Y') ?></div>
          <span class="topbar-avatar">A</span>
        </section>
      </header>
      <main class="content">
        <header class="main-header">
          <div>
            <h1>Gerir <em>Contas</em></h1>
            <p>Cria, edita, activa e desativa contas de alunos, professores e administradores.</p>
          </div>
          <a href="#" class="announce-btn">
            <svg viewBox="0 0 24 24">
              <line x1="12" y1="5" x2="12" y2="19"/>
              <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Nova conta
          </a>
        </header>
        <div class="quick-filters">
          <a href="?filter=everyone"
            class="qf-pill active">
            Todos <span class="qf-count">3</span>
          </a>
          <a href="?filter=student"
            class="qf-pill blue">
            Alunos <span class="qf-count">1</span>
          </a>
          <a href="?filter=teacher"
            class="qf-pill green">
            Professores <span class="qf-count">1</span>
          </a>
          <a href="?filter=adm"
            class="qf-pill purple">
            Administradores <span class="qf-count">1</span>
          </a>
        </div>
        <form method="GET" action="manage-accounts.php" class="search-bar">
          <input type="hidden" name="papel"  value=""/>
          <input type="hidden" name="status" value=""/>
          <div class="search-wrap">
            <svg viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" name="q" value="" placeholder="Pesquisar por nome ou email..."/>
          </div>
          <select name="status" class="filter-select" onchange="this.form.submit()">
            <option value="">Todos os estados</option>
            <option value="active" selected>Ativos</option>
            <option value="unactive">Não ativos</option>
          </select>
          <button type="submit" class="btn-search">
            <svg viewBox="0 0 24 24">
              <circle cx="11" cy="11" r="8"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            Pesquisar
          </button>
          <a href="" class="btn-clean" style="display: none">
            <svg viewBox="0 0 24 24">
              <line x1="18" y1="6" x2="6" y2="18"/>
              <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
            Limpar
          </a>
        </form>
            <div class="table-panel">
              <div class="table-panel-header">
                <div class="tph-title">
                  <svg viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                    <path d="M16 3.13a4 4 0 010 7.75"/>
                  </svg>
                  Utilizadores do sistema
                </div>
                <span class="tph-count">
                  Mostrando <strong>1-3</strong>
                  de <strong>3</strong> resultados
                </span>
              </div>
              <div class="empty-state" style="display: none;">
                <svg viewBox="0 0 24 24">
                  <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                  <circle cx="9" cy="7" r="4"/>
                  <line x1="23" y1="11" x2="17" y2="11"/>
                </svg>
                <p>Nenhuma conta encontrada com os filtros aplicados.</p>
                <a href="manage-accounts.php">Remover filtros</a>
              </div>
              <div class="table-wrap">
                <table>
                  <thead>
                    <tr>
                      <th>Utilizador</th>
                      <th>Tipo</th>
                      <th>Estado</th>
                      <th>Criado em</th>
                      <th>Acções</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="td-user">
                          <div class="td-av admin">P</div>
                          <div>
                            <span class="td-name">Pedro Manuel</span>
                            <span class="td-email">pedro@gabnet.ao</span>
                          </div>
                        </div>
                      </td>
                      <td><span class="badge admin">Administrador</span></td>
                      <td>
                        <span class="status-active">
                          Ativo
                        </span>
                      </td>
                      <td class="td-data">12/05/2026</td>
                      <td>
                        <div class="td-actions">
                          <a href="manage-accounts.php?editar=1" title="Editar conta">
                            <div class="icon-btn editar">
                              <svg viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                              </svg>
                            </div>
                          </a>
                          <!-- Própria conta — não pode remover -->
                          <div class="icon-btn" style="opacity:.3;cursor:not-allowed" title="Não podes remover a tua própria conta">
                            <svg viewBox="0 0 24 24">
                              <rect x="3" y="11" width="18" height="11" rx="2"/>
                              <path d="M7 11V7a5 5 0 0110 0v4"/>
                            </svg>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="td-user">
                          <div class="td-av teacher">A</div>
                          <div>
                            <span class="td-name">António Calunga</span>
                            <span class="td-email">antoniocalunga@gabnet.ao</span>
                          </div>
                        </div>
                      </td>
                      <td><span class="badge teacher">Professor</span></td>
                      <td>
                        <span class="status-active">
                          Ativo
                        </span>
                      </td>
                      <td class="td-data">12/05/2026</td>
                      <td>
                        <div class="td-actions">
                          <a href="manage-accounts.php?editar=2" title="Editar conta">
                            <div class="icon-btn editar">
                              <svg viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                              </svg>
                            </div>
                          </a>
                          <form method="POST" action="manage-accounts.php" style="display:inline"
                                onsubmit="return confirmarToggle()">
                            <input type="hidden" name="acao"   value="toggle_status"/>
                            <input type="hidden" name="uid"    value=""/>
                            <input type="hidden" name="status" value=""/>
                            <button type="submit" class="icon-btn remove" title="Remover conta">
                              <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                              </svg>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="td-user">
                          <div class="td-av student">E</div>
                          <div>
                            <span class="td-name">Emmanuel Mateus</span>
                            <span class="td-email">emmanuelmateus@gabnet.ao</span>
                          </div>
                        </div>
                      </td>
                      <td><span class="badge student">Estudante</span></td>
                      <td>
                        <span class="status-active">
                          Ativo
                        </span>
                      </td>
                      <td class="td-data">12/05/2026</td>
                      <td>
                        <div class="td-actions">
                          <a href="manage-accounts.php?editar=3" title="Editar conta">
                            <div class="icon-btn editar">
                              <svg viewBox="0 0 24 24">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                              </svg>
                            </div>
                          </a>
                          <form method="POST" action="manage-accounts.php" style="display:inline"
                                onsubmit="return confirmarToggle()">
                            <input type="hidden" name="acao"   value="toggle_status"/>
                            <input type="hidden" name="uid"    value=""/>
                            <input type="hidden" name="status" value=""/>
                            <button type="submit" class="icon-btn remove" title="Remover conta">
                              <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/>
                              </svg>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- Paginação -->
              <div class="pages">
                <span class="pag-info">
                  Página <strong>1</strong> de <strong>1</strong>
                </span>
                <div class="pag-btns">
                  <a href="" class="pag-btn disabled" aria-label="Página anterior">
                    <svg viewBox="0 0 24 24">
                      <polyline points="15 18 9 12 15 6"/>
                    </svg>
                  </a>
                  <a href="" class="pag-btn active ">1</a>
                  <span class="pag-btn" style="pointer-events:none">…</span>
                  <a href="" class="pag-btn">2</a>
                  <a href="" class="pag-btn" aria-label="Próxima página">
                    <svg viewBox="0 0 24 24">
                      <polyline points="9 18 15 12 9 6"/>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
      </main>
    </div>
    <script src="/gabnet-system/assets/js/dashboard.js"></script>
    </body>
</html>