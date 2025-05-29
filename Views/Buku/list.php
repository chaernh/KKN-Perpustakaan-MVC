<?php
/**
 * View untuk menampilkan daftar buku
 * 
 * View ini menampilkan daftar buku dalam format tabel dengan fitur:
 * - Tombol untuk menambah buku baru
 * - Tabel yang menampilkan data buku
 * - Tombol edit dan hapus untuk setiap buku
 */

?>
<h1>Daftar Buku</h1>
<a href="?controller=buku&action=create" class="btn-tambah-buku">Tambah Buku</a>
<ul>
    <?php foreach ($bukuList as $buku): ?>
        <li>
            <div class="buku-info">
                <strong><?php echo htmlspecialchars($buku['NAMA_BUKU']); ?></strong>
                <p>Pengarang: <?php echo htmlspecialchars($buku['PENGARANG']); ?></p>
								<p>Kategori: <?php echo htmlspecialchars($buku['NAMA_KATEGORI']); ?></p>
								<p>Genre: <?php echo htmlspecialchars($buku['GENRE']); ?></p>
            </div>
            <div class="buku-actions">
                <a href="?controller=buku&action=edit&id=<?php echo $buku['ID_BUKU']; ?>" class="btn-edit">Edit</a>
                <a href="?controller=buku&action=destroy&id=<?php echo $buku['ID_BUKU']; ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')" 
                   class="btn-delete">Hapus</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>