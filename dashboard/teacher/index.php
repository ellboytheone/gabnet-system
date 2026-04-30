<?php
  $prof = [
    'nome'          => $_SESSION['nome'] ?? 'António Calunga',
    'especialidade' => 'Engenharia Electrônia',
    'email'         => $_SESSION['email'] ?? 'antoniocalunga@gabnet.ao',
  ];

  /* ── Disciplinas leccionadas ──────────────────────────────────
    SELECT d.nome, COUNT(DISTINCT h.id_turma) AS num_turmas
    FROM professores_disciplinas pd
    JOIN disciplina d ON pd.id_disciplina = d.id
    LEFT JOIN horario h ON h.id_disciplina = d.id AND h.id_professor = ?
    WHERE pd.id_professor = ? GROUP BY d.id
  */
  $disciplinas = [
      ['nome' => 'Introdução à Electrônica', 'num_turmas' => 2],
      ['nome' => 'Electrotecnia', 'num_turmas' => 1],
      ['nome' => 'Hardware',            'num_turmas' => 2],
  ];
  /* ── Horário semanal ──────────────────────────────────────────
   SELECT h.dia_semana, h.hora_inicio, h.hora_fim,
          d.nome AS disciplina, t.nome AS turma
   FROM horario h
   JOIN disciplina d ON h.id_disciplina = d.id
   JOIN turma t ON h.id_turma = t.id
   WHERE h.id_professor = ?
   ORDER BY FIELD(h.dia_semana,'Segunda','Terça','Quarta','Quinta','Sexta'), h.hora_inicio
  */
  $horario_semana = [
      ['dia'=>'Segunda','hora_inicio'=>'07:30','hora_fim'=>'09:00','disciplina'=>'Introdução à Electrônica','turma'=>'Turma 12INF - 1'],
      ['dia'=>'Segunda','hora_inicio'=>'09:00','hora_fim'=>'10:30','disciplina'=>'Hardware',           'turma'=>'Turma 11INF - 1'],
      ['dia'=>'Terça',  'hora_inicio'=>'07:30','hora_fim'=>'09:00','disciplina'=>'Electrotecnia',   'turma'=>'Turma 12INF - 1'],
      ['dia'=>'Terça',  'hora_inicio'=>'10:45','hora_fim'=>'12:15','disciplina'=>'Hardware',           'turma'=>'Turma 10INF - 1'],
      ['dia'=>'Quarta', 'hora_inicio'=>'07:30','hora_fim'=>'09:00','disciplina'=>'Introdução à Electrônica','turma'=>'Turma 11INF - 1'],
      ['dia'=>'Quarta', 'hora_inicio'=>'09:00','hora_fim'=>'10:30','disciplina'=>'Hardware',           'turma'=>'Turma 11INF - 1'],
      ['dia'=>'Quinta', 'hora_inicio'=>'10:45','hora_fim'=>'12:15','disciplina'=>'Electrotecnia',   'turma'=>'Turma 12INF - 1'],
      ['dia'=>'Sexta',  'hora_inicio'=>'09:00','hora_fim'=>'10:30','disciplina'=>'Introdução à Electrônica','turma'=>'Turma 10INF - 1'],
      ['dia'=>'Sexta',  'hora_inicio'=>'10:45','hora_fim'=>'12:15','disciplina'=>'Hardware',           'turma'=>'Turma 12INF - 1'],
  ];
  $dias_semana   = ['Sunday'=>'Domingo','Monday'=>'Segunda','Tuesday'=>'Terça',
                  'Wednesday'=>'Quarta','Thursday'=>'Quinta','Friday'=>'Sexta','Saturday'=>'Sábado'];
  $hoje       = $dias_semana[date('l')];
  $dias_uteis = ['Segunda','Terça','Quarta','Quinta','Sexta'];

  $aulas_hoje         = array_filter($horario_semana, fn($a) => $a['dia'] === $hoje);
  $total_aulas_hoje   = count($aulas_hoje);
  $total_turmas       = count(array_unique(array_column($horario_semana, 'turma')));
  $total_aulas_semana = count($horario_semana);
  /* ── Comunicados ──────────────────────────────────────────────
    SELECT titulo, importancia, criado_em FROM comunicado
    WHERE filtro IN ('Todos','Professores')
    ORDER BY criado_em DESC LIMIT 3
  */
  $comunicados = [
      ['titulo'=>'Reunião pedagógica — 15 de Maio', 'importancia'=>'Alta',  'criado_em'=>'2026-04-20'],
      ['titulo'=>'Entrega de pautas do 2.º trimestre','importancia'=>'Média', 'criado_em'=>'2026-04-13'],
      ['titulo'=>'Manutenção do portal — Sábado',     'importancia'=>'Baixa', 'criado_em'=>'2026-04-11'],
  ];

  /* ── Última solicitação ───────────────────────────────────────
    SELECT titulo, status, criado_em FROM comunicado
    WHERE id_autor = ? ORDER BY criado_em DESC LIMIT 1
  */
  $ultima_solic = ['titulo'=>'Adiamento da feira tecnológica de 30 de Abril','status'=>'pendente','criado_em'=>'2026-04-14'];
