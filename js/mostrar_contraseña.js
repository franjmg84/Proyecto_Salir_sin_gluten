function togglePasswordVisibility() {
    var passwordField = document.getElementById("contrasena");
    if (passwordField.type === "password") {
      passwordField.type = "text";
    } else {
      passwordField.type = "password";
    }
  }
  