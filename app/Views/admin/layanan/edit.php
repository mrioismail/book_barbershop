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
        <div class="flex justify-center items-center min-h-screen">
            <div class="w-full max-w-md bg-white shadow-md rounded-xl p-6 border border-gray-200">
                <h5 class="text-lg font-semibold text-gray-800 mb-4"><?= $title; ?></h5>

                <!-- Pesan eror atau gagal -->
                <?php if (session()->getFlashdata('pesan')): ?>
                    <ul class="text-danger mb-3 ps-3">
                        <li><b><?= esc(session()->getFlashdata('pesan')) ?></b></li>
                    </ul>
                <?php endif; ?>

                <form action="<?= base_url('admin/layanan/update/' . $layanan['id']) ?>" method="post" enctype="multipart/form-data">
                    <!-- Foto -->
                    <div class="mb-4">
                        <label class="block text-md font-medium text-gray-700 mb-1">Foto Layanan</label>
                        <?php if ($layanan['foto_layanan']): ?>
                            <img src="<?= base_url('admin/assets/images/uploads/' . $layanan['foto_layanan']) ?>" alt="Foto Layanan" class="w-24 h-auto mb-2 rounded border">
                        <?php else: ?>
                            <p class="text-md text-gray-500 italic mb-2">Tidak ada foto layanan yang diunggah.</p>
                        <?php endif; ?>
                        <input type="file" name="foto_layanan" accept=".jpg,.jpeg,.png" class="text-md text-gray-600">
                        <input type="hidden" name="foto_layanan_lama" value="<?= esc($layanan['foto_layanan']) ?>">

                        <?php if (isset($pesan) && $pesan->hasError('foto_layanan')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('foto_layanan') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Nama Layanan -->
                    <div class="mb-4">
                        <label class="block text-md font-medium text-gray-700 mb-1">Nama Layanan</label>
                        <input type="text" name="nama_layanan" value="<?= esc($layanan['nama_layanan']) ?>" required
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">

                        <?php if (isset($pesan) && $pesan->hasError('nama_layanan')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('nama_layanan') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Harga Layanan -->
                    <div class="mb-4">
                        <label class="block text-md font-medium text-gray-700 mb-1">Harga Layanan</label>
                        <input type="text" name="harga_layanan" value="<?= esc($layanan['harga_layanan']) ?>" required
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">

                        <?php if (isset($pesan) && $pesan->hasError('harga_layanan')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('harga_layanan') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Detail Layanan -->
                    <div class="mb-4">
                        <label class="block text-md font-medium text-gray-700 mb-1">Detail Layanan</label>
                        <textarea name="detail_layanan" rows="4"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500"><?= esc($layanan['detail_layanan']) ?></textarea>

                        <?php if (isset($pesan) && $pesan->hasError('detail_layanan')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('detail_layanan') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between items-center mt-6">
                        <a href="<?= base_url('admin/layanan') ?>"
                            class="text-md text-gray-600 hover:text-blue-600 transition">
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

<?php echo $this->endSection() ?>