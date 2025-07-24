<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: scale(0.95);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.4s ease-out forwards;
        }
    </style>

</head>


<body class="bg-[#f5f5f5] text-white font-sans text-xs sm:text-md md:text-base lg:text-lg">
    <div class="max-w-3xl mx-auto py-10 px-4">
        <h3 class="text-3xl md:text-2xl sm:text-xl font-bold text-center mb-3 text-gray-800">
            <!-- atur gambar biar kecil -->
            <img src="<?= base_url('customer/images/logo.jpg'); ?>" alt="" class="w-24 mx-auto">Bills Barbershop
        </h3>
        <p class="text-center text-gray-700 mb-6 text-base md:text-sm sm:text-xs">
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
        <form id="booking-form" action="<?= base_url('booking/simpanBooking'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="bg-[#153e35] p-6 rounded-xl shadow-md animate-fade-in">
                <div class="space-y-10">

                    <!-- STEP 1: Capster -->
                    <div class="relative opacity-0 animate-[fade-in_0.3s_ease-out_forwards] delay-100">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 flex items-center justify-center rounded-full bg-white text-black font-bold text-sm z-10">1</div>
                            <h2 class="ml-3 text-xl font-semibold text-white">Pilih Capster</h2>
                        </div>
                        <p class="ml-9 text-gray-400 mb-4">Pilih capster andalanmu. Siapa yang paling cocok buat gaya kamu hari ini?</p>
                        <div class="ml-9">
                            <select name="capster_id" id="capster_id" class="w-full p-2 bg-white text-black rounded transition-all duration-200 focus:ring-2 focus:ring-white/40 focus:outline-none">
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
                    <div class="relative opacity-0 animate-[fade-in_0.3s_ease-out_forwards] delay-200">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 flex items-center justify-center rounded-full bg-white text-black font-bold text-sm z-10">2</div>
                            <h2 class="ml-3 text-xl font-semibold text-white">Pilih Layanan</h2>
                        </div>
                        <p class="ml-9 text-gray-400 mb-4">Pilih jenis layanan sesuai kebutuhan kamu. Tapi sebelumnya, pilih capsternya dulu ya!</p>
                        <div class="ml-9">
                            <select name="layanan_id" id="layanan_id" class="w-full p-2 bg-white text-black rounded" disabled>
                                <option value="">Pilih Capster terlebih dahulu</option>
                            </select>
                        </div>
                        <div class="absolute top-7 left-2.5 w-px h-[calc(100%-1.75rem)] bg-gray-600"></div>
                    </div>

                    <!-- STEP 3: Jadwal -->
                    <div class="relative opacity-0 animate-[fade-in_0.3s_ease-out_forwards] delay-400">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 flex items-center justify-center rounded-full bg-white text-black font-bold text-sm z-10">3</div>
                            <h2 class="ml-3 text-xl font-semibold text-white">Pilih Jadwal</h2>
                        </div>
                        <p class="ml-9 text-gray-400 mb-4">Atur waktu terbaikmu! Pilih tanggal dan jam yang sesuai.</p>

                        <div class="ml-9 flex flex-col gap-4">
                            <!-- Pilih Tanggal -->
                            <div>
                                <select name="tanggal" id="tanggal" class="w-full p-2 bg-white text-black rounded" disabled>
                                    <option value="">-- Pilih Tanggal --</option>
                                </select>
                            </div>

                            <!-- Pilih Jam -->
                            <div>
                                <div id="jam-container" class="flex flex-wrap gap-2 disabled:opacity-50" disabled></div>
                                <input type="hidden" name="jam" id="jam" />
                            </div>
                        </div>

                        <div class="absolute top-7 left-2.5 w-px h-[calc(100%-1.75rem)] bg-gray-600"></div>
                    </div>


                    <!-- STEP 4: Data Diri -->
                    <div class="relative opacity-0 animate-[fade-in_0.3s_ease-out_forwards] delay-600">
                        <div class="flex items-center mb-4">
                            <div class="w-6 h-6 flex items-center justify-center rounded-full bg-white text-black font-bold text-sm z-10">4</div>
                            <h2 class="ml-3 text-xl font-semibold text-white">Data Diri</h2>
                        </div>
                        <p class="ml-9 text-gray-400 mb-4">Masukkan data dirimu dengan benar supaya kami bisa konfirmasi.</p>
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
                            class="w-full bg-white text-black py-2 rounded font-semibold transition-all duration-300 hover:scale-[1.02] hover:ring-2 hover:ring-white/50 hover:shadow-lg">
                            Booking Sekarang
                        </button>
                        <!-- Tombol Kembali -->
                        <div class="mt-5 text-center">
                            <a href="<?= base_url('/'); ?>" class="text-sm text-gray-400 hover:underline">← Kembali ke Halaman Utama</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

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

        <div class="mt-10 text-center text-sm text-gray-600">
            © <?= date('Y'); ?> | Designed & Developed by
            <a href="https://instagram.com/rionel10" target="_blank" class="font-medium text-gray-700 hover:underline">
                Rionel
            </a>
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
        const jamContainer = document.getElementById('jam-container');
        const inputJam = document.getElementById('jam');

        // Fungsi format tanggal
        function formatTanggal(tgl) {
            const date = new Date(tgl);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        }

        // Saat capster diubah
        selectCapster.addEventListener('change', function() {
            const capsterId = this.value;

            // Reset semua input berikutnya
            selectLayanan.innerHTML = '<option value="">-- Pilih Layanan --</option>';
            selectLayanan.disabled = true;
            selectTanggal.innerHTML = '<option value="">-- Pilih Tanggal --</option>';
            selectTanggal.disabled = true;
            jamContainer.innerHTML = '';
            inputJam.value = '';

            // Isi layanan
            const layanan = layananPerCapster[capsterId] || layananUmum;
            layanan.forEach(l => {
                const opt = document.createElement('option');
                opt.value = l.layanan_id || l.id;
                const harga = l.harga || l.harga_layanan;
                const label = `${l.nama_layanan} - Rp ${parseInt(harga).toLocaleString('id-ID')}`;
                opt.textContent = label + (l.layanan_id ? '' : ' (Umum)');
                selectLayanan.appendChild(opt);
            });
            selectLayanan.disabled = false;

            // Isi tanggal
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

        // Saat tanggal diubah
        selectTanggal.addEventListener('change', function() {
            const capsterId = selectCapster.value;
            const tanggal = this.value;
            jamContainer.innerHTML = '';
            inputJam.value = '';

            if (dataJadwal[capsterId] && dataJadwal[capsterId][tanggal]) {
                dataJadwal[capsterId][tanggal].forEach(jam => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'jam-btn px-4 py-2 rounded-full bg-white text-[#153e35] font-semibold shadow hover:bg-[#153e35] hover:text-white transition-all';
                    btn.textContent = jam;

                    btn.addEventListener('click', () => {
                        // Reset tampilan semua jam
                        document.querySelectorAll('.jam-btn').forEach(el => {
                            el.classList.remove('bg-[#153e35]', 'text-white');
                            el.classList.add('bg-white', 'text-[#153e35]');
                        });

                        // Aktifkan tombol yang diklik
                        btn.classList.remove('bg-white', 'text-[#153e35]');
                        btn.classList.add('bg-[#153e35]', 'text-white');

                        // Set nilai jam
                        inputJam.value = jam;
                    });

                    jamContainer.appendChild(btn);
                });
            }
        });

        // Modal
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