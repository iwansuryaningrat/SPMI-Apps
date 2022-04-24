<?= $this->extend('template/auditorlayout'); ?>

<?= $this->section('auditor'); ?>

<div class="header__main-title">
  <div class="header__main-title__pagination">
    <a id="unit-user" href="/">Audit <?= $data_user['unit']; ?></a>
    / Nilai SPMI
  </div>
  <div class="header__main-title__subtitle">
    <div class="title__subtitle-desc">
      <h1>Audit Penilaian SPMI</h1>
      <p>Daftar nilai SPMI sesuai unit dan standar</p>
    </div>
  </div>
</div>

<!--========== body main ==========-->
<div class="status__spmi__content">
  <div class="spmi__content-desc me-2">
    <h4 class="title__body__main">Unit: <span><?= $data_user['unit']; ?></span>
      <span><?= $data_user['tahun']; ?></span>
    </h4>
    <p class="status__spmi">
      Status Penilaian: <span id="status-spmi" class=" <?php if ($status == 'Belum Dikirim') {
                                                          echo 'color__warning';
                                                        } elseif ($status == 'Dikirim') {
                                                          echo 'color__primary';
                                                        } else {
                                                          echo 'color__success';
                                                        } ?> "><?= $status; ?></span>
    </p>
  </div>
  <div class="spmi__content-btn">
    <a href="#" class="btn kirim__btn">
      <i class="fa-solid fa-file-signature"></i>
      Konfirmasi Audit
    </a>
  </div>
</div>

<!-- filter -->
<div class="filter__table">
  <div class="nav nav-pills" id="pills-tab" role="tablist">
    <button class="btn filter__btn me-0 me-md-3 shadow-none active nav-link ellipsis__text active" id="pills-spmi-penelitian" data-bs-toggle="pill" data-bs-target="#pills-table-spmi-penelitian" type="button" role="tab" aria-controls="pills-table-spmi-penelitian" aria-selected="true">
      Penelitian
    </button>
    <button class="btn filter__btn shadow-none nav-link ellipsis__text" id="pills-spmi-pm" data-bs-toggle="pill" data-bs-target="#pills-table-spmi-pm" type="button" role="tab" aria-controls="pills-table-spmi-pm" aria-selected="false">
      Pengabdian Masyarakat
    </button>
  </div>
</div>

<!-- =====data table spmi =====-->
<div class="tab-content" id="pills-tabContent">
  <?= session()->getFlashdata('message'); ?>
  <!-- penelitian -->
  <div class="tab-pane fade show active" id="pills-table-spmi-penelitian" role="tabpanel" aria-labelledby="pills-spmi-penelitian">
    <div class="sipmpp__table">
      <div class="table-responsive">
        <table class="table table__spmi__content sipmpp__table-content table-hover" id="spmi-penelitian">
          <thead class="bg__light">
            <tr>
              <th class="table__spmi-number">No</th>
              <th class="table__spmi-standar">Standar</th>
              <th class="table__spmi-nama">Nama</th>
              <th class="table__spmi-status">Status</th>
              <th class="table__spmi-nilai">Nilai Akhir</th>
              <th class="table__spmi-aksi">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data_standar as $standar) :
              if ($standar['kategori_id'] == 'PEN') : ?>
                <tr>
                  <td><?= $i; ?>
                  </td>
                  <td class="text-uppercase">
                    <span class="badge badge__standar"><?= $standar['standar_id']; ?></span>
                  </td>
                  <td><?= $standar['nama_standar']; ?>
                  </td>
                  <td>
                    <span class="badge badge__sipmpp <?php if ($standar['status'] == 'Diaudit') {
                                                        echo 'badge__success';
                                                      } elseif ($standar['status'] == 'Dikirim') {
                                                        echo 'badge__primary';
                                                      } elseif ($standar['status'] == 'Belum Diisi') {
                                                        echo 'badge__danger';
                                                      } else {
                                                        echo 'badge__warning';
                                                      } ?>"><?= $standar['status']; ?></span>
                  </td>
                  <td><?php
                      foreach ($data_nilai as $nilai) :
                        if ($nilai['standar_id'] == $standar['standar_id'] && $nilai['kategori_id'] == $standar['kategori_id']) {
                          echo sprintf("%.2f", floatval($nilai['nilai_akhir']));
                        }
                      endforeach; ?>
                  </td>
                  <td>
                    <a data-bs-placement="top" title="Lihat" href="/auditor/indikator/<?= $standar['standar_id'] . '/' . $standar['kategori_id'] ?>" class="edit__data__induk__icon">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                  </td>
                </tr>
            <?php
                $i++;
              endif;
            endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- pengabdian masyarakat -->
  <div class="tab-pane fade" id="pills-table-spmi-pm" role="tabpanel" aria-labelledby="pills-spmi-pm">
    <div class="sipmpp__table">
      <div class="table-responsive">
        <table class="table table__spmi__content sipmpp__table-content table-hover" id="spmi-pm">
          <thead class="bg__light">
            <tr>
              <th class="table__spmi-number">No</th>
              <th class="table__spmi-standar">Standar</th>
              <th class="table__spmi-nama">Nama</th>
              <th class="table__spmi-status">Status</th>
              <th class="table__spmi-nilai">Nilai Akhir</th>
              <th class="table__spmi-aksi">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php $i = 1;
            foreach ($data_standar as $standar) :
              if ($standar['kategori_id'] == 'PPM') : ?>
                <tr>
                  <td><?= $i; ?>
                  </td>
                  <td class="text-uppercase">
                    <span class="badge badge__standar"><?= $standar['standar_id']; ?></span>
                  </td>
                  <td><?= $standar['nama_standar']; ?>
                  </td>
                  <td>
                    <span class="badge badge__sipmpp <?php if ($standar['status'] == 'Dikirim' || $standar['status'] == 'Diaudit') {
                                                        echo 'badge__success';
                                                      } elseif ($standar['status'] == 'Belum Diisi') {
                                                        echo 'badge__danger';
                                                      } else {
                                                        echo 'badge__warning';
                                                      } ?>"><?= $standar['status']; ?></span>
                  </td>
                  <td><?php
                      foreach ($data_nilai as $nilai) :
                        if ($nilai['standar_id'] == $standar['standar_id'] && $nilai['kategori_id'] == $standar['kategori_id']) {
                          echo sprintf("%.2f", floatval($nilai['nilai_akhir']));
                        }
                      endforeach; ?>
                  </td>
                  <td>
                    <a data-bs-placement="top" title="Lihat" href="/auditor/indikator/<?= $standar['standar_id'] . '/' . $standar['kategori_id'] ?>" class="edit__data__induk__icon">
                      <i class="fa-solid fa-eye"></i>
                    </a>
                  </td>
                </tr>
            <?php
                $i++;
              endif;
            endforeach; ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<script>
  // active filer button
  $(function() {
    $(".filter__btn").click(function() {
      // remove classes from all
      $(".filter__btn").removeClass("active");
      // add class to the one we clicked
      $(this).addClass("active");
      // stop the page from jumping to the top
      return false;
    });
  });

  // tooltips
  // progress bar unit
  const tooltipsEdit = document.querySelectorAll(
    ".edit__data__induk__icon"
  );
  tooltipsEdit.forEach((t) => {
    new bootstrap.Tooltip(t);
  });
</script>

<?= $this->endSection();
