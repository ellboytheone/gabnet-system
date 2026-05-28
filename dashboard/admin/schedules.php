<?php

//$papel_permitido avisa ao auth_check, o papel de usuario permitido nesta pagina
$papel_permitido = 'Administrador';
require __DIR__ . '/../../auth/auth_check.php';

//retorna todos os dados do aluno em um array aluno[etc...]
require __DIR__ . '/../../includes/my_data.php';

//$titulo_documento avisa ao head.php qual e o titulo da pagina
$titulo_documento = 'Horários';
//$class_body avisa qual e a class do body (para questoes de estilizacao)
$class_body = 'admin';
//$css_body avisa qual e o link css a se adicionar, ATT: que esteja dentro de assets/css/
$css_extra = ['schedule.css', 'admin.css'];
require __DIR__ . '/../../includes/head.php';
//$pagina ativa diz a pagina em que estas
$pagina_ativa = 'horarios';
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
            GABnet &rsaquo; <a href="index.php">Painel de Administrador</a> &rsaquo; <strong>Horários</strong>
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
            <h1>Gestão de <em>Horários</em></h1>
            <p>Define as aulas semanais de cada turma — disciplina, professor, dia e horário.</p>
          </div>
          <a href="#" class="announce-btn">
            <svg viewBox="0 0 24 24">
              <line x1="12" y1="5" x2="12" y2="19"/>
              <line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Nova entrada
          </a>
        </section>
        <div class="class-tabs-wrap">
          <div class="class-tabs-header">
            <div class="class-tabs">
              <a href="?turma=1">
                <button class="class-tab active">
                  10ª Informática
                </button>
              </a>
              <a href="?turma=2">
                <button class="class-tab">
                  11ª Informática
                </button>
              </a>
              <a href="?turma=">
                <button class="class-tab">
                  12ª Informática
                </button>
              </a>
            </div>
            <span class="period-chip morning">
              Manhã
            </span>
          </div>
        </div>
        <section class="panel" id="schedule-panel">
            <div class="schedule-container">
              <div class="panel-header">
                <h2>
                  <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                  </svg>
                  10.ª Informática - Horário semanal 
                </h2>
                <p class="panel-header-text">
                  13 aulas · 3 disciplinas 
                </p>
              </div>
              <div class="week-grid-wrap">
                <div class="week-grid">
                  <div class="wg-header today">
                    Segunda
                    <span class="today-dot"></span>
                  </div>
                  <div class="wg-header">
                    Terça
                  </div>
                  <div class="wg-header">
                    Quarta
                  </div>
                  <div class="wg-header">
                    Quinta
                  </div>
                  <div class="wg-header">
                    Sexta
                  </div>

                  <div class="week-day-col today">
                    <div class="wd-lesson active">
                      <div class="wd-lesson-discipline">Matemática</div>
                      <div class="wd-lesson-teacher">Prof. Humberto Kibanzala</div>
                      <div class="wd-lesson-hour">07:30-09:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value="eliminar"/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Base de Dados</div>
                      <div class="wd-lesson-teacher">Prof. Timóteo José</div>
                      <div class="wd-lesson-hour">09:30-11:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Electrotecnia</div>
                      <div class="wd-lesson-teacher">Prof. António Calunga</div>
                      <div class="wd-lesson-hour">11:30-13:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="add-slot" onclick="openDrawerDay()" style="margin-top:4px">
                      <svg viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                      </svg>
                    </div>
                  </div>
                  <div class="week-day-col">
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Matemática</div>
                      <div class="wd-lesson-teacher">Prof. Humberto Kibanzala</div>
                      <div class="wd-lesson-hour">07:30-09:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Electrotecnia</div>
                      <div class="wd-lesson-teacher">Prof. António Calunga</div>
                      <div class="wd-lesson-hour">11:30-13:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="add-slot" onclick="openDrawerDay()" style="margin-top:4px">
                      <svg viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                      </svg>
                    </div>
                  </div>
                  <div class="week-day-col">
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Matemática</div>
                      <div class="wd-lesson-teacher">Prof. Humberto Kibanzala</div>
                      <div class="wd-lesson-hour">07:30-09:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Base de Dados</div>
                      <div class="wd-lesson-teacher">Prof. Timóteo José</div>
                      <div class="wd-lesson-hour">09:30-11:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Electrotecnia</div>
                      <div class="wd-lesson-teacher">Prof. António Calunga</div>
                      <div class="wd-lesson-hour">11:30-13:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="add-slot" onclick="openDrawerDay()" style="margin-top:4px">
                      <svg viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                      </svg>
                    </div>
                  </div>
                  <div class="week-day-col">
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Matemática</div>
                      <div class="wd-lesson-teacher">Prof. Humberto Kibanzala</div>
                      <div class="wd-lesson-hour">07:30-09:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Electrotecnia</div>
                      <div class="wd-lesson-teacher">Prof. António Calunga</div>
                      <div class="wd-lesson-hour">11:30-13:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="add-slot" onclick="openDrawerDay()" style="margin-top:4px">
                      <svg viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                      </svg>
                    </div>
                  </div>
                  <div class="week-day-col">
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Matemática</div>
                      <div class="wd-lesson-teacher">Prof. Humberto Kibanzala</div>
                      <div class="wd-lesson-hour">07:30-09:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Base de Dados</div>
                      <div class="wd-lesson-teacher">Prof. Timóteo José</div>
                      <div class="wd-lesson-hour">09:30-11:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="wd-lesson">
                      <div class="wd-lesson-discipline">Electrotecnia</div>
                      <div class="wd-lesson-teacher">Prof. António Calunga</div>
                      <div class="wd-lesson-hour">11:30-13:00</div>
                      <form method="POST" action="schedules.php?turma=1" style="display:inline" onsubmit="return confirm('Eliminar esta entrada de horário?')">
                        <input type="hidden" name="act" value=""/>
                        <input type="hidden" name="hid"  value=""/>
                        <button type="submit" class="icon-btn small remove rm-schedule-btn" title="Eliminar">
                          <svg viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                          </svg>
                        </button>
                      </form>
                    </div>
                    <div class="add-slot" onclick="openDrawerDay()" style="margin-top:4px">
                      <svg viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                      </svg>
                    </div>
                  </div>

                  <div class="week-footer-cell">
                    <span>3</span> aulas
                  </div>
                  <div class="week-footer-cell">
                    <span>2</span> aulas
                  </div>
                  <div class="week-footer-cell">
                    <span>3</span> aulas
                  </div>
                  <div class="week-footer-cell">
                    <span>2</span> aulas
                  </div>
                  <div class="week-footer-cell">
                    <span>3</span> aulas
                  </div>
                </div>
              </div>
              <div style="height: 25px;"></div>
            </div>
          </section>
      </main>
    </div>
    <script src="/gabnet-system/assets/js/dashboard.js"></script>
    </body>
</html>