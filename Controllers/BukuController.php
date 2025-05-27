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
        $bukuList = Buku::all();
        include 'Views/Buku/list.php';
    }

    /**
     * Menampilkan form untuk menambah buku baru
     * Method ini menampilkan form kosong di view form.php
     */
    public function create() {
        include 'Views/Buku/form.php';
    }

    /**
     * Menyimpan data buku baru ke database
     * @param array $data Data buku yang akan disimpan (judul dan pengarang)
     */
    public function store($data) {
        $buku = new Buku(null, $data['judul'], $data['pengarang']);
        $buku->save();
        header("Location: index.php");
    }

    /**
     * Menampilkan form edit buku
     * @param int $id ID buku yang akan diedit
     */
    public function edit($id) {
        $buku = Buku::find($id);
        if ($buku) {
            include 'Views/Buku/form.php';
        } else {
            header("Location: index.php");
        }
    }

    /**
     * Memperbarui data buku di database
     * @param array $data Data buku yang akan diperbarui (id, judul, dan pengarang)
     */
    public function update($data) {
        $buku = new Buku($data['id'], $data['judul'], $data['pengarang']);
        $buku->update();
        header("Location: index.php");
    }

    /**
     * Menghapus buku dari database
     * @param int $id ID buku yang akan dihapus
     */
    public function destroy($id) {
        Buku::delete($id);
        header("Location: index.php");
    }
}