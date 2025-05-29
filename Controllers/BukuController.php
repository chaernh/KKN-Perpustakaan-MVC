<?php
require_once 'Models/Buku.php';
require_once 'Models/Kategori.php';

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
    private $bukuModel;
    private $kategoriModel;

    public function __construct() {
        $this->bukuModel = new Buku();
        $this->kategoriModel = new Kategori();
    }

    /**
     * Menampilkan daftar semua buku
     * Method ini mengambil semua data buku dan menampilkannya di view list.php
     */
    public function index() {
        $title = 'Daftar Buku - Perpustakaan';
        $stmt = $this->bukuModel->getAllBuku();
        $bukuList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
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
        $stmt = $this->kategoriModel->getAllKategori();
        $kategoris = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
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
            $buku = new Buku(
                null,
                $_POST['id_kategori'],
                $_POST['nama_buku'],
                $_POST['pengarang'],
                $_POST['genre']
            );
            
            if ($buku->createBuku()) {
                header("Location: ?controller=buku");
                exit();
            }
        }
        header("Location: ?controller=buku&action=create");
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
        $stmt = $this->bukuModel->getBukuById($_GET['id']);
        $buku = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($buku) {
            $stmt = $this->kategoriModel->getAllKategori();
            $kategoris = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_buku'])) {
            $buku = new Buku(
                $_POST['id_buku'],
                $_POST['id_kategori'],
                $_POST['nama_buku'],
                $_POST['pengarang'],
                $_POST['genre']
            );
            
            if ($buku->updateBuku()) {
                header("Location: ?controller=buku");
                exit();
            }
        }
        header("Location: ?controller=buku");
        exit();
    }

    /**
     * Menghapus buku
     */
    public function destroy() {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if ($id > 0) {
                $this->bukuModel->deleteBuku($id);
            }
        }
        header("Location: ?controller=buku");
        exit();
    }
}