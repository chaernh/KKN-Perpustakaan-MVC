<?php
/**
 * View untuk menampilkan daftar kategori
 * 
 * View ini menampilkan daftar kategori dalam format tabel dengan fitur:
 * - Tombol untuk menambah kategori baru
 * - Tabel yang menampilkan data kategori
 * - Tombol edit dan hapus untuk setiap kategori
 */

?>
<h1>Daftar Kategori</h1>
<a href="?controller=kategori&action=create" class="btn-tambah-kategori">Tambah Kategori</a>
<ul>
    <?php foreach ($kategoriList as $kategori): ?>
        <li>
            <div class="kategori-info">
                <strong><?php echo htmlspecialchars($kategori['NAMA_KATEGORI']); ?></strong>
            </div>
            <div class="kategori-actions">
                <a href="?controller=kategori&action=edit&id=<?php echo $kategori['ID_KATEGORI']; ?>" class="btn-edit">Edit</a>
                <a href="?controller=kategori&action=destroy&id=<?php echo $kategori['ID_KATEGORI']; ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" 
                   class="btn-delete">Hapus</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>