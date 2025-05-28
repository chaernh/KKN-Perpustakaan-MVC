<?php
require_once 'Models/Buku.php';

/**
 * Controller untuk mengelola operasi CRUD buku
 * 
 * Controller ini menangani semua operasi terkait buku seperti:
 * - Menampilkan daftar buku
 * - Menambah buku baru
 * - Mengedit buku
 * - Menghapus buku
 * 
 * @package Perpustakaan
 * @version 1.0
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
     * Menyimpan data buku baru
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $buku = new Buku(null, $_POST['judul'], $_POST['pengarang']);
            $buku->save();
        }
        header("Location: ?controller=buku");
        exit();
    }

    /**
     * Menampilkan form edit buku
     */
    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: ?controller=buku");
            exit();
        }

        $title = 'Edit Buku - Perpustakaan';
        $buku = Buku::find($_GET['id']);
        
        if ($buku) {
            ob_start();
            include 'Views/Buku/form.php';
            $content = ob_get_clean();
            include 'Views/layouts/main.php';
        } else {
            header("Location: ?controller=buku");
            exit();
        }
    }

    /**
     * Memperbarui data buku
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $buku = new Buku($_POST['id'], $_POST['judul'], $_POST['pengarang']);
            $buku->update();
        }
        header("Location: ?controller=buku");
        exit();
    }

    /**
     * Menghapus buku
     */
    public function destroy() {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id']; // Konversi ke integer untuk keamanan
            if ($id > 0) { // Pastikan ID valid
                Buku::delete($id);
            }
        }
        header("Location: ?controller=buku");
        exit();
    }
}