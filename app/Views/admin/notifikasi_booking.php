<?php foreach ($notifBooking ?? [] as $notif): ?>
    <div class="card mb-2">
        <div class="card-body">
            <div class="flex gap-4">
                <div class="shrink-0">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($notif['nama_customer']) ?>" alt="Avatar">
                </div>
                <div class="grow">
                    <span class="float-end text-sm text-muted"><?= date('H:i', strtotime($notif['dibuat_pada'])) ?></span>
                    <h5 class="text-body mb-2"><?= esc($notif['nama_customer']) ?> - <?= esc($notif['nama_layanan']) ?></h5>
                    <p class="mb-0">Capster : <?= esc($notif['nama']) ?></p>
                    <p class="mb-0">Jadwal : <?= date('d M Y H:i', strtotime($notif['tanggal'] . ' ' . $notif['jam'])) ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>