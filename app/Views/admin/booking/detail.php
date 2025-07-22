<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="pc-container">
    <div class="pc-content">

        <!-- Breadcrumb -->
        <div class="page-header mb-4">
            <div class="page-block">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/home') ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/booking') ?>">Booking</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ul>
            </div>
        </div>

        <!-- Card -->
        <div class="d-flex justify-content-center">
            <div class="card shadow-sm border rounded w-100" style="max-width: 700px;">
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

                    <!-- === DATA DIRI === -->
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted border-bottom pb-1 mb-3">Data Diri</h6>
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <th>Nama Customer</th>
                                <td>: <?= esc($booking['nama_customer']) ?></td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td>: <?= esc($booking['no_hp']) ?></td>
                            </tr>
                        </table>
                    </div>

                    <!-- === LAYANAN === -->
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted border-bottom pb-1 mb-3">Layanan</h6>
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <th>Nama Layanan</th>
                                <td>: <?= esc($booking['nama_layanan']) ?></td>
                            </tr>
                            <tr>
                                <th>Detail Layanan</th>
                                <td>: <?= esc($booking['detail_layanan']) ?></td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>: Rp <?= number_format($booking['harga'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <th>Foto Layanan</th>
                                <td>
                                    <img src="<?= base_url('admin/assets/images/uploads/' . $booking['foto_layanan']) ?>" alt="Foto Layanan" class="img-thumbnail" style="max-height: 150px;">
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- === JADWAL & CAPSTER === -->
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted border-bottom pb-1 mb-3">Jadwal & Capster</h6>
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <th>Capster</th>
                                <td>: <?= esc($booking['nama']) ?></td>
                            </tr>
                            <tr>
                                <th>Foto Capster</th>
                                <td>
                                    <img src="<?= base_url('admin/assets/images/uploads/' . $booking['foto_capster']) ?>" alt="Foto Capster" class="img-thumbnail" style="max-height: 150px;">
                                </td>
                            </tr>
                            <tr>
                                <th>Jadwal Booking</th>
                                <td>: <?= date('d M Y', strtotime($booking['tanggal'])) ?> - <?= date('H:i', strtotime($booking['jam'])) ?></td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td>: <?= esc($booking['catatan']) ?: '-' ?></td>
                            </tr>
                        </table>
                    </div>

                    <!-- === CATATAN === -->
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted border-bottom pb-1 mb-3">Catatan</h6>
                        <p class="text-muted">
                            <?= esc($booking['catatan']) ?: 'Tidak ada catatan.' ?>
                        </p>
                    </div>

                    <!-- === DI BUAT CUSTOMER === -->
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted border-bottom pb-1 mb-3">Di Buat Customer</h6>
                        <p class="text-muted">
                            <?= esc($booking['dibuat_pada']) ?: 'Tidak ada informasi.' ?>
                        </p>
                    </div>

                    <!-- === STATUS === -->
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted border-bottom pb-1 mb-3">Status Booking</h6>
                        <?php if ($booking['status'] === 'booked'): ?>
                            <span class="badge bg-warning-700 text-white text-[12px] mx-2">Booked</span>
                        <?php elseif ($booking['status'] === 'batal'): ?>
                            <span class="badge bg-danger-700 text-white text-[12px] mx-2">Batal</span>
                        <?php elseif ($booking['status'] === 'selesai'): ?>
                            <span class="badge bg-success-700 text-white text-[12px] mx-2">Selesai</span>
                        <?php else: ?>
                            <span class="btn badge bg-secondary">Status tidak diketahui</span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Footer (seperti versi kamu) -->
                <div class="card-footer bg-light px-4 py-3">
                    <div class="flex flex-wrap items-center justify-between w-full">
                        <!-- Kiri: Tombol Kembali -->
                        <a href="<?= base_url('admin/booking') ?>"
                            class="text-md px-3 py-1.5 rounded text-gray-700 hover:bg-gray-100">
                            ⬅ Kembali
                        </a>

                        <div class="flex gap-2 mt-2 sm:mt-0">
                            <a href="<?= base_url('admin/booking/delete/' . $booking['id']) ?>"
                                class="btn-hapus text-md px-3 py-1.5 rounded bg-red-600 text-danger hover:bg-red-700">
                                Hapus
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>