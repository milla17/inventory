<?php $halaman = "Ubah Arsip"; ?>
<?php require __DIR__ . "/__fungsi.php"; ?>
<?php require __DIR__ . '/__header.php'; ?>
<?php require __DIR__ . '/__navbar.php'; ?>

<?php $kategori = daftarKategori(); ?>

<?php

$arsip = lihatArsip($_GET["id"]);

if (isset($_POST["submit"])) {
  if (ubahArsip($_GET['id'], $_POST) > 0) {
    echo "<script>
            alert('Arsip berhasil diubah!');
            document.location.href = 'list-arsip.php';
          </script>";
  } else {
    echo "<script>
            alert('Arsip gagal diubah!');
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
                <h1>Ubah Arsip</h1>
              </div>
              <div class="col-md-6 text-end">
                <a href="list-arsip" class="btn btn-outline-primary rounded-4">
                  Kembali</a>
              </div>
            </div>

            <form action="" method="post">
              <table class='table table-hover table-bordered mt-3'>
                <tr>
                  <td><label class="form-label" for="kategori">Kategori</label></td>
                  <td>:</td>
                  <td>
                    <select name="kategori_id" id="kategori" class="form-select">
                      <option value="">Pilih Kategori</option>
                      <?php foreach ($kategori as $row) : ?>
                      <option value="<?= $row["id"]; ?>" <?= $row["id"] == $arsip["category_id"] ? "selected" : ""; ?>>
                        <?= $row["name"]; ?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label class="form-label" for="jumlah">Jumlah</label></td>
                  <td>:</td>
                  <td><input type="text" name="jumlah" id="jumlah" value="<?= $arsip["quantity"]; ?>"
                      class="form-control"></td>
                <tr>
                  <td>
                    <label class="form-label" for="tipe">Tipe</label>
                  </td>
                  <td>:</td>
                  <td>
                    <select name="tipe" id="tipe" class="form-select">
                      <option value="">Pilih Tipe</option>
                      <option value="HASIL_PRODUKSI" <?= $arsip["type"] == "HASIL_PRODUKSI" ? "selected" : ""; ?>>Hasil
                        Produksi</option>
                      <option value="BARANG_KELUAR" <?= $arsip["type"] == "BARANG_KELUAR" ? "selected" : ""; ?>>Barang
                        Keluar
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label class="form-label" for="tanggal">Tanggal</label></td>
                  <td>:</td>
                  <td><input type="date" name="tanggal" id="tanggal" class="form-control"
                      value="<?= date("Y-m-d", strtotime($arsip["created_at"])); ?>">
                  </td>
                </tr>
              </table>
              <button type="submit" name="submit" class="btn btn-primary">Ubah Arsip</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php require '__footer.php'; ?>