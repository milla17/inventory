<?php $halaman = "Dasbor"; ?>

<?php require __DIR__ . "/__fungsi.php"; ?>
<?php require __DIR__ . '/__header.php'; ?>
<?php require __DIR__ . '/__navbar.php'; ?>

<?php if(!isset($akun)) {
  header("Location: index");
  exit;
} ?>

<?php 
$grafik = tampilkanGrafikDasbor(); 
?>

<main>
  <div class="container">
    <div class="row text-dark">
      <?php require __DIR__ . '/__sidebar.php'; ?>
      <div class="col-lg-9 col-sm-12 col-md-8 mt-3">
        <div class="row">
          <?php for($i = 0; $i < 4; $i++) : ?>
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      Earnings (Monthly)</div>
                    <div class="h5 mb-0 font-weight-bold text-secondary">$40,000</div>
                  </div>
                  <div class="col-auto">
                    <i class="bi bi-calendar2-date bi-2x text-secondary"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endfor; ?>
        </div>
        <div class="card border-0 shadow rounded-4 p-2 border border-top mb-4">
          <div class="card-body">
            <div class="row justify-items-center">
              <div class="col-md-6">
                <h1>Dasbor</h1>
              </div>
            </div>
            <div class="col-md-12 mx-3">
              <canvas id="myChart"></canvas>

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card border-0 shadow rounded-4 p-2 border border-top mb-4">
              <div class="card-body">
                <div class="card-title">
                  <h5><strong>Data Stok</strong></h5>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kategori</th>
                      <th>Stok</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Data 1</td>
                      <td>Data 2</td>
                      <td>Data 3</td>
                    </tr>
                    <tr>
                      <td>Data 4</td>
                      <td>Data 5</td>
                      <td>Data 6</td>
                    </tr>
                    <!-- Add more rows as needed -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-0 shadow rounded-4 p-2 border border-top mb-4">
              <div class="card-body">
                <div class="card-title">
                  <h5><strong>5 Hasil Produksi Terakhir</strong></h5>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kategori</th>
                      <th>Stok</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Data 1</td>
                      <td>Data 2</td>
                      <td>Data 3</td>
                    </tr>
                    <tr>
                      <td>Data 4</td>
                      <td>Data 5</td>
                      <td>Data 6</td>
                    </tr>
                    <!-- Add more rows as needed -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-0 shadow rounded-4 p-2 border border-top mb-4">
              <div class="card-body">
                <div class="card-title">
                  <h5><strong>5 Barang Keluar Terakhir</strong></h5>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kategori</th>
                      <th>Stok</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Data 1</td>
                      <td>Data 2</td>
                      <td>Data 3</td>
                    </tr>
                    <tr>
                      <td>Data 4</td>
                      <td>Data 5</td>
                      <td>Data 6</td>
                    </tr>
                    <!-- Add more rows as needed -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('myChart').getContext('2d');

const dataJSON = <?php echo $grafik; ?>;
const categories = dataJSON.kategori.map((item) => item.nama);
const totalProduksi = dataJSON.kategori.map((item) => item.total_produksi);
const totalBarangKeluar = dataJSON.kategori.map((item) => item.total_barang_keluar);
const totalStokSekarang = dataJSON.kategori.map((item) => item.stok);

// Data dummy untuk tiga batang setiap label
var data = {
  labels: categories,
  datasets: [{
    label: 'Total Barang Produksi',
    data: totalProduksi, // Data untuk batang pertama
    backgroundColor: 'rgba(255, 99, 132, 0.2)',
    borderColor: 'rgba(255,99,132,1)',
    borderWidth: 1
  }, {
    label: 'Total Barang Keluar',
    data: totalBarangKeluar, // Data untuk batang kedua
    backgroundColor: 'rgba(54, 162, 235, 0.2)',
    borderColor: 'rgba(54, 162, 235, 1)',
    borderWidth: 1
  }, {
    label: 'Total Stok Sekarang',
    data: totalStokSekarang, // Data untuk batang ketiga
    backgroundColor: 'rgba(255, 206, 86, 0.2)',
    borderColor: 'rgba(255, 206, 86, 1)',
    borderWidth: 1
  }]
};

var myChart = new Chart(ctx, {
  type: 'bar',
  data: data,
});
</script>
<?php require '__footer.php'; ?>