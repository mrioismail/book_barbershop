<?= $this->extend('admin/layout/template') ?>

<?= $this->section('content') ?>

<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="page-header-title">
                    <h5 class="mb-0 font-medium"><?= $title; ?></h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/home') ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                </ul>
            </div>
        </div>

        <!-- Pesan eror atau gagal -->
        <?php if (session()->getFlashdata('pesan')): ?>
            <ul class="text-danger mb-3 ps-3">
                <li><b><?= esc(session()->getFlashdata('pesan')) ?></b></li>
            </ul>
        <?php endif; ?>

        <div class="table-responsive">
            <div class="mb-2" id="tombol-export"></div>
            <h6 class="text-muted mb-3">
                <a href="<?= base_url('admin/booking/laporan') ?>" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-chart-bar me-1"></i> Lihat Laporan
                </a>
            </h6>

            <table id="example" class="table table-sm table-bordered text-sm align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Layanan</th>
                        <th>Jadwal</th>
                        <th>Capster</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($booking as $book): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= esc($book['nama_customer']) ?></td>
                            <td><?= esc($book['nama_layanan']) ?></td>
                            <td><?= date('d F Y', strtotime($book['tanggal'])) . ' - ' . date('H:i', strtotime($book['jam'])) ?></td>
                            <td><?= esc($book['nama']) ?></td>
                            <td>
                                <?php if ($book['status'] === 'booked'): ?>
                                    <span class="badge bg-warning-600 text-white text-[12px] mx-2">Booked</span>
                                <?php elseif ($book['status'] === 'batal'): ?>
                                    <span class="badge bg-danger-600 text-white text-[12px] mx-2">Batal</span>
                                <?php elseif ($book['status'] === 'selesai'): ?>
                                    <span class="badge bg-success-600 text-white text-[12px] mx-2">Selesai</span>
                                <?php else: ?>
                                    <span class="btn badge bg-secondary">Status tidak diketahui</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <!-- Tombol Detail -->
                                <a href="<?= base_url('admin/booking/detail/' . $book['id']) ?>" class="badge bg-info-800 text-white text-[12px] mb-1 d-block">Detail</a>

                                <!-- Hilangkan tombol selesai jika status sudah selesai -->
                                <?php if ($book['status'] !== 'selesai'): ?>
                                    <form action="<?= base_url('admin/booking/update/' . $book['id']) ?>" method="post" class="d-inline"
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="status" value="selesai">
                                        <button type="submit" class="btn-selesai badge bg-success-600 text-white border-0 text-[11px] mb-1">Selesai</button>
                                    </form>
                                <?php endif; ?>

                                <!-- Hilangkan tombol batal jika status sudah batal -->
                                <?php if ($book['status'] !== 'batal'): ?>
                                    <form action="<?= base_url('admin/booking/update/' . $book['id']) ?>" method="post" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin membatalkan booking ini?');">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="status" value="batal">
                                        <button type="submit" class="btn-batal badge bg-danger-600 text-white border-0 text-[11px]">Batal</button>
                                    </form>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>