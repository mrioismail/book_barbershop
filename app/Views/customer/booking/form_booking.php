<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-[#141414] text-white font-sans text-xs sm:text-md md:text-base lg:text-lg">
    <div class="max-w-3xl mx-auto py-10 px-4">
        <h3 class="text-3xl md:text-2xl sm:text-xl font-bold text-center mb-3">
            <!-- atur gambar biar kecil -->
            <img src="<?= base_url('customer/images/logo.jpg'); ?>" alt="" class="w-24 mx-auto">Bills Barbershop
        </h3>
        <p class="text-center text-gray-400 mb-6 text-base md:text-sm sm:text-xs">
            Selangkah lagi untuk tampil lebih percaya diri — yuk mulai proses bookingmu sekarang!
        </p>

        <!-- Notifikasi Error -->
        <?php if (session('errors')): ?>
            <div class="bg-red-100 text-red-700 border border-red-400 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Card Form Booking -->
        <div class="bg-[#1e1e1e] p-6 rounded-xl shadow-md">
            <form id="booking-form" action="<?= base_url('booking/simpanBooking'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="space-y-10">

                    <!-- STEP 1: Capster -->
                    <div class="relative">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 flex items-center justify-center rounded-full bg-white text-black font-bold text-sm z-10">1</div>
                            <h2 class="ml-3 text-xl font-semibold text-white">Pilih Capster</h2>
                        </div>
                        <p class="ml-9 text-gray-400 mb-4">Pilih capster favorit kamu.</p>
                        <div class="ml-9">
                            <select name="capster_id" id="capster_id" class="w-full p-2 bg-white text-black rounded">
                                <option value="">-- Pilih Capster --</option>
                                <?php foreach ($capster as $c): ?>
                                    <option value="<?= $c['id']; ?>" <?= old('capster_id') == $c['id'] ? 'selected' : '' ?>>
                                        <?= esc($c['nama']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="absolute top-7 left-2.5 w-px h-[calc(100%-1.75rem)] bg-gray-600"></div>
                    </div>

                    <!-- STEP 2: Layanan -->
                    <div class="relative">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 flex items-center justify-center rounded-full bg-white text-black font-bold text-sm z-10">2</div>
                            <h2 class="ml-3 text-xl font-semibold text-white">Pilih Layanan</h2>
                        </div>
                        <p class="ml-9 text-gray-400 mb-4">Layanan hanya muncul jika capster sudah dipilih.</p>
                        <div class="ml-9">
                            <select name="layanan_id" id="layanan_id" class="w-full p-2 bg-white text-black rounded" disabled>
                                <option value="">Pilih Capster terlebih dahulu</option>
                            </select>
                        </div>
                        <div class="absolute top-7 left-2.5 w-px h-[calc(100%-1.75rem)] bg-gray-600"></div>
                    </div>

                    <!-- STEP 3: Jadwal -->
                    <div class="relative">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 flex items-center justify-center rounded-full bg-white text-black font-bold text-sm z-10">3</div>
                            <h2 class="ml-3 text-xl font-semibold text-white">Pilih Jadwal</h2>
                        </div>
                        <p class="ml-9 text-gray-400 mb-4">Pilih tanggal dan jam untuk menentukan jadwal kamu.</p>
                        <div class="ml-9 flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <select name="tanggal" id="tanggal" class="w-full p-2 bg-white text-black rounded" disabled>
                                    <option value="">-- Pilih Tanggal --</option>
                                </select>
                            </div>
                            <div class="flex-1">
                                <select name="jam" id="jam" class="w-full p-2 bg-white text-black rounded" disabled>
                                    <option value="">-- Pilih Jam --</option>
                                </select>
                            </div>
                        </div>
                        <div class="absolute top-7 left-2.5 w-px h-[calc(100%-1.75rem)] bg-gray-600"></div>
                    </div>

                    <!-- STEP 4: Data Diri -->
                    <div class="relative">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 flex items-center justify-center rounded-full bg-white text-black font-bold text-sm z-10">4</div>
                            <h2 class="ml-3 text-xl font-semibold text-white">Data Diri</h2>
                        </div>
                        <p class="ml-9 text-gray-400 mb-4">Isi data diri dengan benar.</p>
                        <div class="ml-9">
                            <label class="block font-semibold mb-1">Nama Lengkap</label>
                            <input type="text" name="nama_customer" class="w-full p-2 bg-white text-black rounded"
                                value="<?= old('nama_customer') ?>">

                            <label class="block font-semibold mt-4 mb-1">No WhatsApp</label>
                            <input type="text" name="no_hp" class="w-full p-2 bg-white text-black rounded"
                                value="<?= old('no_hp') ?>">

                            <label class="block font-semibold mt-4 mb-1">Catatan (Opsional)</label>
                            <textarea name="catatan" rows="3" class="w-full p-2 bg-white text-black rounded"><?= old('catatan') ?></textarea>
                        </div>
                        <div class="absolute top-7 left-2.5 w-px h-[calc(100%-1.75rem)] bg-gray-600"></div>
                    </div>

                    <!-- Tombol Booking -->
                    <div class="ml-9 pt-4">
                        <button type="button" onclick="openModal()"
                            class="w-full bg-white text-black py-2 rounded font-semibold transition duration-200 hover:ring-2 hover:ring-white hover:shadow-lg">
                            Booking Sekarang
                        </button>
                    </div>
                </div>
            </form>

        </div>

        <!-- Modal Konfirmasi -->
        <div id="confirmModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-40 flex items-center justify-center">
            <div class="bg-white rounded-xl w-80 p-6 shadow-xl text-center animate-fade-in">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Konfirmasi Booking</h3>
                <p class="text-gray-600 mb-5">Apakah data booking yang Anda isi sudah benar?</p>
                <div class="flex justify-between gap-4">
                    <button onclick="submitForm()" class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 rounded font-medium">
                        Ya, Booking
                    </button>
                    <button onclick="closeModal()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 rounded font-medium">
                        Batal
                    </button>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-5 text-center">
            <a href="<?= base_url('/'); ?>" class="text-sm text-gray-400 hover:underline">← Kembali ke Halaman Utama</a>
        </div>
    </div>

    <!-- Script Booking -->
    <script>
        const dataJadwal = <?= json_encode($data_jadwal); ?>;
        const layananUmum = <?= json_encode($layanan); ?>;
        const layananPerCapster = <?= json_encode($layanan_per_capster); ?>;

        const selectCapster = document.getElementById('capster_id');
        const selectLayanan = document.getElementById('layanan_id');
        const selectTanggal = document.getElementById('tanggal');
        const selectJam = document.getElementById('jam');

        selectCapster.addEventListener('change', function() {
            const capsterId = this.value;
            selectLayanan.innerHTML = '<option value="">-- Pilih Layanan --</option>';
            selectTanggal.innerHTML = '<option value="">-- Pilih Tanggal --</option>';
            selectJam.innerHTML = '<option value="">-- Pilih Jam --</option>';
            selectLayanan.disabled = true;
            selectTanggal.disabled = true;
            selectJam.disabled = true;

            if (layananPerCapster[capsterId]) {
                // Jika capster punya layanan spesifik
                layananPerCapster[capsterId].forEach(l => {
                    const opt = document.createElement('option');
                    opt.value = l.layanan_id;
                    opt.textContent = `${l.nama_layanan} - Rp ${parseInt(l.harga).toLocaleString('id-ID')}`;
                    selectLayanan.appendChild(opt);
                });
                selectLayanan.disabled = false;
            } else {
                // ⛳ fallback ke layanan umum
                layananUmum.forEach(l => {
                    const opt = document.createElement('option');
                    opt.value = l.id;
                    opt.textContent = `${l.nama_layanan} - Rp ${parseInt(l.harga_layanan).toLocaleString('id-ID')} (Umum)`;
                    selectLayanan.appendChild(opt);
                });
                selectLayanan.disabled = false;
            }

            if (dataJadwal[capsterId]) {
                Object.keys(dataJadwal[capsterId]).forEach(tgl => {
                    const opt = document.createElement('option');
                    opt.value = tgl;
                    opt.textContent = formatTanggal(tgl);
                    selectTanggal.appendChild(opt);
                });
                selectTanggal.disabled = false;
            }
        });

        selectTanggal.addEventListener('change', function() {
            const capsterId = selectCapster.value;
            const tanggal = this.value;
            selectJam.innerHTML = '<option value="">-- Pilih Jam --</option>';
            selectJam.disabled = true;

            if (dataJadwal[capsterId] && dataJadwal[capsterId][tanggal]) {
                dataJadwal[capsterId][tanggal].forEach(jam => {
                    const opt = document.createElement('option');
                    opt.value = jam;
                    opt.textContent = jam;
                    selectJam.appendChild(opt);
                });
                selectJam.disabled = false;
            }
        });

        function formatTanggal(tgl) {
            const date = new Date(tgl);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }

        function openModal() {
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        function submitForm() {
            document.getElementById('booking-form').submit();
        }
    </script>
</body>

</html>