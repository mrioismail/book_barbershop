<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bills Barbershop</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;500&display=swap" rel="stylesheet">
    <link href="<?php echo base_url('customer/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('customer/css/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('customer/css/templatemo-barber-shop.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('customer/css/custome.css') ?>" rel="stylesheet">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- start navbar -->
            <?= $this->include('customer/layout/navbar'); ?>
            <!-- end navbar -->

            <div class="col-md-8 ms-sm-auto col-lg-9 p-0">
                <!-- Content -->
                <?= $this->renderSection('content'); ?>
                <!-- Akhir Content -->

                <!-- Footer -->
                <?= $this->include('customer/layout/footer'); ?>
                <!-- Akhir Footer -->
            </div>
        </div>
    </div>
    <!-- JAVASCRIPT FILES -->
    <script src="<?php echo base_url('customer/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('customer/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('customer/js/click-scroll.js') ?>"></script>
    <script src="<?php echo base_url('customer/js/custom.js') ?>"></script>

</body>

</html>