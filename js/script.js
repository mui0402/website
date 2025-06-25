$(document).ready(function () {

  // 🔒 SIGN UP FORM
  $("#signup").submit(function (e) {
    e.preventDefault(); // Halang reload
    $.post("signup_process.php", $(this).serialize(), function (data) {
      $("#authMessage").html(data);
      // Optional: reset form after success
      $("#signup")[0].reset();
    });
  });

  // 🔑 LOGIN FORM
  $("#login").submit(function (e) {
    e.preventDefault(); // Halang reload
    $.post("login_process.php", $(this).serialize(), function (data) {
      if (data === "customer") {
        $("#authMessage").text("Logged in as customer. Redirecting...");
        setTimeout(() => {
          window.location.href = "customer_dashboard.php";
        }, 1500);
      } else if (data === "staff") {
        $("#authMessage").text("Logged in as staff. Redirecting...");
        setTimeout(() => {
          window.location.href = "staff_dashboard.php";
        }, 1500);
      } else {
        $("#authMessage").text("Invalid email or password.");
      }
    });
  });

});
