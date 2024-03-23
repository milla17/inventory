<?php $total_arsip = jumlahArsip(""); ?>
<?php $total_distributor = jumlahDistributor(""); ?>
<div class="col-lg-3 col-sm-12 col-md-4 mt-3">
  <div class="card border-0 shadow rounded-5 p-2 border border-top">
    <div class="card-body">
      <img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png"
        class="rounded-5 img-thumbnail mb-3" style="max-height: 114px">
      <h5 class="card-title"><?= $akun['full_name']; ?></h5>
      <h6 class="card-subtitle mb-2 text-muted">Admin — <?= $akun['username']; ?></h6>
      <div class="card-body px-0 border-top pt-3 mt-3">
        <div class="d-grid gap-2">
          <a href="dasbor"
            class="btn <?= $halaman === 'Dasbor' ? "btn-success active" : "btn-light" ?> text-start w-100 rounded-2"
            style="line-height: initial;">
            <i class="bi <?= $halaman === 'Dasbor' ? "bi-house-fill" : "bi-house" ?> me-2"></i>
            Dasbor
          </a>
          <a href="list-kategori"
            class="btn <?= $halaman === 'List Kategori' ? "btn-success active" : "btn-light" ?> text-start w-100 rounded-2"
            style="line-height: initial;">
            <i
              class="bi <?= $halaman === 'List Kategori' ? "bi-file-earmark-arrow-down-fill" : "bi-file-earmark-arrow-down" ?> me-2"></i>
            Kategori
          </a>
          <a href="list-distributor"
            class="btn <?= $halaman === 'List Distributor' ? "btn-success active" : "btn-light" ?> text-start w-100 rounded-2"
            style="line-height: initial;">
            <div class="d-flex justify-content-start">
              <i class="bi <?= $halaman === 'List Distributor' ? "bi-bag-fill" : "bi-bag" ?> me-2"></i>
              <span class="ms-1 flex-grow-1">Distributor</span>
              <label class="badge <?= $halaman === 'List Distributor' ? "text-bg-light" : "text-bg-secondary" ?>">
                <span class="align-text-bottom">
                  <?= $total_distributor; ?>
                </span>
              </label>
            </div>
          </a>
          <a href="list-arsip"
            class="btn <?= $halaman === 'List Arsip' ? "btn-success active" : "btn-light" ?> text-start w-100 rounded-2"
            style="line-height: initial;">
            <div class="d-flex justify-content-start">
              <i class="bi <?= $halaman === 'List Arsip' ? "bi-patch-question-fill" : "bi-patch-question" ?> me-2"></i>
              <span class="ms-1 flex-grow-1">Arsip</span>
              <label class="badge <?= $halaman === 'List Arsip' ? "text-bg-light" : "text-bg-secondary" ?>">
                <span class="align-text-bottom">
                  <?= $total_arsip; ?>
                </span>
              </label>
            </div>
          </a>
          <a href="list-laporan"
            class="btn <?= $halaman === 'List Laporan' ? "btn-success active" : "btn-light" ?> text-start w-100 rounded-2"
            style="line-height: initial;">
            <div class="d-flex justify-content-start">
              <i class="bi <?= $halaman === 'List Laporan' ? "bi-cloud-fill" : "bi-cloud" ?> me-2"></i>
              <span class="ms-1 flex-grow-1">Laporan</span>
            </div>
          </a>
          <a href="pengaturan"
            class="btn <?= $halaman === 'Pengaturan' ? "btn-success active" : "btn-light" ?> text-start w-100 rounded-2"
            style="line-height: initial;">
            <i class="bi <?= $halaman === 'Pengaturan' ? "bi-gear-fill" : "bi-gear" ?> me-2"></i>
            Pengaturan
          </a>
          <hr class="my-2" />
          <a class="btn btn-danger rounded-pill" href="keluar">
            Keluar
          </a>
        </div>
      </div>
    </div>
  </div>
</div>