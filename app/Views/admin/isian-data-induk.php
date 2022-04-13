<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard</a>
        / Isian Data Induk
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Isian Data Induk</h1>
            <p>Halo <span><?php // uses regex that accepts any word character or hyphen in last name
                            function split_name($name)
                            {
                                $name = trim($name);
                                $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
                                $first_name = trim(preg_replace('#' . preg_quote($last_name, '#') . '#', '', $name));
                                return array($first_name, $last_name);
                            }
                            echo split_name($usersession['nama'])[0];
                            ?>
                </span>, selamat datang di dashboard Isian Data Induk</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add mb-2">
    <h4 class="title__body__user me-3 mb-lg-4 mb-3">Isian Data Induk</h4>
    <div class="title__body__button">
        <a href="/admin/autoGenerateDataInduk" class="btn shadow-none btn__add btn__generate mb-lg-4 mb-3"
            role="button">
            <i class="fa-solid fa-folder-plus"></i>
            Auto Generate
        </a>
    </div>
</div>

<!-- filter -->
<div class="filter__table">
    <div class="nav nav-pills" id="pills-tab" role="tablist">
        <button class="btn filter__btn me-0 me-md-3 shadow-none active nav-link active" id="pills-datainduk-penelitian"
            data-bs-toggle="pill" data-bs-target="#pills-table-datainduk-penelitian" type="button" role="tab"
            aria-controls="pills-table-datainduk-penelitian" aria-selected="true">
            Penelitian
        </button>
        <button class="btn filter__btn shadow-none nav-link" id="pills-datainduk-pm" data-bs-toggle="pill"
            data-bs-target="#pills-table-datainduk-pm" type="button" role="tab" aria-controls="pills-table-datainduk-pm"
            aria-selected="false">
            Pengabdian Masyarakat
        </button>
    </div>
</div>

<div class="tab-content" id="pills-tabContent">
    <!-- penelitian -->
    <div class="tab-pane fade show active" id="pills-table-datainduk-penelitian" role="tabpanel"
        aria-labelledby="pills-datainduk-penelitian">
        <!-- table data induk -->
        <div class="">
            <?= session()->getFlashdata('message'); ?>
            <div class="table-responsive">
                <table id="datatableDataIndukPenelitian" class="display">
                    <thead class="bg__light">
                        <tr>
                            <th class="datatable__number">no</th>
                            <th class="datatable__tahun">tahun</th>
                            <th class="datatable__unit">unit</th>
                            <th class="datatable__kode">kode</th>
                            <th class="datatable__kebutuhan-data">kebutuhan data</th>
                            <th class="datatable__aksi">aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($indukPEN as $data) : ?>
                        <tr>
                            <td><?= $i; ?>
                            </td>
                            <td><?= $data['tahun'] ?>
                            </td>
                            <td><?= $data['nama_unit'] ?>
                            </td>
                            <td><?= $data['kode'] ?>
                            </td>
                            <td><?= $data['nama_induk'] ?>
                            </td>
                            <td>
                                <a data-bs-placement="top" title="Delete"
                                    href="/deletedata/deleteIsian/<?= $data['tahun'] . '/' . $data['unit_id'] . '/' . $data['induk_id'] . '/' . $data['kategori_id'] ?>"
                                    class="delete__data__induk__icon"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php $i++;
                        endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- pengabdian masyarakat -->
    <div class="tab-pane fade" id="pills-table-datainduk-pm" role="tabpanel" aria-labelledby="pills-datainduk-pm">
        <!-- table data induk -->
        <div class="">
            <?= session()->getFlashdata('message'); ?>
            <div class="table-responsive">
                <table id="datatableDataIndukPengabdian" class="display">
                    <thead class="bg__light">
                        <tr>
                            <th class="datatable__number">no</th>
                            <th class="datatable__tahun">tahun</th>
                            <th class="datatable__unit">unit</th>
                            <th class="datatable__kode">kode</th>
                            <th class="datatable__kebutuhan-data">kebutuhan data</th>
                            <th class="datatable__aksi">aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1;
                        foreach ($indukPPM as $data) : ?>
                        <tr>
                            <td><?= $i; ?>
                            </td>
                            <td><?= $data['tahun'] ?>
                            </td>
                            <td><?= $data['nama_unit'] ?>
                            </td>
                            <td><?= $data['kode'] ?>
                            </td>
                            <td><?= $data['nama_induk'] ?>
                            </td>
                            <td>
                                <a data-bs-placement="top" title="Delete"
                                    href="/deletedata/deleteIsian/<?= $data['tahun'] . '/' . $data['unit_id'] . '/' . $data['induk_id'] . '/' . $data['kategori_id'] ?>"
                                    class="delete__data__induk__icon"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php $i++;
                        endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<!-- datatable cdn -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
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
    const tooltipsEdit = document.querySelectorAll(
        ".edit__data__induk__icon");
    tooltipsEdit.forEach((t) => {
        new bootstrap.Tooltip(t);
    });
    const tooltipsDelete = document.querySelectorAll(".delete__data__induk__icon");
    tooltipsDelete.forEach((t) => {
        new bootstrap.Tooltip(t);
    });

    // datatable
    $(document).ready(function() {
        $('#datatableDataIndukPenelitian').DataTable();
        $('#datatableDataIndukPengabdian').DataTable();
    });
</script>

<?= $this->endSection();
