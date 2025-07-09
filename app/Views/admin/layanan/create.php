<?php echo $this->extend('admin/layout/template') ?>
<?php echo $this->section('content') ?>

<div class="pc-container">
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header mb-4">
            <div class="page-block">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/home') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/layanan') ?>">Layanan</a></li>
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

                <form action="<?= base_url('admin/layanan/store') ?>" method="post" enctype="multipart/form-data">
                    <!-- Foto Layanan -->
                    <div class="mb-4">
                        <label class="block mb-1 text-gray-700 text-md font-medium">Foto Layanan</label>
                        <input type="file" name="foto_layanan"
                            class="block w-full text-md text-gray-700 file:border file:rounded file:p-1 file:bg-gray-100">

                        <?php if (isset($pesan) && $pesan->hasError('foto_layanan')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('foto_layanan') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Nama Layanan -->
                    <div class="mb-4">
                        <label class="block mb-1 text-gray-700 text-md font-medium">Nama Layanan</label>
                        <input type="text" name="nama_layanan" value="<?= old('nama_layanan') ?>"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">

                        <?php if (isset($pesan) && $pesan->hasError('nama_layanan')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('nama_layanan') ?></p>
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

                    <!-- Detail Layanan -->
                    <div class="mb-4">
                        <label class="block mb-1 text-gray-700 text-md font-medium">Detail Layanan</label>
                        <textarea name="detail_layanan" rows="3"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500"><?= old('detail_layanan') ?></textarea>

                        <?php if (isset($pesan) && $pesan->hasError('detail_layanan')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('detail_layanan') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between items-center mt-6">
                        <a href="<?= base_url('admin/layanan') ?>" class="text-gray-600 hover:text-blue-600 text-md">
                            ⬅ Kembali
                        </a>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 bg-success-600 text-white text-md font-medium px-4 py-2 rounded transition">
                            Simpan Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>