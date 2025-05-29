<?php
/**
 * View untuk form tambah/edit buku
 * 
 * Menampilkan form untuk menambah atau mengedit buku dengan:
 * - Input kategori (dropdown)
 * - Input nama buku
 * - Input pengarang
 * - Input genre
 * - Tombol submit
 * 
 * Variabel yang digunakan:
 * @var array|null $buku Data buku jika edit, null jika tambah
 * @var array $kategoris Daftar kategori
 */
$title = isset($buku) ? 'Edit Buku - Perpustakaan' : 'Tambah Buku - Perpustakaan';
ob_start();
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2><?= isset($buku) ? 'Edit Buku' : 'Tambah Buku' ?></h2>
        </div>
        <div class="card-body">
            <form action="?controller=buku&action=<?= isset($buku) ? 'update' : 'store' ?>" method="POST">
                <?php if (isset($buku)): ?>
                    <input type="hidden" name="id_buku" value="<?= $buku['ID_BUKU'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="id_kategori" name="id_kategori" required>
                        <option value="">Pilih Kategori</option>
                        <?php foreach ($kategoris as $kategori): ?>
                            <option value="<?= $kategori['ID_KATEGORI'] ?>" <?= (isset($buku) && $buku['ID_KATEGORI'] == $kategori['ID_KATEGORI']) ? 'selected' : '' ?>>
                                <?= $kategori['NAMA_KATEGORI'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nama_buku" class="form-label">Nama Buku</label>
                    <input type="text" class="form-control" id="nama_buku" name="nama_buku" value="<?= isset($buku) ? $buku['NAMA_BUKU'] : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= isset($buku) ? $buku['PENGARANG'] : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" class="form-control" id="genre" name="genre" value="<?= isset($buku) ? $buku['GENRE'] : '' ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <?= isset($buku) ? 'Update' : 'Simpan' ?>
                    </button>
                    <a href="?controller=buku" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>