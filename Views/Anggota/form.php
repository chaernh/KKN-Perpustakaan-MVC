<?php
/**
 * View untuk menampilkan form tambah/edit anggota
 * 
 * View ini menampilkan form untuk menambah atau mengedit data anggota dengan fitur:
 * - Input untuk nama anggota
 * - Input untuk email anggota
 * - Input untuk telepon anggota
 * - Tombol simpan dan batal
 */
?>
<h1><?php echo isset($anggota) ? 'Edit Anggota' : 'Tambah Anggota'; ?></h1>

<form method="POST" action="?controller=anggota&action=<?php echo isset($anggota) ? 'update' : 'store'; ?>">
    <?php if (isset($anggota)): ?>
        <input type="hidden" name="id" value="<?php echo $anggota->id; ?>">
    <?php endif; ?>
    
    <div>
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo isset($anggota) ? htmlspecialchars($anggota->nama) : ''; ?>" required>
    </div>
    
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($anggota) ? htmlspecialchars($anggota->email) : ''; ?>" required>
    </div>
    
    <div>
        <label for="telepon">Telepon:</label>
        <input type="tel" id="telepon" name="telepon" value="<?php echo isset($anggota) ? htmlspecialchars($anggota->telepon) : ''; ?>" required>
    </div>
    
    <div>
        <button type="submit">Simpan</button>
        <a href="?controller=anggota" class="btn-cancel">Batal</a>
    </div>
</form> 