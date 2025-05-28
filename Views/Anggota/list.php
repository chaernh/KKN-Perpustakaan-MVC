<?php
/**
 * View untuk menampilkan daftar anggota
 * 
 * View ini menampilkan daftar anggota dalam format tabel dengan fitur:
 * - Tombol untuk menambah anggota baru
 * - Tabel yang menampilkan data anggota
 * - Tombol edit dan hapus untuk setiap anggota
 */
?>
<h1>Daftar Anggota</h1>
<a href="?controller=anggota&action=create" class="btn-tambah-buku">Tambah Anggota</a>

<ul>
    <?php foreach ($anggotaList as $anggota): ?>
        <li>
            <div class="anggota-info">
                <strong><?php echo htmlspecialchars($anggota->nama); ?></strong>
                <p>Email: <?php echo htmlspecialchars($anggota->email); ?></p>
                <p>Telepon: <?php echo htmlspecialchars($anggota->telepon); ?></p>
            </div>
            <div class="anggota-actions">
                <a href="?controller=anggota&action=edit&id=<?php echo $anggota->id; ?>" class="btn-edit">Edit</a>
                <a href="?controller=anggota&action=destroy&id=<?php echo $anggota->id; ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')" 
                   class="btn-delete">Hapus</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul> 