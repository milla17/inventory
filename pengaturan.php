<?php $halaman = "Pengaturan"; ?>

<?php require __DIR__ . "/__fungsi.php"; ?>
<?php require __DIR__ . '/__header.php'; ?>
<?php require __DIR__ . '/__navbar.php'; ?>

<?php 

if (isset($_POST['ubah_profil'])) {
  $email = $_SESSION['user_email'];
  $username = $_SESSION['username'];
  $full_name = $_POST['full_name'];

  $ubah_profil = ubahProfil([
    'email' => $email,
    'full_name' => $full_name
  ]);

  $akun = ambilAkun($username);

  if ($ubah_profil) {
    echo "<script>alert('Profil berhasil diubah.');</script>";
  } else {
    echo "<script>alert('Profil gagal diubah.');</script>";
  }
}

if (isset($_POST['ubah_password'])) {
  $password_baru = $_POST['password_baru'];
  $konfirmasi_password_baru = $_POST['konfirmasi_password_baru'];
  $password_lama = $_POST['password_lama'];

  if ($password_baru !== $konfirmasi_password_baru) {
    echo "<script>alert('Password baru tidak sama dengan konfirmasi password baru.');</script>";
  } else {
    $ubah_password = ubahPassword([
      'password_baru' => $password_baru,
      'password_lama' => $password_lama
    ]);

    if ($ubah_password) {
      echo "<script>alert('Password berhasil diubah.');</script>";
    } else {
      echo "<script>alert('Password gagal diubah.');</script>";
    }
  }
}

?>
<main>
  <div class="container">
    <div class="row text-dark">
      <?php require __DIR__ . '/__sidebar.php'; ?>
      <div class="col-lg-9 col-sm-12 col-md-8 mt-3">
        <div class="card border-0 shadow rounded-5 p-2 border border-top">
          <div class="card-body">
            <div class="row justify-items-center">
              <div class="col-md-6">
                <h1>Pengaturan</h1>
              </div>
            </div>

            <form method="POST">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="input-name" class="form-label">Nama Lengkap</label>
                  <input name="full_name" type="text" class="form-control" id="input-name"
                    value="<?= $akun['full_name']; ?>">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="input-username" class="form-label">Username</label>
                  <input type="text" class="form-control" id="input-username" value="<?= $akun['username']; ?>"
                    disabled="">
                </div>
              </div>
              <hr />
              <div class="card-footer bg-white text-end border-0 pt-0 mb-2">
                <button type="submit" class="btn btn-success rounded-pill px-3" name="ubah_profil">
                  Simpan Profil
                </button>
              </div>
            </form>

            <div class="row justify-items-center">
              <div class="col-md-6">
                <h1>Ubah Password</h1>
              </div>
            </div>

            <form method="POST">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="input-password-baru" class="form-label">Password Baru</label>
                  <input name="password_baru" type="password" class="form-control" id="input-password-baru">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="input-konfirmasi-password-baru" class="form-label">Konfirmasi Password Baru</label>
                  <input name="konfirmasi_password_baru" type="password" class="form-control"
                    id="input-konfirmasi-password-baru">
                </div>
                <div class="col-md-12 mb-3">
                  <label for="input-password-lama" class="form-label">Password Lama</label>
                  <input name="password_lama" type="password" class="form-control" id="input-password-lama">
                </div>
              </div>
              <hr />
              <div class="card-footer bg-white text-end border-0 pt-0 px-0">
                <button type="submit" class="btn btn-success rounded-pill px-3" name="ubah_password">Ganti
                  Password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require '__footer.php'; ?>