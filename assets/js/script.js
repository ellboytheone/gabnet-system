//auth.js
function togglePassword(inputId, buttonId) {
  const input = document.getElementById(inputId);
  const eyeOn = document.getElementById(buttonId).querySelector("#icon-eye");
  const eyeOff = document
    .getElementById(buttonId)
    .querySelector("#icon-eye-off");
  const viewable = input.type === "password";
  input.type = viewable ? "text" : "password";
  eyeOn.style.display = viewable ? "none" : "block";
  eyeOff.style.display = viewable ? "block" : "none";
}
