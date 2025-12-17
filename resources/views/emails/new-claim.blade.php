<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Klaim Baru</title>
</head>
<body>
    <p>Halo {{ $claim->item->user->name ?? 'Pemilik barang' }},</p>

    <p>
        Ada klaim baru untuk barang:
        <strong>{{ $claim->item->name ?? 'Tanpa nama' }}</strong>
        dari pengguna:
        <strong>{{ $claim->user->name ?? 'Tanpa nama' }}</strong>.
    </p>

    <p>Pesan klaim:</p>
    <blockquote>
        {{ $claim->message }}
    </blockquote>

    <p>
        Silakan login ke sistem Manajemen Barang Hilang untuk memverifikasi klaim ini.
    </p>

    <p>Terima kasih.</p>
</body>
</html>