?>

<!doctype html>
<html lang="pt-PT">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="/gabnet-system/assets/images/favicon.ico"
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
    <link rel="stylesheet" href="/gabnet-system/assets/css/dashboard.css">
    <link rel="stylesheet" href="/gabnet-system/assets/css/styles.css" />
    <title>Meu Painel - GABnet</title>
  </head>
  <body class="teacher">
    <div class="sidebar-overlay" id="overlay" onclick="toggleSidebar()"></div>
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-logo">
        <img
          src="/gabnet-system/assets/images/gabnet-logo.png"
          alt="Logo de GABnet"
          class="logo"
        />
        <div class="logo-txt">
          <strong>GABnet</strong>
          <small>Portal Escolar</small>
        </div>
      </div>
      <div class="id-card">
        <div class="avatar-lg">P</div>
        <div class="id-info">
          <strong><?= htmlspecialchars($prof['nome']) ?></strong>
          <small><?= htmlspecialchars($prof['especialidade']) ?></small>
          <div class="id-badge">
            <svg viewBox="0 0 24 24">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
              <path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
            Professor
          </div>
        </div>
      </div>
      <span class="nav-section">
        Menu
      </span>
      <nav class="nav-links">
        <a href="index.php" class="nav-link active">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="7"/>
            <rect x="14" y="3" width="7" height="7"/>
            <rect x="14" y="14" width="7" height="7"/>
            <rect x="3" y="14" width="7" height="7"/>
          </svg>
          Dashboard
        </a>
        <a href="schedule.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
          Horário Completo
        </a>
        <a href="announce.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 01-3.46 0"/>
          </svg>
          Solicitar Comunicado
        </a>
        <a href="profile.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
          Meu perfil
        </a>
      </nav>
      <footer class="sidebar-footer">
        <form method="POST" action="/auth/logout.php">
          <button type="submit" class="btn-logout">
            <svg viewBox="0 0 24 24">
              <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
              <polyline points="16 17 21 12 16 7"/>
              <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Terminar sessão
          </button>
        </form>
      </footer>
    </aside>
    <div class="main-wrap">
      <header class="topbar">
        <section class="topbar-left">
          <button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
          </button>
          <div class="breadcrumb">
            GABnet &rsaquo; <strong>Painel de Professor</strong>
          </div>
        </section>
        <section class="topbar-right">
          <div class="topbar-date">
            <?= date('d/m/Y') ?>
          </div>
          <a href="profile.php">
            <div class="topbar-avatar">
              <?= strtoupper(substr($prof['nome'], 0, 1)) ?? 'E' ?>
            </div>
          </a>
        </section>
      </header>
      <main class="content">
        <section class="greeting">
          <?php $h=(int)date('H'); $saud=$h<12?'Bom dia':($h<18?'Boa tarde':'Boa noite'); ?>
          <h1><?= $saud ?>, <em>Prof. <?=  htmlspecialchars(explode(' ', $prof['nome'])[0]) ?></em></h1>
          <p>
            <?php if ($total_aulas_hoje > 0): ?>
              Tens <strong><?= $total_aulas_hoje ?></strong> aula<?= $total_aulas_hoje>1?'s':'' ?> hoje (<?= $hoje ?>). Bom trabalho!
            <?php else: ?>
              Hoje (<?= $hoje ?>) não tens aulas programadas.
            <?php endif; ?>
          </p>
        </section>
        <section class="stats-grid">
          <div class="stat-card">
            <div class="stat-icon blue">
              <svg viewBox="0 0 24 24">
                <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/>
                <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>
              </svg>
            </div>
            <div class="stat-body">
              <strong><?= count($disciplinas) ?></strong>
              <small>Disciplinas lecionadas</small>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-icon purple">
              <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                <path d="M16 3.13a4 4 0 010 7.75"/>
              </svg>
            </div>
            <div class="stat-body">
              <strong><?= htmlspecialchars($total_turmas) ?></strong>
              <small>Turmas atribuidas</small>
            </div>
          </div>
          <div class="stat-card">
            <div class="stat-icon blue">
              <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
              </svg>
            </div>
            <div class="stat-body purple">
              <strong><?= htmlspecialchars($total_aulas_semana) ?></strong>
              <small>Aulas esta semana</small>
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
              <strong><?= $total_aulas_hoje ?></strong>
              <small>Total de aulas hoje</small>
            </div>
          </div>
        </section>
      </main>
    </div>
    <script src="/gabnet-system/assets/js/dashboard.js"></script>
  </body>
</html>