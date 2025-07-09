<?php echo $this->extend('admin/layout/template') ?>

<?php echo $this->section('content') ?>

<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header mb-4">
            <div class="page-block">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/home') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/jadwal') ?>">jadwal</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                </ul>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="d-flex justify-content-center">
            <div class="card shadow-sm border rounded w-100" style="max-width: 500px;">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><?= $title; ?></h5>
                </div>
                <div class="card-body">
                    <!-- Pesan eror atau gagal -->
                    <?php if (session()->getFlashdata('pesan')): ?>
                        <ul class="text-danger mb-3 ps-3">
                            <li><b><?= esc(session()->getFlashdata('pesan')) ?></b></li>
                        </ul>
                    <?php endif; ?>

                    <!-- Detail -->
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-3">
                            Nama Capster:
                            <strong class="text-dark d-block"><?= esc($jadwal['nama']) ?></strong>
                        </li>
                        <li class="mb-3">
                            Tanggal:
                            <strong class="text-dark d-block"><?= esc($jadwal['tanggal']) ?></strong>
                        </li>
                        <li class="mb-3">
                            Jam:
                            <strong class="text-dark d-block"><?= esc($jadwal['jam']) ?></strong>
                        </li>
                        <li class="mb-3">
                            Status:
                            <?php if ($jadwal['status'] == 'Tersedia') : ?>
                                <strong class="text-success"><?= esc($jadwal['status']) ?></strong>
                            <?php elseif ($jadwal['status'] == 'Penuh') : ?>
                                <strong class="text-danger"><?= esc($jadwal['status']) ?></strong>
                            <?php else : ?>
                                <strong class="text-dark d-block"><?= esc($jadwal['status']) ?></strong>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>

                <!-- Tombol Aksi -->
                <div class="card-footer bg-light px-4 py-3">
                    <div class="flex flex-wrap items-center justify-between w-full">
                        <!-- Kiri: Tombol Kembali -->
                        <a href="<?= base_url('admin/jadwal') ?>"
                            class="text-md px-3 py-1.5 rounded text-gray-700 hover:bg-gray-100">
                            ⬅ Kembali
                        </a>

                        <!-- Kanan: Edit & Hapus -->
                        <div class="flex gap-2 mt-2 sm:mt-0">
                            <a href="<?= base_url('admin/jadwal/edit/' . $jadwal['id']) ?>"
                                class="text-md px-3 py-1.5 rounded bg-blue-600 text-warning hover:bg-blue-700">
                                Edit
                            </a>
                            <a href="<?= base_url('admin/jadwal/delete/' . $jadwal['id']) ?>"
                                onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
                                class="text-md px-3 py-1.5 rounded bg-red-600 text-danger hover:bg-red-700">
                                Hapus
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>