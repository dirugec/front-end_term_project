document
  .getElementById("signupForm")
  .addEventListener("submit", function (event) {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var passwordError = document.getElementById("passwordError");

    if (password !== confirmPassword) {
      passwordError.textContent = "Passwords do not match";
      event.preventDefault(); // Prevent form submission
    } else {
      passwordError.textContent = "";
    }
  });
