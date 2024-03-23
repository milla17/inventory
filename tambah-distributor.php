<?php require __DIR__ . "/__fungsi.php"; ?>
<?php require __DIR__ . '/__header.php'; ?>
<?php require __DIR__ . '/__navbar.php'; ?>

<?php   
if (isset($_POST["submit"])) {
  if (tambahDistributor($_POST) > 0) {
    echo "<script>
            alert('Distributor berhasil ditambahkan!');
            document.location.href = 'list-distributor.php';
          </script>";
  } else {
    echo "<script>
            alert('Distributor gagal ditambahkan!');
          </script>";
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
                <h1>Tambah Distributor</h1>
              </div>
              <div class="col-md-6 text-end">
                <a href="list-distributor" class="btn btn-outline-primary rounded-4">
                  Kembali</a>
              </div>
            </div>

            <form action="" method="post">
              <table class='table table-hover table-bordered mt-3'>
                <tr>
                  <td><label for="name" class="form-label">Nama</label></td>
                  <td>:</td>
                  <td><input type="text" name="name" id="name" class="form-control"></td>
                </tr>
                <tr>
                  <td><label for="address" class="form-label">Alamat</label></td>
                  <td>:</td>
                  <td><textarea name="address" id="address" class="form-control"></textarea></td>
                <tr>
                  <td><label for="phone" class="form-label">Nomor Telepon</label></td>
                  <td>:</td>
                  <td><input type="text" name="phone" id="phone" class="form-control"></td>
                </tr>
              </table>
              <button type="submit" name="submit" class="btn btn-primary">Tambah Distributor</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require '__footer.php'; ?>