<?php
/**
 * View untuk form tambah/edit buku
 * 
 * Menampilkan form untuk menambah atau mengedit buku dengan:
 * - Input judul buku
 * - Input pengarang
 * - Tombol submit
 * 
 * Variabel yang digunakan:
 * @var Buku|null $buku Objek Buku jika dalam mode edit, null jika dalam mode tambah
 */
?>
<h1><?php echo isset($buku) ? 'Edit Buku' : 'Tambah Buku'; ?></h1>
<form method="post" action="?controller=buku&action=<?php echo isset($buku) ? 'update' : 'store'; ?>">
    <?php if (isset($buku)): ?>
        <input type="hidden" name="id" value="<?php echo $buku->id; ?>">
    <?php endif; ?>
    <div>
        <label for="judul">Judul:</label>
        <input type="text" id="judul" name="judul" value="<?php echo isset($buku) ? htmlspecialchars($buku->judul) : ''; ?>" required>
    </div>
    <div>
        <label for="pengarang">Pengarang:</label>
        <input type="text" id="pengarang" name="pengarang" value="<?php echo isset($buku) ? htmlspecialchars($buku->pengarang) : ''; ?>" required>
    </div>
    <div>
        <button type="submit">Simpan</button>
        <a href="?controller=buku" class="btn-cancel">Batal</a>
    </div>
</form>