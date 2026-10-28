<?php

//$papel_permitido avisa ao auth_check, o papel de usuario permitido nesta pagina
$papel_permitido = 'Estudante';
require __DIR__ . '/../../auth/auth_check.php';

//retorna todos os dados do aluno em um array aluno[etc...]
require __DIR__ . '/../../includes/my_data.php';

//$titulo_documento avisa ao head.php qual e o titulo da pagina
$titulo_documento = 'Horário';
//$class_body avisa qual e a class do body (para questoes de estilizacao)
$class_body = 'student';
//$css_body avisa qual e o link css a se adicionar, ATT: que esteja dentro de assets/css/
$css_extra = ['schedule.css'];
require __DIR__ . '/../../includes/head.php';

//$pagina_ativa indica qual e a pagina em que estamos.
$pagina_ativa = 'horario';
require __DIR__ . '/../../includes/student_sidebar.php';

//$painel_atual diz respeito ao painel em que se encontra.
$painel_atual = 'Painel de ' . $papel_permitido;
//$titulo_pagina diz a topbar.php o titulo da pagina.
$titulo_pagina = 'Horário';
require __DIR__ . '/../../includes/topbar.php';

//definir as aulas de cada dia
$dias = ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta'];
$horario_por_dia = [];
foreach ($dias as $dia) {
    $horario_por_dia[$dia] = [];
}
foreach ($horarios as $aula) {
    $horario_por_dia[$aula['dia_semana']][] = $aula;
}
?>

      <main class="content">
        <header class="main-header">
          <h1>O teu <em>horário</em></h1>
          <p><?= $turma['classe']?> · Período da <?= $turma['periodo']?> · <?= count($horarios)?> aulas semanais</p>
        </header>
        <section class="next-lesson-card">
          <div class="nl-icon">
            <svg viewBox="0 0 24 24">
              <circle cx="12" cy="12" r="10"/>
              <polyline points="12 6 12 12 16 14"/>
            </svg>
          </div>
          <div class="nl-info">
            <div class="nl-label">Próxima aula</div>
            <div class="nl-disc"><?= $proxima_aula['disciplina'] ?? 'Sem aulas previstas'?></div>
            <div class="nl-meta">
              <?php isset($proxima_aula) ? 'Prof.' .
              $proxima_aula['professor'] :
              'Nenhuma aula prevista'
              ?>
            </div>
          </div>
          <div class="nl-hour">
            <?php if($proxima_aula): ?>
              <strong>
                <?= substr($proxima_aula['hora_inicio'], 0, 5) ?>
              </strong>

              <span>
                até <?= substr($proxima_aula['hora_fim'], 0, 5) ?>
              </span>
            <?php else: ?>
              <strong>--:--</strong>
            <?php endif; ?>
          </div>
        </section>
        <section class="current-lesson-card">
          <div class="cl-pulse">
            <svg viewBox="0 0 24 24">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
              <path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
          </div>
          <div class="cl-info">
            <div class="cl-label">Aula em curso agora</div>
            <div class="cl-disc">
              <?= $aula_actual['disciplina'] ?? 'Sem aula agora' ?>
            </div>

            <div class="cl-meta">
              <?= isset($aula_actual)
                  ? 'Prof. ' . $aula_actual['professor']
                  : 'Nenhuma aula em curso'
              ?>
            </div>
          </div>
          <div class="cl-hour">
            <strong id="hour-live"><?= date('H:i') ?></strong>
            <span>
              <?php if($aula_actual): ?>
                <?= substr($aula_actual['hora_inicio'], 0, 5) ?>
                –
                <?= substr($aula_actual['hora_fim'], 0, 5) ?>
              <?php else: ?>
                Sem horário
              <?php endif; ?>
            </span>
          </div>
        </section>
        <div class="main-grid schedule">
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
                  <?= $turma['nome']?> - Horário semanal 
                </h2>
                <p class="panel-header-text">
                  <?= count($horarios)?> aulas
                </p>
              </div>
              <div class="week-grid-wrap">
                <div class="week-grid">
                  <?php foreach($dias as $dia): ?>
                    <div class="wg-header <?= $dia === $hoje ? 'today' : '' ?>">
                      <?= $dia ?>
                      <?php if($dia === $hoje): ?>
                        <span class="today-dot"></span>
                      <?php endif; ?>
                    </div>
                  <?php endforeach; ?>
                  <?php foreach($dias as $dia): ?>
                  <div class="week-day-col <?= $dia === $hoje ? 'today' : '' ?>">
                    <?php foreach($horario_por_dia[$dia] as $aula): ?>
                      <?php
                        $status = $dia === $hoje
                            ? aula_status(
                                $aula['hora_inicio'],
                                $aula['hora_fim'],
                                $hora_actual
                              )
                            : '';
                      ?>
                      <div class="wd-lesson <?= $status === 'activa' ? 'active' : '' ?>">
                        <div class="wd-lesson-discipline">
                          <?= $aula['disciplina'] ?>
                        </div>
                        <div class="wd-lesson-teacher">
                          Prof. <?= $aula['professor'] ?>
                        </div>

                        <div class="wd-lesson-hour">
                          <?= substr($aula['hora_inicio'], 0, 5) ?>
                          -
                          <?= substr($aula['hora_fim'], 0, 5) ?>
                        </div>
                        <?php if($status === 'activa'): ?>
                          <div class="now-badge">
                            <span class="now-dot"></span>
                            Agora
                          </div>
                        <?php endif; ?>
                      </div>
                    <?php endforeach; ?>
                  </div>

                <?php endforeach; ?>
                <?php foreach($dias as $dia): ?>

                  <div class="week-footer-cell">
                    <span><?= count($horario_por_dia[$dia]) ?></span>
                    aulas
                  </div>

                <?php endforeach; ?>
                </div>
              </div>
              <div style="height: 25px;"></div>
            </div>
          </section>
        </div>
      </main>
 <?php 
 require_once __DIR__ . '/../../includes/footer.php';