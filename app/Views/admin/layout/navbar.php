<header class="pc-header">
    <div class="header-wrapper flex max-sm:px-[15px] px-[25px] grow"><!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse max-lg:hidden lg:inline-flex">
                    <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="sidebar-hide">
                        <i data-feather="menu"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup lg:hidden">
                    <a href="#" class="pc-head-link ltr:!ml-0 rtl:!mr-0" id="mobile-collapse">
                        <i data-feather="menu"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="inline-flex *:min-h-header-height *:inline-flex *:items-center">
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <i data-feather="sun"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                        <a href="#!" class="dropdown-item" onclick="layout_change('dark')">
                            <i data-feather="moon"></i>
                            <span>Dark</span>
                        </a>
                        <a href="#!" class="dropdown-item" onclick="layout_change('light')">
                            <i data-feather="sun"></i>
                            <span>Light</span>
                        </a>
                    </div>
                </li>
                <!-- NOTIFIKASI -->
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle me-0" data-pc-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <i data-feather="bell"></i>
                        <span class="badge bg-danger-500 text-white rounded-full z-10 absolute right-0 top-0" id="jumlah-notif">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown p-2">
                        <div class="dropdown-header flex items-center justify-between py-4 px-5">
                            <h5 class="m-0">Notifications</h5>
                        </div>

                        <!-- ✅ TEMPAT DIMUATNYA NOTIFIKASI VIA AJAX -->
                        <div class="dropdown-body header-notification-scroll relative py-4 px-5"
                            style="max-height: calc(100vh - 215px)">
                            <div id="isi-notifikasi">
                                <p class="text-md text-center text-red-500">Loading notifikasi...</p>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0" data-pc-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" data-pc-auto-close="outside" aria-expanded="false">
                        <i data-feather="user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown p-2 overflow-hidden">
                        <div class="dropdown-header flex items-center justify-between py-4 px-5 bg-info-800">
                            <div class="flex mb-1 items-center">
                                <div class="grow ms-3">
                                    <h6 class="mb-1 text-white"><?= session()->get('nama'); ?> 🖖</h6>
                                    <span class="text-white">bills_barbershop@gmail.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-body py-4 px-5">
                            <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                                <a href="<?= base_url('admin/pengguna') ?>" class="dropdown-item">
                                    <span>
                                        <i class="ti ti-user me-2"></i>
                                        <span>Pengguna</span>
                                    </span>
                                </a>


                                <a href="<?= base_url('admin/ganti_password/' . session('id')) ?>" class="dropdown-item">
                                    <span>
                                        <svg class="pc-icon text-muted me-2 inline-block">
                                            <use xlink:href="#custom-lock-outline"></use>
                                        </svg>
                                        <span>Ganti Password</span>
                                    </span>
                                </a>
                                <div class="grid my-3">
                                    <a href="<?= base_url('logout') ?>"
                                        class="btn btn-outline-danger flex items-center justify-center"
                                        onclick="return confirm('Apakah Anda yakin ingin logout?');">
                                        <svg class="pc-icon me-2 w-[22px] h-[22px]">
                                            <use xlink:href="#custom-logout-1-outline"></use>
                                        </svg>
                                        Logout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>

<script>
    function loadNotifikasi() {
        // Tampilkan loading sebelum fetch dimulai
        const isiNotifikasi = document.getElementById('isi-notifikasi');
        isiNotifikasi.innerHTML = '<p class="text-md text-center text-red-500">Loading notifikasi...</p>';

        fetch("<?= base_url('admin/notifikasi') ?>")
            .then(response => {
                if (!response.ok) {
                    throw new Error("HTTP Error " + response.status);
                }
                return response.text();
            })
            .then(html => {
                isiNotifikasi.innerHTML = html;

                const jumlah = document.querySelectorAll('#isi-notifikasi .card').length;
                document.getElementById('jumlah-notif').innerText = jumlah;

                // Jika kosong, tampilkan pesan default
                if (jumlah === 0) {
                    isiNotifikasi.innerHTML = '<p class="text-md text-center text-red-500">Tidak ada notifikasi.</p>';
                }
            })
            .catch(err => {
                isiNotifikasi.innerHTML =
                    '<p class="text-md text-center text-red-500">Gagal memuat notifikasi.</p>';
                console.error(err);
            });
    }

    // Muat pertama kali saat halaman dibuka
    loadNotifikasi();

    // Refresh setiap 30 detik
    setInterval(loadNotifikasi, 30000);
</script>