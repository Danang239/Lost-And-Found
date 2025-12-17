<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Status Klaim Barang</title>
</head>
<body>
    <p>Halo {{ $claim->user->name }},</p>

    <p>
        Klaim Anda untuk barang
        <strong>{{ $claim->item->name ?? 'Tanpa nama' }}</strong>
        telah
        <strong>{{ $claim->verified == 1 ? 'DISETUJUI' : 'DITOLAK' }}</strong>.
    </p>

    @if($claim->verified == 1)
        <p>Silakan ikuti instruksi dari pelapor/admin untuk pengambilan barang.</p>
    @else
        <p>Mohon maaf, klaim Anda belum dapat disetujui.</p>
    @endif

    <p>Terima kasih telah menggunakan sistem Manajemen Barang Hilang.</p>
</body>
</html>