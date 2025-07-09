<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header px-4">
            <a href="<?= base_url('admin/home') ?>" class="d-flex align-items-center">
                <img src="<?= base_url('admin/assets/images/logo.jpg') ?>" alt="logo" style="height: 200px;" />
            </a>
        </div>

        <div class="navbar-content h-[calc(100vh_-_74px)] py-2.5">
            <ul class="pc-navbar">
                <!-- Navigasi Utama -->
                <li class="pc-item pc-caption">
                    <label>Menu Utama</label>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('admin/home') ?>" class="pc-link">
                        <span class="pc-micon">
                            <i data-feather="home"></i>
                        </span>
                        <span class="pc-mtext">Home</span>
                    </a>
                </li>

                <!-- Menu Data -->
                <li class="pc-item pc-caption">
                    <label>Data Master</label>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('admin/layanan') ?>" class="pc-link">
                        <span class="pc-micon"><i data-feather="scissors"></i></span>
                        <span class="pc-mtext">Layanan</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('admin/capster') ?>" class="pc-link">
                        <span class="pc-micon"><i data-feather="users"></i></span>
                        <span class="pc-mtext">Capster</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('admin/jadwal') ?>" class="pc-link">
                        <span class="pc-micon"><i data-feather="calendar"></i></span>
                        <span class="pc-mtext">Jadwal</span>
                    </a>
                </li>

                <!-- Menu Laporan -->
                <li class="pc-item pc-caption">
                    <label>Laporan</label>
                </li>
                <li class="pc-item">
                    <a href="<?= base_url('admin/booking') ?>" class="pc-link">
                        <span class="pc-micon"><i data-feather="file-text"></i></span>
                        <span class="pc-mtext">Laporan Booking</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>