<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="pc-container">
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header mb-4">
            <div class="page-block">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/home') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/jadwal') ?>">Jadwal</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                </ul>
            </div>
        </div>

        <!-- Form Edit Jadwal -->
        <div class="flex justify-center items-center">
            <div class="w-full max-w-md bg-white shadow-md rounded-xl p-6 border border-gray-200">
                <h5 class="text-lg font-semibold text-gray-800 mb-4"><?= $title; ?></h5>

                <?php if (session()->getFlashdata('pesan')): ?>
                    <ul class="text-danger mb-3 ps-3">
                        <li><b><?= esc(session()->getFlashdata('pesan')) ?></b></li>
                    </ul>
                <?php endif; ?>

                <form action="<?= base_url('/admin/jadwal/update/' . $jadwal['id']) ?>" method="post">

                    <!-- Capster -->
                    <div class="mb-4">
                        <label class="block mb-1 text-gray-700 text-md font-medium">Capster</label>
                        <select name="capster_id"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <?php foreach ($capster as $c): ?>
                                <option value="<?= $c['id'] ?>" <?= ($c['id'] == $jadwal['capster_id']) ? 'selected' : '' ?>><?= esc($c['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($pesan) && $pesan->hasError('capster_id')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('capster_id') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-4">
                        <label class="block mb-1 text-gray-700 text-md font-medium">Tanggal</label>
                        <input type="date" name="tanggal" min="<?php echo date('Y-m-d'); ?>" value="<?= esc($jadwal['tanggal']) ?>"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">

                        <?php if (isset($pesan) && $pesan->hasError('tanggal')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('tanggal') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Jam -->
                    <div class="mb-4 manual-input">
                        <label class="block mb-1 text-gray-700 text-md font-medium">Jam</label>
                        <input type="time" name="jam" value="<?= esc($jadwal['jam']) ?>"
                            class=" w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">

                        <?php if (isset($pesan) && $pesan->hasError('jam')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('jam') ?></p>
                        <?php endif; ?>
                        <p class="text-sm text-red-500 mt-1">Input jam wajib bulat, misal 08.00, 09.00, 10.00 dst.</p>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label class="block mb-1 text-gray-700 text-md font-medium">Status</label>
                        <select name="status"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="Tersedia" <?= ($jadwal['status'] == 'Tersedia') ? 'selected' : '' ?>>Tersedia</option>
                            <option value="Penuh" <?= ($jadwal['status'] == 'Penuh') ? 'selected' : '' ?>>Penuh</option>
                        </select>

                        <?php if (isset($pesan) && $pesan->hasError('status')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('status') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between items-center mt-6">
                        <a href="<?= base_url('admin/jadwal') ?>" class="text-gray-600 hover:text-blue-600 text-md">
                            ⬅ Kembali
                        </a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 bg-success-600 text-white text-md font-medium px-4 py-2 rounded transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>