<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<div class="pc-container">
  <div class="pc-content">

    <!-- Header -->
    <div class="mb-6">
      <h1 class="text-3xl font-semibold text-gray-800">Selamat Datang, <?= session('nama') ?? 'Admin' ?>!</h1>
      <p class="text-gray-500">Dashboard Bill’s Barbershop</p>
    </div>

    <!-- Card Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      <!-- Card Layanan -->
      <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex flex-col justify-between">
        <div>
          <div class="flex items-center mb-3 text-sky-600">
            <i data-lucide="scissors" class="w-6 h-6 mr-2"></i>
            <h2 class="text-lg font-semibold text-gray-700">Layanan</h2>
          </div>
          <p class="text-gray-600">Total Layanan: <strong><?= $total_layanan ?></strong></p>
        </div>
        <div class="mt-4 text-right">
          <a href="<?= base_url('admin/layanan') ?>" class="text-sm text-blue-600 hover:underline">Selengkapnya →</a>
        </div>
      </div>

      <!-- Card Capster -->
      <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex flex-col justify-between">
        <div>
          <div class="flex items-center mb-3 text-green-600">
            <i data-lucide="users" class="w-6 h-6 mr-2"></i>
            <h2 class="text-lg font-semibold text-gray-700">Capster</h2>
          </div>
          <p class="text-gray-600">Total: <strong><?= $total_capster ?></strong></p>

        </div>
        <div class="mt-4 text-right">
          <a href="<?= base_url('admin/capster') ?>" class="text-sm text-blue-600 hover:underline">Selengkapnya →</a>
        </div>
      </div>

      <!-- Card Jadwal -->
      <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex flex-col justify-between">
        <div>
          <div class="flex items-center mb-3 text-yellow-500">
            <i data-lucide="calendar-days" class="w-6 h-6 mr-2"></i>
            <h2 class="text-lg font-semibold text-gray-700">Jadwal Capster</h2>
          </div>
          <p class="text-gray-600">Tersedia: <strong><?= $jadwal_tersedia ?></strong></p>
          <p class="text-gray-600">Penuh: <strong><?= $jadwal_penuh ?></strong></p>
        </div>
        <div class="mt-4 text-right">
          <a href="<?= base_url('admin/jadwal') ?>" class="text-sm text-blue-600 hover:underline">Selengkapnya →</a>
        </div>
      </div>

      <!-- Card Laporan Booking -->
      <div class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex flex-col justify-between col-span-1 md:col-span-2 lg:col-span-3">
        <div>
          <div class="flex items-center mb-3 text-purple-600">
            <i data-lucide="file-bar-chart-2" class="w-6 h-6 mr-2"></i>
            <h2 class="text-lg font-semibold text-gray-700">Laporan Booking</h2>
          </div>
          <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 text-md text-gray-600">
            <p>Total Booking: <strong><?= $total_booking ?></strong></p>
            <p>Selesai: <strong><?= $total_selesai ?></strong></p>
            <p>Batal: <strong><?= $total_batal ?></strong></p>
            <p>Booked: <strong><?= $total_booked ?></strong></p>
            <p>Total Pendapatan (Selesai): <strong>Rp <?= number_format($total_harga_selesai, 0, ',', '.') ?></strong></p>
          </div>
        </div>
        <div class="mt-4 text-right">
          <a href="<?= base_url('admin/booking') ?>" class="text-sm text-blue-600 hover:underline">Selengkapnya →</a>
        </div>
      </div>

    </div>

  </div>
</div>

<!-- Include Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
  lucide.createIcons();
</script>

<?= $this->endSection() ?>