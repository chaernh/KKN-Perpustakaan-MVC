<!DOCTYPE html>
<html>
<head><title>Daftar Buku</title></head>
<body>
    <h1>Daftar Buku</h1>
    <a href="?action=create">Tambah Buku</a>
    <ul>
        <?php foreach ($bukuList as $buku): ?>
            <li>
                <?= htmlspecialchars($buku->judul) ?> - <?= htmlspecialchars($buku->pengarang) ?>
                <a href="?action=edit&id=<?= $buku->id ?>">Edit</a>
                <a href="?action=destroy&id=<?= $buku->id ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>