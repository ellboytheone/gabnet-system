function togglePassword() {
  const input = document.getElementById("password");
  const eyeOn = document.getElementById("icon-eye");
  const eyeOff = document.getElementById("icon-eye-off");
  const viewable = input.type === "password";
  input.type = viewable ? "text" : "password";
  eyeOn.style.display = viewable ? "none" : "block";
  eyeOff.style.display = viewable ? "block" : "none";
}

document.getElementById("login-form").addEventListener("submit", function (e) {
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!email || !password) {
    e.preventDefault();
    markError("email", !email);
    markError("password", !password);
    return;
  }

  const btn = document.getElementById("btn-login");
  btn.classList.add("loading");
  btn.setAttribute("disabled", "true");
});

function markError(id, gotError) {
  const el = document.getElementById(id);
  if (gotError) el.classList.add("error");
  else el.classList.remove("error");
}

["email", "password"].forEach(function (id) {
  document.getElementById(id).addEventListener("input", function () {
    this.classList.remove("error");
  });
});
