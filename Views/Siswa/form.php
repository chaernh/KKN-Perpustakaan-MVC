<?php
/**
 * View untuk form tambah/edit siswa
 * 
 * Menampilkan form untuk menambah atau mengedit siswa dengan:
 * - Input nama siswa
 * - Input kelas siswa
 * - Input jurusan siswa
 * - Input email siswa
 * - Tombol submit
 * 
 * Variabel yang digunakan:
 * @var array|null $siswa Array data siswa jika dalam mode edit, null jika dalam mode tambah
 */
$title = isset($siswa) ? 'Edit Siswa - Perpustakaan' : 'Tambah Siswa - Perpustakaan';
ob_start();
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2><?= isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa' ?></h2>
        </div>
        <div class="card-body">
            <form action="?controller=siswa&action=<?= isset($siswa) ? 'update' : 'store' ?>" method="POST">
                <?php if (isset($siswa)): ?>
                    <input type="hidden" name="id_siswa" value="<?= $siswa['ID_SISWA'] ?>">
                <?php endif; ?>

								<div class="mb-3">
                    <label for="nama_siswa" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= isset($siswa) ? $siswa['NAMA_SISWA'] : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="kelas_siswa" class="form-label">Kelas</label>
                    <input type="text" class="form-control" id="kelas_siswa" name="kelas_siswa" value="<?= isset($siswa) ? $siswa['KELAS_SISWA'] : '' ?>" required>
                </div>

								<div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= isset($siswa) ? $siswa['JURUSAN'] : '' ?>" required>
                </div>

								<div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= isset($siswa) ? $siswa['EMAIL'] : '' ?>" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <?= isset($siswa) ? 'Update' : 'Simpan' ?>
                    </button>
                    <a href="?controller=siswa" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>