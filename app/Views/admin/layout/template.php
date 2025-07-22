<!doctype html>
<html lang="en" data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" dir="ltr" data-pc-theme="light">
<!-- [Head] start -->

<head>
    <title>Bills Barbershop</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="description"
        content="Datta Able is trending dashboard template made using Bootstrap 5 design framework. Datta Able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies." />
    <meta
        name="keywords"
        content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard" />
    <meta name="author" content="CodedThemes" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?= base_url('admin/assets/images/logo.jpg') ?>" type="image/x-icon" />

    <!-- [Font] Family -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/fonts/fontawesome.css') ?>" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/fonts/material.css') ?>" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/style.css') ?>" id="main-style-link" />
    <!-- css ku -->
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/custome.css') ?>" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg fixed inset-0 bg-white dark:bg-themedark-cardbg z-[1034]">
        <div class="loader-track h-[5px] w-full inline-block absolute overflow-hidden top-0">
            <div class="loader-fill w-[300px] h-[5px] bg-primary-500 absolute top-0 left-0 animate-[hitZak_0.6s_ease-in-out_infinite_alternate]"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Sidebar Menu ] start -->
    <?= $this->include('admin/layout/sidebar'); ?>
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Navbar ] start -->
    <?= $this->include('admin/layout/navbar'); ?>
    <!-- [ Navbar ] end -->

    <!-- [ Main Content ] start -->
    <?= $this->renderSection('content'); ?>
    <!-- [ Main Content ] end -->

    <!-- Footer -->
    <?= $this->include('admin/layout/footer'); ?>
    <!-- Akhir Footer -->

    <!-- Required Js -->
    <script src="<?php echo base_url('admin/assets/js/plugins/simplebar.min.js') ?>"></script>
    <script src="<?php echo base_url('admin/assets/js/plugins/popper.min.js') ?>"></script>
    <script src="<?php echo base_url('admin/assets/js/icon/custom-icon.js') ?>"></script>
    <script src="<?php echo base_url('admin/assets/js/plugins/feather.min.js') ?>"></script>
    <script src="<?php echo base_url('admin/assets/js/component.js') ?>"></script>
    <script src="<?php echo base_url('admin/assets/js/theme.js') ?>"></script>
    <script src="<?php echo base_url('admin/assets/js/script.js') ?>"></script>

    <div class="floting-button fixed bottom-[50px] right-[30px] z-[1030]">
    </div>

    <script>
        layout_change('false');
    </script>

    <script>
        layout_theme_sidebar_change('dark');
    </script>

    <script>
        change_box_container('false');
    </script>

    <script>
        layout_caption_change('true');
    </script>

    <script>
        layout_rtl_change('false');
    </script>

    <script>
        preset_change('preset-1');
    </script>

    <script>
        main_layout_change('vertical');
    </script>

    <!-- jQuery buat datatables -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    <!-- Export dependencies buat datatables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Data Tables -->
    <script>
        $(document).ready(function() {
            var table = $("#example").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                dom: 'Bfrtip', // <-- penting: tampilkan tombol di atas
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Laporan Booking',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Laporan Booking',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Laporan Booking',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    zeroRecords: "Data tidak ditemukan",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ entri",
                    infoEmpty: "Tidak ada data",
                    infoFiltered: "(disaring dari _MAX_ total entri)"
                }
            });

            // Pindahkan tombol ke div custom
            table.buttons().container().appendTo('#tombol-export');
        });
    </script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // notifikasi berhasil dan gagal
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        <?php if (session()->getFlashdata('pesan')) : ?>
            Toast.fire({
                icon: "success",
                title: "<?= session()->getFlashdata('pesan') ?>"
            });
        <?php elseif (session()->getFlashdata('errors')) : ?>
            Toast.fire({
                icon: "error",
                title: "<?= session()->getFlashdata('errors') ?>"
            });
        <?php endif; ?>

        // Event listener umum untuk .btn-logout dan .btn-hapus
        document.querySelectorAll('.btn-logout, .btn-hapus').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const href = this.getAttribute('href');
                const isLogout = this.classList.contains('btn-logout');

                Swal.fire({
                    title: isLogout ? 'Keluar dari aplikasi?' : 'Yakin ingin menghapus data ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success me-2',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        });

        // Fungsi umum untuk konfirmasi SweetAlert
        function handleSweetConfirm(selector, title, text, icon, confirmText) {
            document.querySelectorAll(selector).forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');

                    swalWithBootstrapButtons.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonText: confirmText,
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        }

        // Terapkan ke tombol
        handleSweetConfirm(
            '.btn-selesai',
            'Yakin bookingannya sudah selesai?',
            'Booking ini akan ditandai sudah selesai.',
            'question',
            'Ya, selesai'
        );

        handleSweetConfirm(
            '.btn-batal',
            'Batalkan booking?',
            'Booking ini akan dibatalkan dan tidak bisa dikembalikan.',
            'warning',
            'Ya, batalkan'
        );
    </script>

</body>
<!-- [Body] end -->

</html>