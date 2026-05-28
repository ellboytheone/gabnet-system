<?php
require_once __DIR__ . '../../config/database.php';

$nome = $_SESSION['nome'] ?? 'Administrador';
$cargo = $_SESSION['cargo'] ?? 'Administrador';

$nomes = explode(' ', trim($nome));
$primeiro = $nomes[0] ?? '';
$ultimo = $nomes[count($nomes) - 1] ?? '';

$iniciais = strtoupper(substr($primeiro, 0, 1)) .
             strtoupper(substr($ultimo ?: '', 0, 1));

$pagina_ativa = $pagina_ativa ?? null;
?>

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
        <div class="avatar-lg">
            <?= htmlspecialchars($iniciais) ?>
        </div>

        <div class="id-info">
            <strong>
                <?= htmlspecialchars($primeiro . ' ' . $ultimo) ?>
            </strong>

            <small>
                <?= htmlspecialchars($cargo) ?>
            </small>

            <div class="id-badge">
                <svg viewBox="0 0 24 24">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>

                Administrador
            </div>
        </div>
    </div>

    <span class="nav-section">
        Visão Geral
    </span>

    <nav class="nav-links">

        <a href="index.php"
           class="nav-link <?= ($pagina_ativa === 'dashboard') ? 'active' : '' ?>">

            <svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7"/>
                <rect x="14" y="3" width="7" height="7"/>
                <rect x="14" y="14" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/>
            </svg>

            Dashboard
        </a>

        <span class="nav-section">
            Gestão
        </span>

        <a href="manage-accounts.php"
           class="nav-link <?= ($pagina_ativa === 'contas') ? 'active' : '' ?>">

            <svg viewBox="0 0 24 24">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                <path d="M16 3.13a4 4 0 010 7.75"/>
            </svg>

            Gerir Contas
        </a>

        <a href="classes.php"
           class="nav-link <?= ($pagina_ativa === 'turmas') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24">
                <path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/>
                <path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/>
            </svg>
            Turmas
        </a>

        <a href="schedules.php"
           class="nav-link <?= ($pagina_ativa === 'horarios') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
                <line x1="3" y1="10" x2="21" y2="10"/>
            </svg>
            Horários
        </a>

        <span class="nav-section">
            Comunicação
        </span>

        <a href="create-announcement.php"
           class="nav-link <?= ($pagina_ativa === 'criar comunicado') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24">
                <line x1="22" y1="2" x2="11" y2="13"/>
                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
            Criar Comunicado
        </a>
        <a href="announcements.php"
           class="nav-link <?= ($pagina_ativa === 'comunicados') ? 'active' : '' ?>">
            <svg viewBox="0 0 24 24">
                <line x1="22" y1="2" x2="11" y2="13"/>
                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
            </svg>
            Comunicados
            <?php if ($solicitacoes): ?>
                <span class="nav-badge">
                    <?= htmlspecialchars($solicitacoes) ?>
                </span>
            <?php endif; ?>
        </a>

    </nav>

    <footer class="sidebar-footer">

        <form method="POST"
              class="logout-form"
              action="/gabnet-system/auth/logout.php">

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