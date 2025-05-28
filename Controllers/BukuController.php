<?php
require_once 'Models/Buku.php';

/**
 * Controller untuk mengelola operasi CRUD buku
 */
class BukuController {
    /**
     * Menampilkan daftar semua buku
     * Method ini mengambil semua data buku dan menampilkannya di view list.php
     */
    public function index() {
        $title = 'Daftar Buku - Perpustakaan';
        $bukuList = Buku::all();
        ob_start();
        include 'Views/Buku/list.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }

    /**
     * Menampilkan form untuk menambah buku baru
     * Method ini menampilkan form kosong di view form.php
     */
    public function create() {
        $title = 'Tambah Buku - Perpustakaan';
        ob_start();
        include 'Views/Buku/form.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }

    /**
     * Menyimpan data buku baru ke database
     * @param array $data Data buku yang akan disimpan (judul dan pengarang)
     */
    public function store($data) {
        $buku = new Buku(null, $data['judul'], $data['pengarang']);
        $buku->save();
        header("Location: ?controller=buku&action=index");
    }

    /**
     * Menampilkan form edit buku
     * @param int $id ID buku yang akan diedit
     */
    public function edit($id) {
        $title = 'Edit Buku - Perpustakaan';
        $buku = Buku::find($id);
        if ($buku) {
            ob_start();
            include 'Views/Buku/form.php';
            $content = ob_get_clean();
            include 'Views/layouts/main.php';
        } else {
            header("Location: ?controller=buku&action=index");
        }
    }

    /**
     * Memperbarui data buku di database
     * @param array $data Data buku yang akan diperbarui (id, judul, dan pengarang)
     */
    public function update($data) {
        $buku = new Buku($data['id'], $data['judul'], $data['pengarang']);
        $buku->update();
        header("Location: ?controller=buku&action=index");
    }

    /**
     * Menghapus buku dari database
     * @param int $id ID buku yang akan dihapus
     */
    public function destroy($id) {
        Buku::delete($id);
        header("Location: ?controller=buku&action=index");
    }
}