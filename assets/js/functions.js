function lerComunicado(elemento) {
  // esconder placeholder
  document.getElementById("reading-placeholder").style.display = "none";

  // mostrar painel
  document.getElementById("rp-wrapper").style.display = "block";

  // pegar dados
  const alvo = elemento.dataset.alvo;
  const titulo = elemento.dataset.titulo;
  const conteudo = elemento.dataset.conteudo;
  const importancia = elemento.dataset.importancia;
  const autor = elemento.dataset.autor;
  const data = elemento.dataset.data;

  // preencher painel
  document.getElementById("rp-target").textContent = alvo;
  document.getElementById("rp-title").textContent = titulo;
  document.getElementById("rp-content").textContent = conteudo;
  document.getElementById("rp-author").textContent = autor;
  document.getElementById("rp-date").textContent = data;

  // badge
  const badge = document.getElementById("rp-badge");

  badge.textContent = importancia;

  //Wrapper
  const rpWrapper = document.getElementById("rp-wrapper");
  rpWrapper.className = "rp-wrapper"; // resetar classes
  rpWrapper.classList.add(importancia);

  // remover classes antigas
  badge.className = "imp-label";

  // adicionar nova classe
  badge.classList.add(importancia);

  document.getElementById("reading-panel").scrollIntoView({ behavior: "smooth" } - pageXOffset);
}
