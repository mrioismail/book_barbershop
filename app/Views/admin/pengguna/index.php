<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="pc-container">
    <div class="pc-content">

        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">

            <?php foreach ($pengguna as $p): ?>
                <div class="card shadow-sm border rounded w-100 mb-4" style="max-width: 500px;">
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

                        <!-- Tampil Data Pengguna -->
                        <ul class="list-unstyled text-secondary">
                            <li class="mb-3">
                                Username :
                                <strong class="text-dark d-block"><?= esc($p['username']) ?></strong>
                            </li>
                            <li class="mb-3">
                                Password :
                                <strong class="text-dark d-block">
                                    <?= str_repeat('*', 5) ?>
                                </strong>
                            </li>
                            <li>
                                Nama :
                                <strong class="text-dark d-block"><?= esc($p['nama']) ?></strong>
                            </li>
                            <li>
                                Akun :
                                <strong class="text-dark d-block"><?= esc($p['role']) ?></strong>
                            </li>
                        </ul>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="card-footer bg-light px-4 py-3">
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/home') ?>" class="btn btn-outline-secondary">
                                ⬅ Kembali
                            </a>

                            <a href="<?= base_url('admin/pengguna/edit/' . $p['id']) ?>"
                                class="btn btn-warning text-white">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<?= $this->endSection() ?>