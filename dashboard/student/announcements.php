<?php

//$papel_permitido avisa ao auth_check, o papel de usuario permitido nesta pagina
$papel_permitido = 'Estudante';
require __DIR__ . '/../../auth/auth_check.php';

//retorna todos os dados do aluno em um array aluno[etc...]
require __DIR__ . '/../../includes/my_data.php';

//$titulo_documento avisa ao head.php qual e o titulo da pagina
$titulo_documento = 'Comunicados';
//$class_body avisa qual e a class do body (para questoes de estilizacao)
$class_body = 'student';
//$css_body avisa qual e o link css a se adicionar, ATT: que esteja dentro de assets/css/
$css_extra = ['announcements.css'];
require __DIR__ . '/../../includes/head.php';

//$pagina_ativa indica qual e a pagina em que estamos.
$pagina_ativa = 'comunicados';
require __DIR__ . '/../../includes/student_sidebar.php';

//$painel_atual diz respeito ao painel em que se encontra.
$painel_atual = 'Painel de ' . $papel_permitido;
//$titulo_pagina diz a topbar.php o titulo da pagina.
$titulo_pagina = 'Comunicados';
require __DIR__ . '/../../includes/topbar.php';

$filtro_imp = $_GET['imp'] ?? '';

$visiveis = $comunicados;

if ($filtro_imp && in_array($filtro_imp, ['Alta','Média','Baixa'])) {
    $visiveis = array_values(array_filter($visiveis, fn($c) => $c['importancia'] === $filtro_imp));
}

?>

      <main class="content">
        <header class="main-header">
          <h1>Os teus <em>comunicados</em></h1>
          <p>Tens <?= htmlspecialchars(count(array_filter($comunicados, function($c) { return $c['importancia'] === 'Alta'; }))) ?> comunicado<?= (count($comunicados) != 1) ? 's' : '' ?> urgente<?= (count($comunicados) != 1) ? 's' : '' ?> que requer<?= (count($comunicados) != 1) ? 'em' : '' ?> atenção</p>
        </header>
        <section class="filter-row">
          <a href="announcements.php" class="filter-pill <?= ($filtro_imp === '') ? 'active' : '' ?>">
            Todos <span class="fp-count"><?= htmlspecialchars(count($comunicados))?></span>
          </a>
          <a href="?imp=Alta" class="filter-pill high <?= ($filtro_imp === 'Alta') ? 'active' : '' ?>">
            Alta <span class="fp-count"><?= htmlspecialchars(count(array_filter($comunicados, function($c) { return $c['importancia'] === 'Alta'; }))) ?></span>
          </a>
          <a href="?imp=Média" class="filter-pill medium <?= ($filtro_imp === 'Média') ? 'active' : '' ?>">
            Média <span class="fp-count"><?= htmlspecialchars(count(array_filter($comunicados, function($c) { return $c['importancia'] === 'Média'; }))) ?></span>
          </a>
          <a href="?imp=Baixa" class="filter-pill low <?= ($filtro_imp === 'Baixa') ? 'active' : '' ?>">
            Baixa <span class="fp-count"><?= htmlspecialchars(count(array_filter($comunicados, function($c) { return $c['importancia'] === 'Baixa'; }))) ?></span>
          </a>
        </section>
        <div class="main-grid">
          <div class="left-col">
            <section class="panel" id="announcements-panel-s">
              <div class="panel-header">
                <h2>
                  <svg viewBox="0 0 24 24">
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                    <path d="M13.73 21a2 2 0 01-3.46 0"/>
                  </svg>
                  Comunicados recentes
                </h2>
                <span class="panel-header-text"><?= htmlspecialchars(count($visiveis))?> resultados</span>
              </div>
              <?php if(!$visiveis): ?>
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
              <?php foreach ($visiveis as $c): ?>
                <article class="announcement-item"
                         onclick="lerComunicado(this)"
                         data-id="<?= htmlspecialchars($c['id'])?>"
                         data-titulo="<?= htmlspecialchars($c['titulo'])?>"
                         data-conteudo="<?= htmlspecialchars($c['conteudo'])?>"
                         data-importancia="<?= htmlspecialchars($c['importancia'])?>"
                         data-autor="<?= htmlspecialchars($c['autor'] ?? 'Administração')?>"
                         data-data="<?= date('d/m/Y', strtotime($c['criado_em'])) ?>"
                         data-alvo="<?= (htmlspecialchars($c['filtro']) === 'Turma') ? htmlspecialchars($turma['nome']) : htmlspecialchars($c['filtro'])?>">
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
            <section id="reading-panel">
              <div class="reading-placeholder" id="reading-placeholder" style="display: block;">
                <svg viewBox="0 0 24 24">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
                <p>Clica num comunicado para ler o conteúdo completo.</p>
              </div>
              <div id="rp-wrapper" class="rp-wrapper" style="display: none;">
                <div class="rp-imp-stripe" id="rp-stripe"></div>
                <div class="rp-header">
                  <div class="rp-badge-row">
                    <span class="imp-label <?= $c['importancia'] ?>" id="rp-badge"><?= $c['importancia'] ?></span>
                    <span class="target-tag" id="rp-target">Todos</span>
                  </div>
                  <div class="rp-title" id="rp-title">Titulo do Comunicado</div>
                </div>
                <div class="rp-body">
                  <div class="rp-content" id="rp-content">Exemplo de conteudo, aqui fica o comunicado em si.</div>
                  <div class="rp-meta">
                    <div class="rp-meta-item">
                      <div class="rp-meta-label">Publicado por</div>
                      <div class="rp-meta-val" id="rp-author">Autor(a)</div>
                    </div>
                    <div class="rp-meta-item">
                      <div class="rp-meta-label">Data</div>
                      <div class="rp-meta-val" id="rp-date">10/05/2026</div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </main>
      <script>
        function filterAnnouncements(importance) {
          
        }
      </script>
<?php 
require_once __DIR__ . '/../../includes/footer.php';