<!DOCTYPE html>
<html>
<head><title>Daftar Buku</title></head>
<body>
    <h1>Daftar Buku</h1>
    <a href="?action=create">Tambah Buku</a>
    <ul>
        <?php foreach ($bukuList as $buku): ?>
            <li><?= htmlspecialchars($buku->judul) ?> - <?= htmlspecialchars($buku->pengarang) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>