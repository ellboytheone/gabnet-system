<?php
$titulo_pagina = $titulo_pagina  ?? 'GABnet';
$painel_atual = $painel_atual ?? null;
$nome = $_SESSION['nome'] ?? 'Nome de Usuário';
$nomes = explode(' ', trim($nome));
$primeiro = $nomes[0] ?? '';
$ultimo = $nomes[count($nomes) - 1] ?? '';
$iniciais = strtoupper(substr($primeiro, 0, 1)) .
            strtoupper(substr($ultimo ?: '', 0, 1));

?>
<header class="topbar">
    <section class="topbar-left">
        <button class="hamburger-btn" onclick="toggleSidebar()" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="breadcrumb">
            GABnet &rsaquo; 
            <?php if ($painel_atual): ?>
                <a href="index.php">
                    <?= htmlspecialchars($painel_atual) ?>
                </a>
                &rsaquo; 
            <?php endif;?>
            <strong><?= htmlspecialchars($titulo_pagina) ?></strong>
        </div>
    </section>
    <section class="topbar-right">
        <div class="topbar-date">
            <?= date('d/m/Y') ?>
        </div>
        <a href="profile.php">
            <div class="topbar-avatar student">
                <?= htmlspecialchars($iniciais) ?>
            </div>
        </a>
    </section>
</header>