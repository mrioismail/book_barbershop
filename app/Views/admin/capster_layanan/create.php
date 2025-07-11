<?php echo $this->extend('admin/layout/template') ?>
<?php echo $this->section('content') ?>

<div class="pc-container">
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header mb-4">
            <div class="page-block">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/home') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/capster_layanan') ?>">Capster Layanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                </ul>
            </div>
        </div>
        <!-- Form Wrapper -->
        <div class="flex justify-center items-center">
            <div class="w-full max-w-md bg-white shadow-md rounded-xl p-6 border border-gray-200">
                <h5 class="text-lg font-semibold text-gray-800 mb-4"><?= $title; ?></h5>

                <!-- Pesan eror atau gagal -->
                <?php if (session()->getFlashdata('pesan')): ?>
                    <ul class="text-danger mb-3 ps-3">
                        <li><b><?= esc(session()->getFlashdata('pesan')) ?></b></li>
                    </ul>
                <?php endif; ?>

                <form action="<?= base_url('admin/capster_layanan/store') ?>" method="post">
                    <!-- Nama Layanan -->
                    <div class="mb-4">
                        <label class="block mb-1 text-gray-700 text-md font-medium">Nama Capster</label>
                        <select name="capster_id" id="capster_id" class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">Pilih Capster</option>
                            <?php foreach ($capster as $cap): ?>
                                <option value="<?= $cap['id'] ?>" <?= old('capster_id') == $cap['id'] ? 'selected' : '' ?>><?= esc($cap['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($pesan) && $pesan->hasError('capster_id')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('capster_id') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Nama Layanan -->
                    <div class="mb-4">
                        <label class="block mb-1 text-gray-700 text-md font-medium">Nama Layanan</label>
                        <select name="layanan_id" id="layanan_id" class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <option value="">Pilih Layanan</option>
                            <?php foreach ($layanan as $lay): ?>
                                <option value="<?= $lay['id'] ?>" <?= old('layanan_id') == $lay['id'] ? 'selected' : '' ?>><?= esc($lay['nama_layanan']) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if (isset($pesan) && $pesan->hasError('layanan_id')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('layanan_id') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Harga -->
                    <div class="mb-4">
                        <label class="block mb-1 text-gray-700 text-md font-medium">Harga</label>
                        <input type="number" name="harga" value="<?= old('harga') ?>"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">

                        <?php if (isset($pesan) && $pesan->hasError('harga')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('harga') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between items-center mt-6">
                        <a href="<?= base_url('admin/capster_layanan') ?>" class="text-gray-600 hover:text-blue-600 text-md">
                            ⬅ Kembali
                        </a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 bg-success-600 text-white text-md font-medium px-4 py-2 rounded transition">
                            Simpan Capster Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>