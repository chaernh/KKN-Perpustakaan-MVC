<?php
/**
 * View untuk menampilkan daftar siswa
 * 
 * View ini menampilkan daftar siswa dalam format tabel dengan fitur:
 * - Tombol untuk menambah siswa baru
 * - Tabel yang menampilkan data siswa
 * - Tombol edit dan hapus untuk setiap siswa
 */

?>
<h1>Daftar Siswa</h1>
<a href="?controller=siswa&action=create" class="btn-tambah-siswa">Tambah Siswa</a>
<ul>
    <?php foreach ($siswaList as $siswa): ?>
        <li>
            <div class="siswa-info">
                <strong><?php echo htmlspecialchars($siswa['NAMA_SISWA']); ?></strong>
								<p>Kelas: <?php echo htmlspecialchars($siswa['KELAS_SISWA']); ?></p>
								<p>Jurusan: <?php echo htmlspecialchars($siswa['JURUSAN']); ?></p>
								<p>Email: <?php echo htmlspecialchars($siswa['EMAIL']); ?></p>
            </div>
            <div class="siswa-actions">
                <a href="?controller=siswa&action=edit&id=<?php echo $siswa['ID_SISWA']; ?>" class="btn-edit">Edit</a>
                <a href="?controller=siswa&action=destroy&id=<?php echo $siswa['ID_SISWA']; ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')" 
                   class="btn-delete">Hapus</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>