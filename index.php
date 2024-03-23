<?php

$halaman = "Beranda";

require __DIR__ . "/__fungsi.php";

if(isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = login($username, $password);

  if ($result) {
    header("Location: dasbor.php");
    exit;
  } else {
    echo "<script>
            alert('Username / password salah!');
          </script>";
  }
}
?>
<?php require __DIR__ . "/__header.php"; ?>
<?php require __DIR__ . '/__navbar.php'; ?>
<main style="height: 80vh;" class="d-flex align-items-center py-4 bg-body-tertiary">
  <div class="m-auto">
    <div class="row justify-content-center">
      <form class="bg-grey" method="post">
        <div class=" text-center">
          <i class="bi bi-backpack" style="font-size: 100px;"></i>
          <h1 class="h3 mb-3 fw-normal">Silahkan Login untuk mengakses Sistem Inventori</h1>
        </div>

        <div class="form-floating mb-2">
          <input name="username" type="text" class="form-control" id="floatingInput" placeholder="milla">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>

        <button class="btn btn-success w-100 py-2 my-3" type="submit" name="login">Masuk</button>
        <a class="d-block text-center mt-2 medium" href="register">Belum punya akun? Silahkan register!</a>
        <p class="my-3 text-body-secondary text-center">© 2024</p>
      </form>
    </div>
  </div>
</main>
<?php require '__footer.php'; ?>