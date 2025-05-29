<?php
/**
 * View untuk form tambah/edit peminjaman
 * 
 * Menampilkan form untuk menambah atau mengedit peminjaman dengan:
 * - Input id_siswa (dropdown)
 * - Input id_buku (dropdown)
 * - Input tanggal_peminjaman
 * - Input tanggal_pengembalian
 * - Input status
 * - Tombol submit
 * 
 * Variabel yang digunakan:
 * @var array|null $peminjaman Data peminjaman jika edit, null jika tambah
 * @var array $siswaList Daftar siswa
 * @var array $bukuList Daftar buku
 */
	$title = isset($peminjaman) ? 'Edit Peminjaman - Perpustakaan' : 'Tambah Peminjaman - Perpustakaan';
	ob_start();

	// Fungsi untuk mengambil tanggal dari datetime
	function onlyDate($datetime) {
			return $datetime ? substr($datetime, 0, 10) : '';
	}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h2><?= isset($peminjaman) ? 'Edit Peminjaman' : 'Tambah Peminjaman' ?></h2>
        </div>
        <div class="card-body">
            <form action="?controller=peminjaman&action=<?= isset($peminjaman) ? 'update' : 'store' ?>" method="POST">
                <?php if (isset($peminjaman)): ?>
                    <input type="hidden" name="id_peminjaman" value="<?= $peminjaman['ID_PEMINJAMAN'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label for="id_siswa" class="form-label">Siswa</label>
                    <select class="form-select" id="id_siswa" name="id_siswa" required>
                        <option value="">Pilih Siswa</option>
                        <?php foreach ($siswaList as $siswa): ?>
                            <option value="<?= $siswa['ID_SISWA'] ?>" <?= (isset($peminjaman) && $peminjaman['ID_SISWA'] == $siswa['ID_SISWA']) ? 'selected' : '' ?>>
                                <?= $siswa['NAMA_SISWA'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_buku" class="form-label">Buku</label>
                    <select class="form-select" id="id_buku" name="id_buku" required>
                        <option value="">Pilih Buku</option>
                        <?php foreach ($bukuList as $buku): ?>
                            <option value="<?= $buku['ID_BUKU'] ?>" <?= (isset($peminjaman) && $peminjaman['ID_BUKU'] == $buku['ID_BUKU']) ? 'selected' : '' ?>>
                                <?= $buku['NAMA_BUKU'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman</label>
                    <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" value="<?= isset($peminjaman) ? onlyDate($peminjaman['TANGGAL_PEMINJAMAN']) : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                    <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" value="<?= isset($peminjaman) ? onlyDate($peminjaman['TANGGAL_PENGEMBALIAN']) : '' ?>" ?>
                </div>

								<div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="" disabled <?= isset($peminjaman) ? '' : 'selected' ?>>Pilih Status</option>
                        <option value="DIPINJAM" <?= isset($peminjaman) && $peminjaman['STATUS'] == 'DIPINJAM' ? 'selected' : '' ?>>Dipinjam</option>
                        <option value="DIKEMBALIKAN" <?= isset($peminjaman) && $peminjaman['STATUS'] == 'DIKEMBALIKAN' ? 'selected' : '' ?>>Dikembalikan</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <?= isset($peminjaman) ? 'Update' : 'Simpan' ?>
                    </button>
                    <a href="?controller=peminjaman" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>