<?php echo $this->extend('admin/layout/template')  ?>

<?php echo $this->section('content')  ?>

<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="page-header-title">
                    <h5 class="mb-0 font-medium"><?= $title; ?></h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/home') ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                </ul>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->

        <a href="<?= base_url('admin/capster_layanan/create') ?>"
            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md badge bg-theme-bg-1 hover:bg-blue-700 text-white text-md font-medium shadow transition text-center">
            <i data-feather="plus" class="w-4 h-4"></i>
            Tambah Capster Layanan
        </a>

        <br>

        <!-- Pesan eror atau gagal -->
        <?php if (session()->getFlashdata('pesan')): ?>
            <ul class="text-danger mb-3 ps-3">
                <li class="fw-bold"><?= esc(session()->getFlashdata('pesan')) ?></li>
            </ul>
        <?php endif; ?>

        <div class="table-responsive">
            <div class="my-3" id="tombol-export"></div>
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Capster</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($capster_layanan as $cl):
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= esc($cl['nama']) ?></td>
                            <td><?= esc($cl['nama_layanan']) ?></td>
                            <td>Rp. <?= number_format($cl['harga'], 0, ',', '.') ?></td>
                            <td>
                                <!-- Tombol edit dan hapus  -->
                                <a href="<?= base_url('admin/capster_layanan/edit/' . $cl['id']) ?>" class="badge bg-warning-600 text-white text-[12px] mx-1">Edit</a>
                                <a href="<?= base_url('admin/capster_layanan/delete/' . $cl['id']) ?>"
                                    class="badge bg-danger-600 text-white text-[12px]"
                                    onclick="return confirm('Yakin ingin menghapus capster layanan ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

<?php echo $this->endSection()  ?>