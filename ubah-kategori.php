<?php $halaman = "Ubah Kategori"; ?>

<?php require __DIR__ . "/__fungsi.php"; ?>
<?php require __DIR__ . '/__header.php'; ?>
<?php require __DIR__ . '/__navbar.php'; ?>
<?php $kategori = lihatKategori($_GET["id"]); ?>

<?php 
if (isset($_POST["submit"])) {
  if (ubahKategori($_GET["id"], $_POST) > 0) {
    echo "<script>
            alert('Kategori berhasil diubah!');
            document.location.href = 'list-kategori.php';
          </script>";
  } else {
    echo "<script>
            alert('Kategori gagal diubah!');
            document.location.href = 'list-kategori.php';
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
                <h1>Ubah Kategori</h1>
              </div>
              <div class="col-md-6 text-end">
                <a href="list-kategori" class="btn btn-outline-primary rounded-4">
                  Kembali</a>
              </div>
            </div>

            <form action="" method="post" class="mt-3">
              <label for="nama" class="form-label">Nama Kategori</label>
              <input type="text" name="nama" id="nama" required class="form-control mb-3"
                value="<?= $kategori["name"]; ?>">

              <button type="submit" name="submit" class="btn btn-primary">
                Ubah Kategori
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require '__footer.php'; ?>