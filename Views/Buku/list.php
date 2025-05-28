<?php
/**
 * View untuk menampilkan daftar buku
 * 
 * View ini menampilkan daftar buku dalam format tabel dengan fitur:
 * - Tombol untuk menambah buku baru
 * - Tabel yang menampilkan data buku
 * - Tombol edit dan hapus untuk setiap buku
 */

// Debug: Tampilkan data yang diterima view
error_log('Data di View List: ' . print_r($bukuList, true));
?>
<h1>Daftar Buku</h1>
<a href="?controller=buku&action=create" class="btn-tambah-buku">Tambah Buku</a>
<ul>
    <?php foreach ($bukuList as $buku): ?>
        <li>
            <div class="buku-info">
                <strong><?php echo htmlspecialchars($buku->judul); ?></strong>
                <p>Pengarang: <?php echo htmlspecialchars($buku->pengarang); ?></p>
            </div>
            <div class="buku-actions">
                <a href="?controller=buku&action=edit&id=<?php echo $buku->id; ?>" class="btn-edit">Edit</a>
                <a href="?controller=buku&action=destroy&id=<?php echo $buku->id; ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')" 
                   class="btn-delete">Hapus</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>