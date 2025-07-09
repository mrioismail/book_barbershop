<?php echo $this->extend('admin/layout/template')  ?>

<?php echo $this->section('content')  ?>

<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="page-header-title">
                    <h5 class="mb-0 font-medium"><?= $title; ?></h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('admin/home') ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                </ul>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <a href="<?= base_url('admin/jadwal/create') ?>"
            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-md badge bg-theme-bg-1 hover:bg-blue-700 text-white text-md font-medium shadow transition text-center">
            <i data-feather="plus" class="w-4 h-4"></i>
            Tambah Jadwal
        </a>

        <br>

        <!-- Pesan eror atau gagal -->
        <?php if (session()->getFlashdata('pesan')): ?>
            <ul class="text-danger mb-3 ps-3">
                <li class="fw-bold"><?= esc(session()->getFlashdata('pesan')) ?></li>
            </ul>
        <?php endif; ?>

        <div class="table-responsive">
            <div class="my-3" id="tombol-export"></div>
            <table id="example" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Capster</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($jadwal as $jad):
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= esc($jad['nama']) ?></td>
                            <td><?= date('d F Y', strtotime($jad['tanggal'])) ?></td>
                            <td><?= date('H:i', strtotime($jad['jam'])) ?></td>
                            <!-- status -->
                            <?php if ($jad['status'] == 'Tersedia'): ?>
                                <td class="text-success"><?= esc($jad['status']) ?></td>
                            <?php elseif ($jad['status'] == 'Penuh'): ?>
                                <td class="text-danger"><?= esc($jad['status']) ?></td>
                            <?php else: ?>
                                <td><?= esc($jad['status']) ?></td>
                            <?php endif; ?>
                            <td>
                                <!-- jika tanggal lewat per hari ini maka tombol edit dan hapus tidak tampil -->
                                <?php if (strtotime($jad['tanggal']) < strtotime(date('Y-m-d'))): ?>
                                    <span class="badge bg-secondary text-black text-[12px]">Tidak dapat diedit</span>
                                <?php else: ?>
                                    <a href="<?= base_url('admin/jadwal/edit/' . $jad['id']) ?>" class="badge bg-warning-600 text-white text-[12px]"><button type="submit">Edit</button></a>
                                    <a href="<?= base_url('admin/jadwal/delete/' . $jad['id']) ?>"
                                        onclick="return confirm('Yakin ingin menghapus jadwal ini?')"
                                        class="badge bg-danger-600 text-white text-[12px]">
                                        <button type="submit">Hapus</button>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

<?php echo $this->endSection()  ?>