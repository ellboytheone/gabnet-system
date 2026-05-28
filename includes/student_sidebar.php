<?php
require_once __DIR__ . '../../config/database.php';

$nome = $_SESSION['nome'] ?? 'Nome de Estudante';
$nomes = explode(' ', trim($nome));
$primeiro = $nomes[0] ?? '';
$ultimo = $nomes[count($nomes) - 1] ?? '';
$iniciais = strtoupper(substr($primeiro, 0, 1)) .
            strtoupper(substr($ultimo ?: '', 0, 1));
$classe = $turma['classe'] ?? 'Sem Classe';
$pagina_ativa = $pagina_ativa ?? null;

//contabilizar o numero de comunicados importantes
$stmt = $pdo->prepare("
    SELECT COUNT(*) as total
    FROM comunicado
    WHERE (destino IN ('Todos', 'Alunos')
    OR id_turma = ?)
    AND importancia = 'Alta'
");
$stmt->execute([$aluno['id_turma']]);
$importantes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
?>

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
        <div class="avatar-lg"><?= htmlspecialchars($iniciais)?></div>
        <div class="id-info">
            <strong><?= htmlspecialchars($primeiro . ' ' . $ultimo) ?></strong>
            <small><?= htmlspecialchars($classe) ?></small>
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
        <a href="index.php" class="nav-link <?= ($pagina_ativa === 'dashboard') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>
            </svg>
          Dashboard
        </a>
        <a href="announcements.php" class="nav-link <?= ($pagina_ativa === 'comunicados') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24">
                <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                <path d="M13.73 21a2 2 0 01-3.46 0"/>
            </svg>
            Comunicados
            <?php if($importantes) {?>
            <span class="nav-badge">
                <?= htmlspecialchars($importantes) ?>
            </span>
            <?php }?>
        </a>
        <a href="schedule.php" class="nav-link <?= ($pagina_ativa === 'horario') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
          Horário
        </a>
        <a href="profile.php" class="nav-link <?= ($pagina_ativa === 'meu perfil') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
            Meu perfil
        </a>
    </nav>
    <footer class="sidebar-footer">
        <form method="POST" class="logout-form" action="/gabnet-system/auth/logout.php">
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