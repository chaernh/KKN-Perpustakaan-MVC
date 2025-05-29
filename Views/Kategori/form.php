<?php
/**
 * View untuk form tambah/edit kategori
 * 
 * Menampilkan form untuk menambah atau mengedit kategori dengan:
 * - Input nama kategori
 * - Tombol submit
 * 
 * Variabel yang digunakan:
 * @var array|null $kategori Array data kategori jika dalam mode edit, null jika dalam mode tambah
 */
$title = isset($kategori) ? 'Edit Kategori - Perpustakaan' : 'Tambah Kategori - Perpustakaan';
ob_start();
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2><?= isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori' ?></h2>
        </div>
        <div class="card-body">
            <form action="?controller=kategori&action=<?= isset($kategori) ? 'update' : 'store' ?>" method="POST">
                <?php if (isset($kategori)): ?>
                    <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" 
                           value="<?= isset($kategori) ? $kategori['nama_kategori'] : '' ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <?= isset($kategori) ? 'Update' : 'Simpan' ?>
                    </button>
                    <a href="?controller=kategori" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>