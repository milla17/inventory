<?php $halaman = "List Laporan"; ?>

<?php require __DIR__ . "/__fungsi.php"; ?>
<?php require __DIR__ . '/__header.php'; ?>
<?php require __DIR__ . '/__navbar.php'; ?>
<?php $kategori = daftarKategori(); ?>

<?php 

$laporan = [];
$semua_laporan = daftarSemuaLaporan();

foreach ($kategori as $row) :
  $laporan[$row["name"]] = daftarLaporan($row["id"]);
endforeach; 

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
                <h1>List Laporan</h1>
              </div>
            </div>
            <div class="col-md-12 mx-3">
              <div class="row gap-4">
                <div class="card py-2">
                  <div class="card-body">
                    <h5 class="card-title"><strong>Semua Laporan</strong></h5>
                    <p class="card-text">Kode: Semua Kode Terlampir</p>
                    <?php if (isset($semua_laporan[0]["kode"])): ?>
                    <a href="laporan-semua" class="btn btn-outline-success w-100">
                      Lihat Laporan
                      <span class="badge bg-success ms-2"><?= count($semua_laporan); ?></span>
                    </a>
                    <?php else: ?>
                    <button class="btn btn-outline-success w-100" disabled>
                      Lihat Laporan
                      <span class="badge bg-success ms-2"><?= count($semua_laporan); ?></span>
                    </button>
                    <?php endif; ?>
                  </div>
                </div>
                <?php $total = 0; ?>
                <?php foreach ($laporan as $kategori => $daftar_laporan): ?>
                <div class="card py-2" style="width: 18rem;">
                  <div class="card-body">
                    <h5 class="card-title"><strong><?= $kategori; ?></strong></h5>
                    <p class="card-text">Kode:
                      <?= isset($daftar_laporan[0]["kode"]) ? $daftar_laporan[0]["kode"] : "Tidak ada laporan"; ?></p>
                    <?php if (isset($daftar_laporan[0]["kode"])): ?>
                    <a href="laporan?kode=<?= $daftar_laporan[0]["kode"]; ?>" class="btn btn-outline-success w-100">
                      Lihat Laporan
                      <span class="badge bg-success ms-2"><?= count($daftar_laporan); ?></span>
                    </a>
                    <?php $total += count($daftar_laporan); ?>
                    <?php else: ?>
                    <button class="btn btn-outline-success w-100" disabled>
                      Lihat Laporan
                      <span class="badge bg-success ms-2"><?= count($daftar_laporan); ?></span>
                    </button>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php require __DIR__ . "/__footer.php"; ?>