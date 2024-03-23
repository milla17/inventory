<?php

$halaman = "Beranda";

require __DIR__ . "/__fungsi.php";

if(isset($_POST["register"])) {
  $result = register($_POST);

  if ($result > 0) {
    echo "<script>
            alert('Registrasi berhasil!');
            window.location.href = 'index';
          </script>";
  } else {
    echo mysqli_error($koneksi);
  }
}
?>
<?php require __DIR__ . "/__header.php"; ?>
<?php require __DIR__ . '/__navbar.php'; ?>
<main style="height: 80vh;" class="d-flex align-items-center py-4 bg-body-tertiary">
  <div class="m-auto">
    <div class="row justify-content-center">
      <form class="bg-grey" method="post">
        <div class="text-center">
          <i class="bi bi-backpack" style="font-size: 100px;"></i>
          <h1 class="h3 mb-3 fw-normal">Silahkan Register untuk mendapatkan akses login Sistem Inventori</h1>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingNamaLengkap" name="nama_lengkap" placeholder="Milla">
          <label for="floatingNamaLengkap">Nama Lengkap</label>
        </div>

        <div class="form-floating mb-2">
          <input type="text" class="form-control" id="floatingUsername" name="username" placeholder="milla">
          <label for="floatingUsername">Username</label>
        </div>

        <div class="form-floating mb-2">
          <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="test">
          <label for="floatingPassword">Password</label>
        </div>

        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPasswordKonfirmasi" name="password_konfirmasi"
            placeholder="test">
          <label for="floatingPasswordKonfirmasi">Konfirmasi Password</label>
        </div>

        <button class="btn btn-secondary w-100 py-2 my-3" type="submit" name="register">Register</button>
        <a class="d-block text-center mt-2 medium" href="index">Sudah punya akun? Silahkan login!</a>
        <p class="my-3 text-body-secondary text-center">© 2024</p>
      </form>
    </div>
  </div>
</main>
<?php require '__footer.php'; ?>