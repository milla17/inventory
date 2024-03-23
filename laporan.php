<?php $halaman = "List Laporan"; ?>

<?php require __DIR__ . "/__fungsi.php"; ?>
<?php require __DIR__ . '/__header.php'; ?>
<?php $kategori = daftarKategori(); ?>
<?php $distributor = daftarDistributor(); ?>

<?php $distributor_id = $_GET["distributor"] ?? null; ?>
<?php $type = $_GET["type"] ?? null; ?>
<?php $kode = $_GET["kode"] ?? null; ?>

<?php $date_start = $_GET["date_start"] ?? null; ?>
<?php $date_end = $_GET["date_end"] ?? null; ?>
<?php 
$laporan = [];

foreach ($kategori as $row) :
  $laporan[$row["name"]] = daftarLaporan($row["id"], $type, $distributor_id, $date_start, $date_end);
endforeach; 
?>

<main>
  <div class="container mb-5">
    <div class="row text-dark">
      <div class="col-lg-12 col-sm-12 col-md-12 mt-3">
        <div class="card border-0 rounded-5 p-2 border border-top">
          <div class="card-body">
            <div class="row justify-items-center">
              <div class="col-md-6">
                <h1>Laporan - <?= $kode; ?></h1>
              </div>
              <div class="col-md-6 text-end">
                <a href="list-laporan" class="btn btn-outline-primary rounded-4">
                  Kembali</a>
                <button class="btn btn-success rounded-4 ms-2" onclick="window.print()">
                  <i class="bi bi-printer-fill me-2"></i>
                  Print</button>
              </div>
            </div>
            <div class="col-md-12">
              <button type="button" class="btn btn-outline-danger"
                onclick="window.location.href='laporan.php?kode=<?= $kode; ?>'">
                <i class="bi bi-arrow-counterclockwise"></i> Reset Filter
              </button>
              <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                <i class="bi bi-funnel"></i> Filter
              </button>
            </div>
            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Pengaturan Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                  </div>
                  <form>
                    <input type="hidden" value="<?= $_GET["kode"]; ?>" name="kode">
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="type" class="form-label">Tipe</label>
                        <select class="form-select" id="type" name="type">
                          <option <?php if ($type == '') echo 'selected'; ?> value="">Semua</option>
                          <option value="HASIL_PRODUKSI" <?php if ($type == 'HASIL_PRODUKSI') echo 'selected'; ?>>Hasil
                            Produksi</option>
                          <option value="BARANG_KELUAR" <?php if ($type == 'BARANG_KELUAR') echo 'selected'; ?>>Barang
                            Keluar</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="distributor" class="form-label">Distributor</label>
                        <select class="form-select" id="distributor" name="distributor" disabled>
                          <option selected value="">Semua</option>
                          <?php foreach ($distributor as $dist): ?>
                          <option value="<?= $dist['id']; ?>"
                            <?php if (isset($_GET['distributor']) && $dist['id'] == $_GET['distributor']) echo 'selected'; ?>>
                            <?= $dist['name']; ?>
                          </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="date_start" class="form-label">Mulai Tanggal</label>
                        <input type="date" class="form-control" id="date_start" name="date_start"
                          value="<?= $_GET['date_start'] ?? ''; ?>">
                      </div>
                      <div class="mb-3">
                        <label for="date_end" class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="date_end" name="date_end"
                          value="<?= $_GET['date_end'] ?? ''; ?>">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-12 mx-3">
              <div class="row gap-4">
                <?php $laporan_tersedia = false; ?>
                <?php foreach ($laporan as $kategori => $daftar_laporan): ?>
                <?php $kode_laporan = isset($daftar_laporan[0]["kode"]) ? $daftar_laporan[0]["kode"] : ""; ?>
                <?php if($kode_laporan === $kode) : ?>
                <?php $laporan_tersedia = true; ?>

                <?php $total_produksi = 0; ?>
                <?php $total_barang_keluar = 0; ?>
                <?php $total_barang_terakhir = 0; ?>
                <table class='table table-hover table-bordered mt-3'>
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Waktu</th>
                      <th>Kode</th>
                      <th>Nama</th>
                      <th>Distributor</th>
                      <th>Jumlah Produksi</th>
                      <th>Jumlah Barang Keluar</th>
                      <th>Total Barang Terakhir</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($daftar_laporan as $laporan): ?>
                    <tr>
                      <td><?= $i++; ?></td>
                      <td>
                        <?= tampilHari(date("l", strtotime($laporan["waktu_produksi"]))); ?>,
                        <?= date("d", strtotime($laporan["waktu_produksi"])); ?>
                        <?= tampilBulan(date("F", strtotime($laporan["waktu_produksi"]))); ?>
                        <?= date("Y", strtotime($laporan["waktu_produksi"])); ?>
                      </td>
                      <td><?= $laporan["kode"]; ?></td>
                      <td><?= $laporan["kategori"]; ?></td>
                      <?php if ($laporan["jenis_barang"] === "BARANG_KELUAR") : ?>
                      <td><?= $laporan["distributor"]; ?></td>
                      <?php else : ?>
                      <td>-</td>
                      <?php endif; ?>
                      <td><?= number_format($laporan["hasil_produksi"]); ?></td>
                      <td><?= number_format($laporan["barang_keluar"]); ?></td>
                      <td><?= number_format($laporan["akumulasi_total_barang"]); ?></td>
                    </tr>
                    <?php $total_produksi += $laporan["hasil_produksi"]; ?>
                    <?php $total_barang_keluar += $laporan["barang_keluar"]; ?>
                    <?php $total_barang_terakhir = $laporan["akumulasi_total_barang"]; ?>
                    <?php endforeach; ?>
                    <?php if ($i == 1) : ?>
                    <tr>
                      <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                      <td colspan="5" class="text-end"><strong>Total</strong></td>
                      <td><strong><?= number_format($total_produksi); ?></strong></td>
                      <td><strong><?= number_format($total_barang_keluar); ?></strong></td>
                      <td><strong><?= number_format($total_barang_terakhir); ?></strong></td>
                    </tr>
                  </tbody>
                </table>
                <?php else : ?>
                <?php continue; ?>
                <?php endif; ?>
                <?php endforeach; ?>

                <?php if (!$laporan_tersedia) : ?>
                <div class="alert alert-info mt-3">
                  <strong>Peringatan!</strong> Laporan tidak ditemukan.
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
  const modalType = document.getElementById("type");
  const distributorSelect = document.getElementById('distributor');

  modalType.addEventListener('change', (event) => {
    if (event.target.value === 'BARANG_KELUAR') {
      distributorSelect.disabled = false;
    } else {
      distributorSelect.disabled = true;
    }
  });

  <?php if (isset($_GET['distributor'])) : ?>
  distributorSelect.disabled = false;
  <?php endif; ?>
});
</script>

<?php require __DIR__ . "/__footer.php"; ?>