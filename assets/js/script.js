function testThePage() {
  alert("O arquivo JS da aplicação está conectado.");
}

const loginSection = document.getElementById("login-section");
const signinSection = document.getElementById("signin-section");
const changeAuthLink = document.getElementById("change-auth-link");
const loginLink = document.getElementById("login-link");
const signinLink = document.getElementById("signin-link");

function toggleAuth() {
  const isLoginVisible = loginSection.classList.contains("visible");

  loginSection.classList.toggle("visible");
  loginSection.classList.toggle("invisible");

  signinSection.classList.toggle("visible");
  signinSection.classList.toggle("invisible");

  changeAuthLink.textContent = isLoginVisible
    ? "Iniciar Sessão"
    : "Registrar";
}

loginLink.addEventListener("click", toggleAuth);
signinLink.addEventListener("click", toggleAuth);
changeAuthLink.addEventListener("click", toggleAuth);