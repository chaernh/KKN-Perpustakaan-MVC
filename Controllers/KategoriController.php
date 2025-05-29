<?php
require_once 'Models/Kategori.php';

/**
 * Controller untuk mengelola operasi CRUD kategori
 * 
 * Controller ini menangani semua operasi terkait kategori seperti:
 * - Menampilkan daftar kategori
 * - Menambah kategori baru
 * - Mengedit kategori
 * - Menghapus kategori
 * 
 * @package Perpustakaan
 * @version 1.0
 */
class KategoriController {
    private $kategoriModel;

    public function __construct() {
        $this->kategoriModel = new Kategori();
    }

    /**
     * Menampilkan daftar semua kategori
     * Method ini mengambil semua data kategori dan menampilkannya di view list.php
     */
    public function index() {
        $title = 'Kategori - Perpustakaan';
        $stmt = $this->kategoriModel->getAllKategori();
        $kategoriList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        ob_start();
        include 'Views/Kategori/list.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }

    /**
     * Menampilkan form untuk menambah kategori baru
     * Method ini menampilkan form kosong di view form.php
     */
    public function create() {
        $title = 'Tambah Kategori - Perpustakaan';
        ob_start();
        include 'Views/Kategori/form.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }

    /**
     * Menyimpan data kategori baru
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kategori = new Kategori(null, $_POST['nama_kategori']);
            
            if ($kategori->createKategori()) {
                header("Location: ?controller=kategori");
                exit();
            }
        }
        header("Location: ?controller=kategori&action=create");
        exit();
    }

    /**
     * Menampilkan form edit kategori
     */
    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: ?controller=kategori");
            exit();
        }

        $title = 'Edit Kategori - Perpustakaan';
        $stmt = $this->kategoriModel->getKategoriById($_GET['id']);
        $kategori = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($kategori) {
            ob_start();
            include 'Views/Kategori/form.php';
            $content = ob_get_clean();
            include 'Views/layouts/main.php';
        } else {
            header("Location: ?controller=kategori");
            exit();
        }
    }

    /**
     * Memperbarui data kategori
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_kategori'])) {
            $kategori = new Kategori($_POST['id_kategori'], $_POST['nama_kategori']);
            
            if ($kategori->updateKategori()) {
                header("Location: ?controller=kategori");
                exit();
            }
        }
        header("Location: ?controller=kategori");
        exit();
    }

    /**
     * Menghapus kategori
     */
    public function destroy() {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if ($id > 0) {
                if ($this->kategoriModel->deleteKategori($id)) {
                    header("Location: ?controller=kategori");
                    exit();
                } else {
                    // Kategori masih digunakan
                    $_SESSION['error'] = "Kategori tidak dapat dihapus karena masih digunakan oleh buku";
                    header("Location: ?controller=kategori");
                    exit();
                }
            }
        }
        header("Location: ?controller=kategori");
        exit();
    }
} 