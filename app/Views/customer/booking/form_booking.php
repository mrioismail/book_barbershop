<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Booking Barbershop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6b7280',
                        secondary: '#facc15',
                        accent: '#4b5563',
                    }
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <div class="max-w-md mx-auto my-10 px-6 sm:px-8 md:px-10 py-6 bg-white shadow-xl rounded-2xl">
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Form Booking Bills Barbershop</h2>
            <p class="text-center text-gray-500">Cukup isi data di bawah ini dan pilih waktu yang pas. Gaya rambut keren tinggal selangkah lagi!</p>
        </div>

        <?php if (session('errors')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul class="list-disc list-inside">
                    <?php foreach (session('errors') as $err): ?>
                        <li><?= esc($err); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form id="booking-form" action="<?= base_url('booking/simpanBooking'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-user"></i></span>
                        <input type="text" name="nama_customer" value="<?= old('nama_customer'); ?>" placeholder="Nama Lengkap" class="w-full pl-10 mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary <?= session('errors.nama_customer') ? 'border-red-500' : ''; ?>">
                    </div>
                </div>
                <div>
                    <label class="block font-semibold">Nomor WhatsApp</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-phone"></i></span>
                        <input
                            type="text"
                            name="no_hp"
                            value="<?= old('no_hp'); ?>"
                            placeholder="08xxxxxxxxxx"
                            pattern="08[0-9]{8,11}"
                            minlength="10"
                            maxlength="13"
                            title="Nomor harus diawali dengan 08 dan terdiri dari 10–13 digit angka"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            required
                            class="w-full pl-10 mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary <?= session('errors.no_hp') ? 'border-red-500' : ''; ?>">
                    </div>
                </div>
                <div>
                    <label class="block font-semibold">Pilih Layanan</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-cut"></i></span>
                        <select name="layanan_id" class="w-full pl-10 mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary <?= session('errors.layanan_id') ? 'border-red-500' : ''; ?>">
                            <option value=""> Pilih Layanan </option>
                            <?php foreach ($layanan as $lay): ?>
                                <option value="<?= $lay['id']; ?>" <?= old('layanan_id') == $lay['id'] ? 'selected' : ''; ?>>
                                    <?= $lay['nama_layanan']; ?> - Rp<?= number_format($lay['harga'], 0, ',', '.'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold">Pilih Capster</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-user-tie"></i></span>
                        <select name="capster_id" id="capster_id" class="w-full pl-10 mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary <?= session('errors.capster_id') ? 'border-red-500' : ''; ?>">
                            <option value=""> Pilih Capster </option>
                            <?php foreach ($capster as $cap): ?>
                                <option value="<?= $cap['id']; ?>" <?= old('capster_id') == $cap['id'] ? 'selected' : ''; ?>>
                                    <?= $cap['nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold">Pilih Tanggal</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-calendar-alt"></i></span>
                        <select name="tanggal" id="tanggal" class="w-full pl-10 mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary <?= session('errors.tanggal') ? 'border-red-500' : ''; ?>" <?= old('capster_id') ? '' : 'disabled'; ?>>
                            <option value=""> Pilih Tanggal </option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold">Pilih Jam</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-400"><i class="fas fa-clock"></i></span>
                        <select name="jam" id="jam" class="w-full pl-10 mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary <?= session('errors.jam') ? 'border-red-500' : ''; ?>" <?= old('tanggal') ? '' : 'disabled'; ?>>
                            <option value=""> Pilih Jam </option>
                        </select>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold">Catatan (opsional)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-400"><i class="fas fa-sticky-note"></i></span>
                        <textarea name="catatan" rows="3" class="w-full pl-10 mt-1 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary <?= session('errors.catatan') ? 'border-red-500' : ''; ?>" placeholder="Tulis jika ada yang ingin disampaikan..."><?= old('catatan'); ?></textarea>
                    </div>
                </div>
            </div>

            <div class="text-center mt-6">
                <button type="button" onclick="showConfirmation()" class="px-6 py-3 bg-gray-800 text-white font-semibold rounded-full shadow-lg hover:bg-gray-700 transition-all duration-300 ease-in-out">Booking Sekarang</button>
                <div class="mt-3">
                    <a href="<?= base_url('/'); ?>" class="text-sm text-gray-500 hover:underline">← Kembali ke Halaman Utama</a>
                </div>
            </div>
        </form>
    </div>

    <div id="modalKonfirmasi" class="fixed inset-0 hidden bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-md w-full shadow-lg">
            <h3 class="text-lg font-bold mb-4 text-gray-800">Konfirmasi Booking</h3>
            <p class="text-gray-600 mb-6">Apakah Anda yakin data yang diisi sudah benar?</p>
            <div class="flex justify-end space-x-2">
                <button onclick="closeConfirmation()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Periksa Kembali</button>
                <button onclick="submitBooking()" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">Ya, Booking Sekarang</button>
            </div>
        </div>
    </div>

    <script>
        function showConfirmation() {
            document.getElementById('modalKonfirmasi').classList.remove('hidden');
        }

        function closeConfirmation() {
            document.getElementById('modalKonfirmasi').classList.add('hidden');
        }

        function submitBooking() {
            document.getElementById('booking-form').submit();
        }

        const dataJadwal = <?= json_encode($data_jadwal); ?>;
        const selectCapster = document.getElementById('capster_id');
        const selectTanggal = document.getElementById('tanggal');
        const selectJam = document.getElementById('jam');

        selectCapster.addEventListener('change', function() {
            const capsterId = this.value;
            selectTanggal.innerHTML = '<option value="">-- Pilih Tanggal --</option>';
            selectJam.innerHTML = '<option value="">-- Pilih Jam --</option>';
            selectTanggal.disabled = true;
            selectJam.disabled = true;

            if (dataJadwal[capsterId]) {
                const tanggalList = Object.keys(dataJadwal[capsterId]);
                tanggalList.forEach(tgl => {
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
            const options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            return date.toLocaleDateString('id-ID', options);
        }
    </script>
</body>

</html>