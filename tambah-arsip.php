<?php $halaman = "Tambah Arsip"; ?>
<?php require __DIR__ . "/__fungsi.php"; ?>
<?php require __DIR__ . "/__header.php"; ?>
<?php require __DIR__ . '/__navbar.php'; ?>
<?php $kategori = daftarKategori(); ?>
<?php $distributor = daftarDistributor(); ?>

<?php
if (isset($_POST["submit"])) {
  if (tambahArsip($_POST) > 0) {
    echo "<script>
            alert('Arsip berhasil ditambahkan!');
            document.location.href = 'list-arsip.php';
          </script>";
  } else {
    echo "<script>
            alert('Arsip gagal ditambahkan!');
            document.location.href = 'list-arsip.php';
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
                <h1>Tambah Arsip</h1>
              </div>
              <div class="col-md-6 text-end">
                <a href="list-arsips" class="btn btn-outline-primary rounded-4">
                  Kembali
                </a>
              </div>
            </div>
            <form action="" method="post">
              <table class='table table-hover table-bordered mt-3'>
                <tr>
                  <td>
                    <label for="tipe" class="form-label">Tipe</label>
                  </td>
                  <td>:</td>
                  <td>
                    <select name="tipe" id="tipe" class="form-select">
                      <option value="">Pilih Tipe</option>
                      <option value="HASIL_PRODUKSI">Hasil Produksi</option>
                      <option value="BARANG_KELUAR">Barang Keluar</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="kategori" class="form-label">Kategori</label></td>
                  <td>:</td>
                  <td>
                    <select name="kategori_id" id="kategori" class="form-select">
                      <option value="">Pilih Kategori</option>
                      <?php foreach ($kategori as $row) : ?>
                      <option value="<?= $row["id"]; ?>"><?= $row["code"]; ?> - <?= $row["name"]; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="distributor" class="form-label">Distributor</label></td>
                  <td>:</td>
                  <td>
                    <select name="distributor_id" id="distributor" class="form-select" disabled>
                      <option value="">Pilih Distributor</option>
                      <?php foreach ($distributor as $row) : ?>
                      <option value="<?= $row["id"]; ?>"><?= $row["name"]; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="jumlah" class="form-label">Jumlah</label></td>
                  <td>:</td>
                  <td><input type="number" name="jumlah" id="jumlah" class="form-control"></td>
                <tr>
                  <td><label for="tanggal" class="form-label">Tanggal</label></td>
                  <td>:</td>
                  <td><input type="date" name="tanggal" id="tanggal" class="form-control"></td>
                </tr>
              </table>
              <button type="submit" name="submit" class="btn btn-primary">Tambah Arsip</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
  const tipeSelect = document.getElementById('tipe');
  const distributorSelect = document.getElementById('distributor');

  tipeSelect.addEventListener('change', (event) => {
    if (event.target.value === 'BARANG_KELUAR') {
      distributorSelect.disabled = false;
    } else {
      distributorSelect.disabled = true;
    }
  });
});
</script>

<?php require __DIR__ . "/__footer.php"; ?>