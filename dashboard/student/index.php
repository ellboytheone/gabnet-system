<?php

//$papel_permitido avisa ao auth_check, o papel de usuario permitido nesta pagina
$papel_permitido = 'Estudante';
require __DIR__ . '/../../auth/auth_check.php';

//retorna todos os dados do aluno em um array aluno[etc...]
require __DIR__ . '/../../includes/my_data.php';

//$titulo_documento avisa ao head.php qual e o titulo da pagina
$titulo_documento = 'Meu Painel';
//$class_body avisa qual e a class do body (para questoes de estilizacao)
$class_body = 'student';
require __DIR__ . '/../../includes/head.php';

//$pagina_ativa indica qual e a pagina em que estamos.
$pagina_ativa = 'dashboard';
require __DIR__ . '/../../includes/student_sidebar.php';

//$titulo_pagina diz a topbar.php o titulo da pagina.
$titulo_pagina = 'Painel de Estudante';
require __DIR__ . '/../../includes/topbar.php';
?>
    
      <main class="content">
        <section class="greeting">
          <?php
            $h = (int) date('H');
            $saud = $h < 12 ? 'Bom dia' : ($h < 18 ? 'Boa tarde' : 'Boa noite');
          ?>
          <h1>
            <?= $saud ?>,
            <em>
              <?= htmlspecialchars($primeiro) ?>
            </em>
          </h1>
          <p>
            Hoje é <?= $hoje ?>.
            Tens <?= $total_aulas_hoje ?>
            aula<?= ($total_aulas_hoje !== 1) ? 's' : '' ?>
            programada<?= ($total_aulas_hoje !== 1) ? 's' : '' ?>
            para hoje.
          </p>
        </section>
        <section class="stats-grid student">
          <div class="stat-card">
            <div class="stat-icon blue">
              <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                <path d="M16 3.13a4 4 0 010 7.75"/>
              </svg>
            </div>
            <div class="stat-body">
              <strong><?= htmlspecialchars($turma['nome']) ?></strong>
              <small>Turma matriculada</small>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-icon purple">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
              </svg>
            </div>
            <div class="stat-body">
              <strong><?= htmlspecialchars($turma['periodo']) ?></strong>
              <small>Período escolar</small>
            </div>
          </div>
        </section>
        <section class="main-grid">
          <div class="left-col">
            <section class="panel" id="announcements-panel">
              <div class="panel-header">
                <h2>
                  <svg viewBox="0 0 24 24">
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 01-3.46 0"/>
                  </svg>
                  Comunicados recentes
                </h2>
                <a href="announcements.php" class="panel-link">
                  Ver todos
                  <svg viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                  </svg>
                </a>
              </div>
              <?php if(!$comunicados): ?>
                <section class="empty-content">
                  <div class="empty-state">
                    <svg viewBox="0 0 24 24">
                      <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                      <path d="M13.73 21a2 2 0 01-3.46 0"/>
                    </svg>
                    <p>Nenhum comunicado encontrado.</p>
                  </div>
                </section>
              <?php endif;?>
              <?php foreach ($comunicados as $c): ?>
                <article class="announcement-item">
                  <div class="imp-dot imp-<?= $c['importancia'] ?>"></div>
                  <div class="com-body">
                    <strong><?= htmlspecialchars($c['titulo']) ?></strong>
                    <p><?= htmlspecialchars($c['conteudo']) ?></p>
                    <div class="com-meta">
                      <span class="imp-badge badge-<?= $c['importancia'] ?>"><?= $c['importancia'] ?></span>
                      <span class="com-date"><?= date('d/m/Y', strtotime($c['criado_em'])) ?></span>
                    </div>
                  </div>
                </article>
              <?php endforeach?>
            </section>
          </div>
          <div class="right-col">
            <section class="panel schedule-panel">
              <div class="panel-header">
                <h2>
                  <svg viewBox="0 0 24 24">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                  </svg>
                  Aulas de hoje
                </h2>
                <a href="schedule.php" class="panel-link">
                  Semana completa
                  <svg viewBox="0 0 24 24">
                    <polyline points="9 18 15 12 9 6"/>
                  </svg>
                </a>
              </div>

              <?php if (empty($aulas_hoje)): ?>
              <div style="padding: 28px 20px; text-align: center;">
                <p style="font-size:.85rem;color:var(--txt-2);">Sem aulas programadas para hoje.</p>
              </div>
              <?php else: ?>
                <?php foreach ($aulas_hoje as $aula):
                  $status = aula_status($aula['hora_inicio'], $aula['hora_fim'], $hora_actual);
                ?>
                <div class="lesson-item">
                  <div class="lesson-hour">
                    <span><?= date('H:i', strtotime($aula['hora_inicio'])) ?></span>
                    <div class="lesson-hour-line"></div>
                    <span><?= date('H:i', strtotime($aula['hora_fim'])) ?></span>
                  </div>
                  <div class="lesson-card <?= $status ?>">
                    <strong><?= htmlspecialchars($aula['disciplina']) ?></strong>
                    <small><?= htmlspecialchars($aula['professor']) ?></small>
                    <?php if ($status === 'activa'): ?>
                      <div class="now-badge"><span class="now-dot"></span>Em curso</div>
                    <?php elseif ($status === 'futura'): ?>
                      <div><span class="lesson-status status-future">A seguir</span></div>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </section>
            <section class="profile-card">
              <div class="profile-card-top">
                <div class="profile-avatar-lg"><?= strtoupper(substr($aluno['nome'], 0, 1)) ?></div>
                <div class="info">
                  <strong><?= htmlspecialchars($aluno['nome']) ?></strong>
                  <small>Perfíl de estudante</small>
                </div>
              </div>

              <div class="profile-field">
                <span>N.º de inscrição</span>
                <span><?= htmlspecialchars($aluno['inscricao']) ?></span>
              </div>
              <div class="profile-field">
                <span>Turma</span>
                <span><?= htmlspecialchars($turma['nome']) ?></span>
              </div>
              <div class="profile-field">
                <span>Classe</span>
                <span><?= htmlspecialchars($turma['classe']) ?></span>
              </div>
              <div class="profile-field">
                <span>Período</span>
                <span><?= htmlspecialchars($turma['periodo']) ?></span>
              </div>

              <a href="profile.php">
                <button class="btn-profile">
                  <svg viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                  </svg>
                  Ver perfil completo
                </button>
              </a>
            </section>
          </div>
        </section>
      </main>
<?php 
require_once __DIR__ . ("/../../includes/footer.php");