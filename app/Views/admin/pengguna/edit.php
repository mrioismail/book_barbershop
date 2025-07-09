<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="pc-container">
    <div class="pc-content">
        <div class="d-flex justify-content-center">
            <div class="card shadow-sm border rounded w-100" style="max-width: 500px;">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><?= $title; ?></h5>
                </div>
                <div class="card-body">
                    <!-- Pesan eror atau gagal -->
                    <?php if (session()->getFlashdata('pesan')): ?>
                        <ul class="text-danger mb-3 ps-3">
                            <li class="fw-bold"><?= esc(session()->getFlashdata('pesan')) ?></li>
                        </ul>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/pengguna/update/' . $pengguna['id']) ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= esc($pengguna['username']) ?>">

                            <?php if (isset($pesan) && $pesan->hasError('username')): ?>
                                <p class="text-md text-red-500 mt-1"><?= $pesan->getError('username') ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="<?= esc($pengguna['nama']) ?>">

                            <?php if (isset($pesan) && $pesan->hasError('nama')): ?>
                                <p class="text-md text-red-500 mt-1"><?= $pesan->getError('nama') ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Role hidden -->
                        <input type="hidden" name="role" value="admin">

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/pengguna') ?>" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 bg-success-600 text-white text-md font-medium px-4 py-2 rounded transition">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>