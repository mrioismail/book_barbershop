<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200">

    <div class="max-w-md mx-auto my-10 bg-white rounded-xl shadow-lg p-6 text-center">
        <div class="mb-6">
            <div class="w-16 h-16 bg-green-500 mx-auto rounded-full flex items-center justify-center text-white text-3xl">
                ✓
            </div>
            <h2 class="text-2xl font-semibold mt-4">Rp<?= number_format($layanan['harga'], 0, ',', '.'); ?></h2>
            <p class="text-green-600 mt-2">Booking Berhasil!</p>
        </div>

        <table class="w-full text-sm text-gray-700 mb-6 text-left mx-auto">
            <tbody>
                <tr class="border-t border-gray-200">
                    <td class="py-2 font-medium w-1/2">Nama Customer</td>
                    <td class="py-2 text-right"><?= esc($booking['nama_customer']); ?></td>
                </tr>
                <tr class="border-t border-gray-200">
                    <td class="py-2 font-medium">No WhatsApp</td>
                    <td class="py-2 text-right"><?= esc($booking['no_hp']); ?></td>
                </tr>
                <tr class="border-t border-gray-200">
                    <td class="py-2 font-medium">Layanan</td>
                    <td class="py-2 text-right"><?= esc($layanan['nama_layanan']); ?></td>
                </tr>
                <tr class="border-t border-gray-200">
                    <td class="py-2 font-medium">Capster</td>
                    <td class="py-2 text-right"><?= esc($capster['nama']); ?></td>
                </tr>
                <tr class="border-t border-gray-200">
                    <td class="py-2 font-medium">Tanggal Booking</td>
                    <td class="py-2 text-right"><?= date('d M Y', strtotime($booking['tanggal'])); ?></td>
                </tr>
                <tr class="border-t border-gray-200">
                    <td class="py-2 font-medium">Jam Booking</td>
                    <td class="py-2 text-right"><?= esc($booking['jam']); ?></td>
                </tr>
                <?php if (!empty($booking['catatan'])): ?>
                    <tr class="border-t border-gray-200">
                        <td class="py-2 font-medium">Catatan</td>
                        <td class="py-2 text-right"><?= esc($booking['catatan']); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="text-sm text-gray-600 mb-6 text-left">
            <p class="mb-1">• Maks keterlambatan <strong>10 menit</strong> dari jadwal. Lewat dari itu akan dilewati ke antrian berikutnya.</p>
            <p class="mb-1">• Situs web ini diperbarui secara <strong>real-time</strong>. Silakan cek secara berkala.</p>
            <p>• Reschedule atau pembatalan dapat dilakukan via <strong>Wa</strong>.</p>
            <p class="text-red-500">• Diharapkan bukti booking disimpan atau di screnshoot.</p>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex flex-col sm:flex-row justify-center gap-3">
            <a href="<?= base_url('/'); ?>" class="bg-gray-500 hover:bg-gray-600 text-white text-sm px-5 py-2 rounded transition">
                Kembali ke Beranda
            </a>
            <a href="<?= $linkWA ?>" target="_blank" class="bg-green-500 hover:bg-green-600 text-white text-sm px-5 py-2 rounded transition">
                Kirim WhatsApp
            </a>
        </div>

    </div>


</body>

</html>