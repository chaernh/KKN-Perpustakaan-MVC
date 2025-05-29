<?php
/**
 * View untuk menampilkan daftar peminjaman
 * 
 * View ini menampilkan daftar peminjaman dalam format tabel dengan fitur:
 * - Tombol untuk menambah peminjaman baru
 * - Tabel yang menampilkan data peminjaman
 * - Tombol edit dan hapus untuk setiap peminjaman
 */

?>
<h1>Daftar Peminjaman</h1>
<a href="?controller=peminjaman&action=create" class="btn-tambah-peminjaman">Tambah Peminjaman</a>
<ul>
    <?php foreach ($peminjamanList as $peminjaman): ?>
        <li>
            <div class="peminjaman-info">
								<p><span class="badge <?php echo $peminjaman['STATUS'] == 'DIPINJAM' ? 'badge-blue' : 'badge-success'; ?>"><?php echo htmlspecialchars($peminjaman['STATUS']); ?></span></p>
                <strong><?php echo htmlspecialchars($peminjaman['NAMA_PEMINJAM']); ?></strong>
                <p>Buku: <?php echo htmlspecialchars($peminjaman['NAMA_BUKU']); ?></p>
								<p>Tanggal Peminjaman: <?php echo htmlspecialchars($peminjaman['TANGGAL_PEMINJAMAN'] ?? '-'); ?></p>
								<p>Tanggal Pengembalian: <?php echo htmlspecialchars($peminjaman['TANGGAL_PENGEMBALIAN'] ?? '-'); ?></p>
            </div>
            <div class="peminjaman-actions">
                <a href="?controller=peminjaman&action=edit&id=<?php echo $peminjaman['ID_PEMINJAMAN']; ?>" class="btn-edit">Edit</a>
                <a href="?controller=peminjaman&action=destroy&id=<?php echo $peminjaman['ID_PEMINJAMAN']; ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')" 
                   class="btn-delete">Hapus</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>