function logoutRedirect() {
  Swal.fire({
    title: "Log out",
    text: "Are you sure do you want to log out?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#448b4f",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, log out",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "../index.php";
    }
  });
}

function profileRedirect() {
  window.location.href = "StudentProfile.php";
}
