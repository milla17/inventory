<?php $halaman = "List Arsip"; ?>
<?php $page = $_GET["page"] ?? 1; ?>
<?php $search = $_GET["q"] ?? ""; ?>
<?php $limit = 15; ?>

<?php require __DIR__ . "/__fungsi.php"; ?>
<?php require __DIR__ . "/__header.php"; ?>
<?php require __DIR__ . '/__navbar.php'; ?>
<?php $arsip = daftarArsip($page, $limit, $search); ?>
<?php $jumlah_arsip = jumlahArsip($search); ?>

<main>
  <div class="container">
    <div class="row text-dark">
      <?php require __DIR__ . '/__sidebar.php'; ?>
      <div class="col-lg-9 col-sm-12 col-md-8 mt-3">
        <div class="card border-0 shadow rounded-5 p-2 border border-top">
          <div class="card-body">
            <div class="row justify-items-center align-middle align-items-center">
              <div class="col-md-4">
                <h1>Daftar Arsip</h1>
              </div>
              <div class="col-md-8 d-flex justify-content-end gap-3 align-items-center">
                <form action="" method="get">
                  <div class="input-group">
                    <input type="text" class="form-control rounded-4" placeholder="Cari Arsip" name="q"
                      value="<?= $search; ?>">
                    <button class="btn btn-primary rounded-4 ms-2" type="submit">
                      <i class="bi bi-search"></i>
                    </button>
                  </div>
                </form>
                <a href="tambah-arsip.php" class="btn btn-primary rounded-4">
                  <i class="bi bi-plus-circle-fill me-2"></i>
                  Tambah Arsip
                </a>
              </div>
            </div>
            <table class='table table-hover table-bordered mt-3'>
              <tr>
                <th>No.</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Distributor</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
              <?php $i = ($page - 1) * $limit + 1; ?>
              <?php foreach ($arsip as $row) : ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $row["category_code"]; ?></td>
                <td><?= $row["category_name"]; ?></td>
                <?php if($row["type"] === "BARANG_KELUAR") : ?>
                <td><?= $row["distributor_name"]; ?></td>
                <?php elseif($row["type"] === "HASIL_PRODUKSI") : ?>
                <td>-</td>
                <?php endif;?>
                <td><?= str_replace("_", " ", $row["type"]); ?></td>
                <td><?= number_format($row["quantity"]); ?></td>
                <td><?= $row["created_at"]; ?></td>
                <td>
                  <a href="ubah-arsip.php?id=<?= $row["id"]; ?>" class="btn btn-sm btn-warning">
                    <i class="bi bi-pencil"></i>
                    Ubah
                  </a> |
                  <a href="hapus-arsip.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin?');"
                    class="btn btn-sm btn-danger">
                    <i class="bi bi-trash"></i>
                    Hapus
                  </a>
                </td>
              </tr>
              <?php endforeach; ?>
              <?php if($i === 1) : ?>
              <tr>
                <td colspan="8" class="text-center">Tidak ada data</td>
              </tr>
              <?php endif; ?>
            </table>
            <div class="row">
              <div class="col-md-12 d-flex justify-content-center">
                <nav class="text-center">

                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require __DIR__ . "/__footer.php"; ?>