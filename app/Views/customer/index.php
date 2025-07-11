<!-- panggil file template di dalam folder layout -->
<?php echo $this->extend('customer/layout/template')  ?>

<?php echo $this->section('content')  ?>
<!-- home -->
<section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <h1 class="text-white mb-lg-3 mb-4"><strong>Bills <em>Babershop</em></strong></h1>
                <p class="text-black">
                <p class="text-white">Siap jadi versi terganteng dari dirimu? Booking sekarang!</p>
                </p>
                <br>
                <a class="btn custom-btn custom-border-btn custom-btn-bg-white smoothscroll me-2 mb-2" href="#section_4">Harga</a>
                <a class="btn custom-btn smoothscroll mb-2 " href="<?php echo base_url('customer/booking/form_booking') ?>">Booking</a>
            </div>
        </div>
    </div>
    <div class="custom-block d-lg-flex flex-column justify-content-center align-items-center">
        <img src="<?php echo base_url('customer/images/vintage-chair-barbershop.jpg') ?>" class="custom-block-image img-fluid" alt="">
        <h4><strong class="text-white">Segera ambil tempatmu.</strong></h4>
    </div>
</section>

<!-- Story dan Capster-->
<section class="about-section section-padding" id="section_2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12 mx-auto">
                <h2 class="mb-4">Penata Rambut Terbaik</h2>
                <div class="border-bottom pb-3 mb-5">
                    <p>Di Bills Barbershop, kami percaya bahwa potongan rambut bukan cuma soal gaya—tapi tentang rasa percaya diri. Berawal dari semangat untuk menghadirkan pelayanan barbershop yang nyaman, rapi, dan profesional, kami hadir untuk bantu kamu tampil maksimal setiap hari. Dikerjakan oleh barber berpengalaman, dengan suasana yang santai dan bersih, kamu tinggal duduk, santai, dan siap jadi ganteng!</p>
                </div>
            </div>
            <h6 class="text-center mb-4">Tim Bills Barbershop</h6>
            <div class="row g-4">
                <?php foreach ($capster as $c) : ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0 rounded-4 bg-dark text-white">
                            <img src="<?php echo base_url('customer/images/barber/portrait-male-hairdresser-with-scissors.jpg') ?>" alt="Capster" class="w-full h-40 md:h-48 lg:h-56 object-cover">
                            <div class="card-body">
                                <p class="card-text fw-semibold"><?= $c['nama']; ?></p>
                            </div>

                            <div class="card-footer bg-transparent border-0 d-flex justify-content-end gap-2 pb-3 px-3">
                                <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="text-white"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Layanan  -->
<section class="services-section section-padding" id="section_3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h2 class="mb-5">Layanan</h2>
            </div>
            <?php foreach ($layanan as $l) : ?>
                <div class="col-lg-6 col-12 mb-4">
                    <div class="services-thumb">
                        <img src="<?php echo base_url('customer/images/services/woman-cutting-hair-man-salon.jpg') ?>" class="services-image img-fluid" alt="">
                        <div class="services-info d-flex align-items-end">
                            <h4 class="mb-0"><?= $l['nama_layanan']; ?></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Price List -->
<section class="price-list-section section-padding" id="section_4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="price-list-thumb-wrap">
                    <div class="mb-4">
                        <h2 class="mb-2">Daftar Harga</h2>
                        <strong class="text-muted">Harga sesuai dari pilihan Capster</strong><br><br>

                        <!-- catatan : $index ini menentukan key dari nama layanan yg di mulai key nya dari 0 -->
                        <?php foreach ($layanan as $index => $lay): ?>
                            <div class="price-list-thumb border-bottom pb-3 mb-3">
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
                                    <span class="fw-semibold"><?= esc($lay['nama_layanan']) ?></span>
                                    <div class="mt-2 mt-sm-0 d-flex align-items-center gap-2">
                                        <span
                                            class="toggle-detail-btn text-decoration-underline text-muted small"
                                            role="button"
                                            style="cursor: pointer;"
                                            data-index="<?= $index ?>">
                                            Detail
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-layanan mt-2 text-muted small" id="detail-<?= $index ?>" style="display: none;">
                                    <?= nl2br(esc($lay['detail_layanan'])) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- Kontak -->
<section class="contact-section" id="section_5">
    <div class="section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12 mx-auto">
                    <h2 class="text-center">Say hello</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <h5 class="mb-3"><strong>Kontak</strong> Informasi</h5>
                    <p class="text-white d-flex mb-1">
                        <a href="tel: 120-240-3600" class="site-footer-link">
                            0812-3456-7890
                        </a>
                    </p>
                    <p class="text-white d-flex">
                        <a href="bills_barbershop@gmail.com" class="site-footer-link">
                            bills_barbershop@gmail.com
                        </a>
                    </p>
                    <ul class="social-icon">
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-facebook">
                            </a>
                        </li>
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-twitter">
                            </a>
                        </li>
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-instagram">
                            </a>
                        </li>
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-youtube">
                            </a>
                        </li>
                        <li class="social-icon-item">
                            <a href="#" class="social-icon-link bi-whatsapp">
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-5 col-12 contact-block-wrap mt-5 mt-lg-0 pt-4 pt-lg-0 mx-auto">
                    <div class="contact-block">
                        <h6 class="mb-0">
                            <i class="custom-icon bi-shop me-3"></i>
                            <strong>Buka Setiap Hari</strong>
                            <span class="ms-auto">10:00 WIB - 21.00 WIB</span>
                        </h6>
                    </div>
                </div>
                <div class="col-lg-12 col-12 mx-auto mt-5 pt-5 d-flex justify-content-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.974970398919!2d113.84662077383126!3d-2.163226637210989!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfcb7004c2b69e7%3A0xd230cd459986829!2sbill%E2%80%99s%20Barbershop!5e0!3m2!1sid!2sid!4v1750324270691!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Script: Toggle Detail Harga -->
<script>
    document.querySelectorAll('.toggle-detail-btn').forEach(button => {
        button.addEventListener('click', () => {
            const index = button.getAttribute('data-index');
            const detailEl = document.getElementById(`detail-${index}`);
            if (detailEl.style.display === 'none') {
                detailEl.style.display = 'block';
                button.textContent = 'Tutup';
            } else {
                detailEl.style.display = 'none';
                button.textContent = 'Detail';
            }
        });
    });
</script>

<!-- Tombol Book Fixed -->
<a href="<?= base_url('customer/booking/form_booking') ?>" class="btn-book-fixed">
    Book
</a>

<?php echo $this->endSection()  ?>