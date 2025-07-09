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

                    <form action="<?= base_url('admin/update_password/' . $pengguna['id']) ?>" method="post">
                        <?= csrf_field(); ?>

                        <div class="mb-3">
                            <label>Password Lama</label>
                            <input type="password" name="password_lama" class="form-control">

                            <?php if (isset($pesan) && $pesan->hasError('password_lama')): ?>
                                <p class="text-md text-red-500 mt-1"><?= $pesan->getError('password_lama') ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label>Password Baru</label>
                            <input type="password" name="password_baru" class="form-control">

                            <?php if (isset($pesan) && $pesan->hasError('password_baru')): ?>
                                <p class="text-md text-red-500 mt-1"><?= $pesan->getError('password_baru') ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="konfirmasi_password" class="form-control">

                            <?php if (isset($pesan) && $pesan->hasError('konfirmasi_password')): ?>
                                <p class="text-md text-red-500 mt-1"><?= $pesan->getError('konfirmasi_password') ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- tombol button -->
                        <div class="d-flex justify-content-between align-items-center mt-4 w-100">
                            <div class="text-right flex-grow-1">
                                <button type="submit" class="border border-success text-success fw-semibold rounded px-3 py-1 bg-white mx-2">
                                    Ganti Password
                                </button>
                                <a href="<?= base_url('admin/reset_password/' . $pengguna['id']) ?>"
                                    class="text-danger fw-semibold border border-danger rounded px-3 py-1 text-decoration-none mx-2"
                                    onclick="return confirm('Yakin ingin reset password?')">
                                    Reset Password
                                </a>
                            </div>
                            <a href="<?= base_url('admin/home') ?>" class="text-decoration-none text-secondary fw-semibold">
                                ⬅ Kembali ke Home
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>