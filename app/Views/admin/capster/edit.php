<?php echo $this->extend('admin/layout/template') ?>
<?php echo $this->section('content') ?>

<div class="pc-container">
    <div class="pc-content">
        <!-- Breadcrumb -->
        <div class="page-header mb-4">
            <div class="page-block">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/home') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/capster') ?>">Capster</a></li>
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

                <form action="<?= base_url('admin/capster/update/' . $capster['id']) ?>" method="post" enctype="multipart/form-data">
                    <!-- Foto -->
                    <div class="mb-4">
                        <label class="block text-md font-medium text-gray-700 mb-1">Foto capster</label>
                        <?php if ($capster['foto_capster']): ?>
                            <img src="<?= base_url('admin/assets/images/uploads/' . $capster['foto_capster']) ?>" alt="Foto capster" class="w-24 h-auto mb-2 rounded border">
                        <?php else: ?>
                            <p class="text-md text-gray-500 italic mb-2">Tidak ada foto capster yang diunggah.</p>
                        <?php endif; ?>
                        <input type="file" name="foto_capster" accept=".jpg,.jpeg,.png" class="text-md text-gray-600">
                        <input type="hidden" name="foto_capster_lama" value="<?= esc($capster['foto_capster']) ?>">

                        <?php if (isset($pesan) && $pesan->hasError('foto_capster')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('foto_capster') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Nama capster -->
                    <div class="mb-4">
                        <label class="block text-md font-medium text-gray-700 mb-1">Nama capster</label>
                        <input type="text" name="nama" value="<?= esc($capster['nama']) ?>" required
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500">

                        <?php if (isset($pesan) && $pesan->hasError('nama')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('nama') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Pengalaman -->
                    <div class="mb-4">
                        <label class="block text-md font-medium text-gray-700 mb-1">Pengalaman</label>
                        <textarea name="pengalaman" rows="4"
                            class="w-full border border-gray-300 rounded px-3 py-2 text-md focus:outline-none focus:ring-1 focus:ring-blue-500"><?= esc($capster['pengalaman']) ?></textarea>

                        <?php if (isset($pesan) && $pesan->hasError('pengalaman')): ?>
                            <p class="text-md text-red-500 mt-1"><?= $pesan->getError('pengalaman') ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between items-center mt-6">
                        <a href="<?= base_url('admin/capster') ?>"
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