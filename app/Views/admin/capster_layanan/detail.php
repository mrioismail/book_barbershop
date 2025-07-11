<?php echo $this->extend('admin/layout/template') ?>

<?php echo $this->section('content') ?>

<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header mb-4">
            <div class="page-block">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/home') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/layanan') ?>">Layanan</a></li>
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

                    <!-- Foto -->
                    <div class="text-center mb-4">
                        <img src="<?= base_url('admin/assets/images/uploads/' . $layanan['foto_layanan']) ?>"
                            alt="Foto Layanan"
                            class="img-fluid rounded shadow-sm border"
                            style="max-width: 200px;">
                    </div>

                    <!-- Detail -->
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-3">
                            Nama Layanan:
                            <strong class="text-dark d-block"><?= esc($layanan['nama_layanan']) ?></strong>
                        </li>
                        <li>
                            Detail Layanan:
                            <strong class="text-dark d-block"><?= esc($layanan['detail_layanan']) ?></strong>
                        </li>
                    </ul>
                </div>

                <!-- Tombol Aksi -->
                <div class="card-footer bg-light px-4 py-3">
                    <div class="flex flex-wrap items-center justify-between w-full">
                        <!-- Kiri: Tombol Kembali -->
                        <a href="<?= base_url('admin/layanan') ?>"
                            class="text-md px-3 py-1.5 rounded text-gray-700 hover:bg-gray-100">
                            ⬅ Kembali
                        </a>

                        <!-- Kanan: Edit & Hapus -->
                        <div class="flex gap-2 mt-2 sm:mt-0">
                            <a href="<?= base_url('admin/layanan/edit/' . $layanan['id']) ?>"
                                class="text-md px-3 py-1.5 rounded bg-blue-600 text-warning hover:bg-blue-700">
                                Edit
                            </a>
                            <a href="<?= base_url('admin/layanan/delete/' . $layanan['id']) ?>"
                                onclick="return confirm('Yakin ingin menghapus layanan ini?')"
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