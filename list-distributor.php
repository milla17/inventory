<?php $halaman = "List Distributor"; ?>

<?php require __DIR__ . "/__fungsi.php"; ?>
<?php require __DIR__ . '/__header.php'; ?>
<?php require __DIR__ . '/__navbar.php'; ?>
<?php $distributors = daftarDistributor(); ?>

<main>
  <div class="container">
    <div class="row text-dark">
      <?php require __DIR__ . '/__sidebar.php'; ?>
      <div class="col-lg-9 col-sm-12 col-md-8 mt-3">
        <div class="card border-0 shadow rounded-5 p-2 border border-top">
          <div class="card-body">
            <div class="row justify-items-center">
              <div class="col-md-6">
                <h1>Daftar Distributor</h1>
              </div>
              <div class="col-md-6 text-end">
                <a href="tambah-distributor.php" class="btn btn-primary rounded-4">
                  <i class="bi bi-plus-circle-fill me-2"></i>
                  Tambah Distributor</a>
              </div>
            </div>

            <table class='table table-hover table-bordered mt-3'>
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Nomor Telepon</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($distributors as $item) : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= $item["name"]; ?></td>
                  <td><?= $item["address"]; ?></td>
                  <td><?= $item["phone"]; ?></td>
                  <td>
                    <a href="ubah-distributor?id=<?= $item["id"]; ?>" class="btn btn-sm btn-warning">
                      <i class="bi bi-pencil"></i>
                      Ubah
                    </a> |
                    <a href="hapus-distributor?id=<?= $item["id"]; ?>" onclick="return confirm('Yakin?');"
                      class="btn btn-sm btn-danger">
                      <i class="bi bi-trash"></i>
                      Hapus</a>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php if($i === 1) : ?>
                <tr>
                  <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require '__footer.php'; ?>