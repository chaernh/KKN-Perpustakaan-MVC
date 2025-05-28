<?php
/**
 * View untuk menampilkan daftar buku
 * 
 * Menampilkan tabel buku dengan fitur:
 * - Tombol untuk menambah buku baru
 * - Daftar buku dalam format list
 * - Tombol edit dan hapus untuk setiap buku
 * 
 * Variabel yang digunakan:
 * @var array $bukuList Array berisi objek Buku
 */
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Daftar Buku</h1>
		<a href="?controller=buku&action=create" style="text-decoration: none;">
			<button class="btn-tambah-buku" style="cursor: pointer;">
				Tambah Buku
			</button>
			</a>
    <ul>
        <?php foreach ($bukuList as $buku): ?>
            <li>
                <?= htmlspecialchars($buku->judul) ?> - <?= htmlspecialchars($buku->pengarang) ?>
                <a href="?controller=buku&action=edit&id=<?= $buku->id ?>">Edit</a>
                <a href="?controller=buku&action=destroy&id=<?= $buku->id ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>