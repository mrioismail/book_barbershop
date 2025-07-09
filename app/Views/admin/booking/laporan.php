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
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/booking') ?>">Booking</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan Booking</li>
                </ul>
            </div>
        </div>

        <!-- Filter tanggal -->
        <form method="get" action="<?= base_url('admin/booking/laporan') ?>" class="mb-4 flex gap-3 flex-wrap">
            <div>
                <label class="block text-sm font-medium">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" class="form-control"
                    value="<?= esc($_GET['tanggal_awal'] ?? '') ?>">
            </div>
            <div>
                <label class="block text-sm font-medium">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="form-control"
                    value="<?= esc($_GET['tanggal_akhir'] ?? '') ?>">
            </div>
            <div class="pt-4">
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                <a href="<?= base_url('admin/booking/laporan') ?>" class="btn btn-sm btn-secondary">Reset</a>
            </div>
        </form>

        <?php if (!empty($_GET['tanggal_awal']) && !empty($_GET['tanggal_akhir'])): ?>
            <p class="mb-2 text-sm text-muted text-danger-500">Menampilkan data dari <strong><?= date('d M Y', strtotime($_GET['tanggal_awal'])) ?></strong> sampai <strong><?= date('d M Y', strtotime($_GET['tanggal_akhir'])) ?></strong></p>
        <?php endif; ?>

        <!-- Tabel laporan -->
        <div class="table-responsive">
            <table id="laporanTable" class="table table-sm table-bordered text-sm align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Layanan</th>
                        <th>Harga</th>
                        <th>Jadwal</th>
                        <th>Capster</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($booking as $book): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= esc($book['nama_customer']) ?></td>
                            <td><?= esc($book['nama_layanan']) ?></td>
                            <td>Rp <?= number_format($book['harga'], 0, ',', '.') ?></td>
                            <td><?= date('d F Y', strtotime($book['tanggal'])) . ' - ' . date('H:i', strtotime($book['jam'])) ?></td>
                            <td><?= esc($book['nama']) ?></td>
                            <td class="text-center">
                                <?php if ($book['status'] === 'booked'): ?>
                                    <span class="badge bg-warning-600 text-white text-[12px]">Booked</span>
                                <?php elseif ($book['status'] === 'batal'): ?>
                                    <span class="badge bg-danger-600 text-white text-[12px]">Batal</span>
                                <?php elseif ($book['status'] === 'selesai'): ?>
                                    <span class="badge bg-success-600 text-white text-[12px]">Selesai</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary text-white text-[12px]">Tidak Diketahui</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script DataTables -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#laporanTable').DataTable({
            dom: 'Bfrtip',
            buttons: ['copy', 'excel', 'pdf', 'print'],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                zeroRecords: "Data tidak ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                infoFiltered: "(difilter dari _MAX_ total data)"
            }
        });
    });
</script>

<!-- DataTables CDN & Buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<?= $this->endSection() ?>