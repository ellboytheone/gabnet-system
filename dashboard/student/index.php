<?php
/* ============================================================
   dashboard/aluno/index.php
   Regra de negócio: apenas alunos autenticados acedem a esta página.
   Substitui os dados fictícios abaixo pelas queries reais ao banco.
   ============================================================ */
session_start();

/* 
if (!isset($_SESSION['usuario_id']) || $_SESSION['papel'] !== 'Estudante') {
    header('Location: ../../login.php');
    exit;
}

/* --- Dados do aluno (substituir por query real) ---
   Exemplo de query:
   SELECT a.*, t.nome AS turma_nome, t.periodo
   FROM aluno a
   JOIN turma t ON a.id_turma = t.id
   WHERE a.id_usuario = ?
*/
$aluno = [
    'nome'        => $_SESSION['nome'] ?? 'Emmanuel Mateus',
    'inscricao'   => 'INF-2024-001',
    'turma'       => 'Turma 12INF - 1',
    'periodo'     => 'Manhã',
    'classe'      => '12.ª Classe',
];

/* --- Comunicados recentes (substituir por query real) ---
   SELECT * FROM comunicado
   WHERE filtro IN ('Todos','Alunos')
      OR (filtro = 'Turma' AND id_turma = ?)
   ORDER BY criado_em DESC LIMIT 4
*/
$comunicados = [
    ['titulo' => 'Reunião de encarregados de educação', 'importancia' => 'Alta',  'criado_em' => '2026-04-14', 'conteudo' => 'A reunião realiza-se no dia 18 de Abril às 09h00 no salão principal da escola.'],
    ['titulo' => 'Calendário de exames do 2.º trimestre', 'importancia' => 'Média', 'criado_em' => '2026-04-12', 'conteudo' => 'Os exames decorrem entre os dias 22 e 30 de Abril. Consulta o horário afixado.'],
    ['titulo' => 'Inscrição para actividades extracurriculares', 'importancia' => 'Baixa',  'criado_em' => '2026-04-10', 'conteudo' => 'As inscrições para o clube de robótica e o grupo de teatro estão abertas.'],
    ['titulo' => 'Manutenção do sistema — Sábado', 'importancia' => 'Baixa',  'criado_em' => '2026-04-08', 'conteudo' => 'O portal estará indisponível no sábado entre as 02h00 e as 06h00.'],
];

/* --- Horário de hoje (substituir por query real) ---
   SELECT h.*, d.nome AS disciplina, u.nome AS professor_nome
   FROM horario h
   JOIN disciplina d ON h.id_disciplina = d.id
   JOIN professor p  ON h.id_professor  = p.id
   JOIN usuario u    ON p.id_usuario    = u.id
   WHERE h.id_turma = ? AND h.dia_semana = ?  (dia da semana actual)
   ORDER BY h.hora_inicio
*/
$dias_semana = ['Sunday'=>'Domingo','Monday'=>'Segunda','Tuesday'=>'Terça','Wednesday'=>'Quarta','Thursday'=>'Quinta','Friday'=>'Sexta','Saturday'=>'Sábado'];
$hoje = $dias_semana[date('l')];

$aulas_hoje = [
    ['hora_inicio'=>'07:30','hora_fim'=>'09:00','disciplina'=>'Matemática',       'professor'=>'Prof. Humberto Kibanzala'],
    ['hora_inicio'=>'09:00','hora_fim'=>'10:30','disciplina'=>'Língua Portuguesa', 'professor'=>'Prof. Assunção Baptista'],
    ['hora_inicio'=>'10:45','hora_fim'=>'12:15','disciplina'=>'Electrotecnia',       'professor'=>'Prof. António Calunga'],
];

$hora_actual = (int) date('H') * 60 + (int) date('i');
function aula_status(string $ini, string $fim, int $agora): string {
    [$h1,$m1] = explode(':', $ini); [$h2,$m2] = explode(':', $fim);
    $start = (int)$h1*60+(int)$m1; $end = (int)$h2*60+(int)$m2;
    if ($agora >= $start && $agora < $end) return 'activa';
    if ($agora < $start) return 'futura';
    return 'passada';
}
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
  <body class="student">
    <div class="sidebar-overlay" id="overlay" onclick="toggleSidebar()"></div>
    <aside class="sidebar student" id="sidebar">
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
      <div class="id-card student">
        <div class="avatar-lg"><?= strtoupper(substr($aluno['nome'], 0, 1)) ?></div>
        <div class="id-info">
          <strong><?= htmlspecialchars($aluno['nome']) ?></strong>
          <small><?= htmlspecialchars($aluno['classe']) ?></small>
          <div class="id-badge">
            <svg viewBox="0 0 24 24">
              <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
              <path d="M6 12v5c3 3 9 3 12 0v-5"/>
            </svg>
            Estudante
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
        <a href="announcements.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 01-3.46 0"/>
          </svg>
          Comunicados
          <span class="nav-badge"><?= count(array_filter($comunicados, fn($c) => $c['importancia'] === 'Alta')) ?></span>
        </a>
        <a href="schedule.php" class="nav-link">
          <svg viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="18" rx="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
          </svg>
          Horário
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
            GABnet &rsaquo; <strong>Painel de Estudante</strong>
          </div>
        </section>
        <section class="topbar-right">
          <div class="topbar-date">
            <?= date('d/m/Y') ?>
          </div>
          <a href="profile.php">
            <div class="topbar-avatar student">
              <?= strtoupper(substr($aluno['nome'], 0, 1)) ?? 'E' ?>
            </div>
          </a>
        </section>
      </header>
      <main class="content">
        <section class="greeting">
          <?php
            $h = (int) date('H');
            $saud = $h < 12 ? 'Bom dia' : ($h < 18 ? 'Boa tarde' : 'Boa noite');
          ?>
          <h1><?= $saud ?>, <em><?= htmlspecialchars(explode(' ', $aluno['nome'])[0]) ?></em></h1>
          <p>Hoje é <?= $hoje ?> Tens <?= count($aulas_hoje) ?> aulas programadas para hoje.</p>
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
              <strong><?= htmlspecialchars($aluno['turma']) ?></strong>
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
              <strong><?= htmlspecialchars($aluno['periodo']) ?></strong>
              <small>Período escolar</small>
            </div>
          </div>
        </section>
        <section class="main-grid">
          <div class="right-col">
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
              <?php endforeach; ?>
            </section>
          </div>
          <div class="left-col">
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
                    <span><?= $aula['hora_inicio'] ?></span>
                    <div class="lesson-hour-line"></div>
                    <span><?= $aula['hora_fim'] ?></span>
                  </div>
                  <div class="lesson-card <?= $status ?>">
                    <strong><?= htmlspecialchars($aula['disciplina']) ?></strong>
                    <small><?= htmlspecialchars($aula['professor']) ?></small>
                    <?php if ($status === 'activa'): ?>
                      <div><span class="lesson-status status-active">Em curso</span></div>
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
                <span><?= htmlspecialchars($aluno['turma']) ?></span>
              </div>
              <div class="profile-field">
                <span>Classe</span>
                <span><?= htmlspecialchars($aluno['classe']) ?></span>
              </div>
              <div class="profile-field">
                <span>Período</span>
                <span><?= htmlspecialchars($aluno['periodo']) ?></span>
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
    </div>
    <script src="/gabnet-system/assets/js/dashboard.js"></script>
  </body>
</html>