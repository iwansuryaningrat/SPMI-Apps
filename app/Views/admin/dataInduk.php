<?= $this->extend('template/adminlayout'); ?>

<?= $this->section('admin'); ?>

<div class="header__main-title">
    <div class="header__main-title__pagination">
        <a href="/admin/index">Dashboard</a>
        / Data Induk
    </div>
    <div class="header__main-title__subtitle">
        <div class="title__subtitle-desc">
            <h1>Data Induk</h1>
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
                </span>, selamat datang di dashboard Data Induk</p>
        </div>
    </div>
</div>

<!--========== body main ==========-->
<div class="title__table__add mb-2">
    <h4 class="title__body__user me-3 mb-lg-4 mb-3">Daftar Data Induk</h4>
    <a href="/admin/addDataIndukform" class="btn shadow-none btn__add btn__dark mb-lg-4 mb-3" role="button">
        <i class="fa-solid fa-plus"></i>
        Add Data Induk
    </a>
</div>

<!-- filter -->
<div class="filter__table mb-4">
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
        <div class="sipmpp__table">
            <?= session()->getFlashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table__datainduk__content sipmpp__table-content table-hover">
                    <thead class="bg__light">
                        <tr>
                            <th class="table__datainduk-number">no</th>
                            <th class="table__datainduk-kode">kode</th>
                            <th class="table__datainduk-kebutuhan-data">kebutuhan data</th>
                            <th class="table__datainduk-aksi">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($induk as $induk) : ?>
                        <tr>
                            <td><?= $i; ?>
                            </td>
                            <td class="text-uppercase"><?= $induk['kode'] ?>
                            </td>
                            <td><?= $induk['nama_induk'] ?>
                            </td>
                            <td>
                                <a role="button" data-bs-placement="top" title="Edit"
                                    href="/admin/editDataInduk/<?= $induk['induk_id'] . '/' . $induk['kategori_id'] ?>"
                                    class="edit__data__induk__icon me-3 me-md-5"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                                <a data-bs-placement="top" title="Delete"
                                    href="/admin/deleteinduk/<?= $induk['induk_id'] . '/' . $induk['kategori_id'] ?>"
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
        <div class="sipmpp__table">
            <?= session()->getFlashdata('message'); ?>
            <div class="table-responsive">
                <table class="table table__datainduk__content sipmpp__table-content table-hover">
                    <thead class="bg__light">
                        <tr>
                            <th class="table__datainduk-number">no</th>
                            <th class="table__datainduk-kode">kode</th>
                            <th class="table__datainduk-kebutuhan-data">kebutuhan data</th>
                            <th class="table__datainduk-aksi">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
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
    const tooltipsEdit = document.querySelectorAll(
        ".edit__data__induk__icon"
    );
    tooltipsEdit.forEach((t) => {
        new bootstrap.Tooltip(t);
    });

    const tooltipsDelete = document.querySelectorAll(
        ".delete__data__induk__icon"
    );
    tooltipsDelete.forEach((t) => {
        new bootstrap.Tooltip(t);
    });
</script>

<?= $this->endSection();
