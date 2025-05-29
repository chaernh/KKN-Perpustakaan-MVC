<?php
require_once 'Models/Peminjaman.php';
require_once 'Models/Siswa.php';
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
class PeminjamanController {
    private $peminjamanModel;
    private $siswaModel;
    private $bukuModel;

    public function __construct() {
        $this->peminjamanModel = new Peminjaman();
        $this->siswaModel = new Siswa();
        $this->bukuModel = new Buku();
    }

    /**
     * Menampilkan daftar semua peminjaman
     * Method ini mengambil semua data peminjaman dan menampilkannya di view list.php
     */
    public function index() {
        $title = 'Daftar Peminjaman - Perpustakaan';
        $stmt = $this->peminjamanModel->getAllPeminjaman();
        $peminjamanList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        ob_start();
        include 'Views/Peminjaman/list.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }

    /**
     * Menampilkan form untuk menambah peminjaman baru
     * Method ini menampilkan form kosong di view form.php
     */
    public function create() {
        $title = 'Tambah Peminjaman - Perpustakaan';
        $stmt = $this->siswaModel->getAllSiswa();
        $siswaList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $stmt = $this->bukuModel->getAllBuku();
        $bukuList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        ob_start();
        include 'Views/Peminjaman/form.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }

    /**
     * Menyimpan data peminjaman baru
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $peminjaman = new Peminjaman(
                null,
                $_POST['id_siswa'],
                $_POST['id_buku'],
                $_POST['tanggal_peminjaman'],
                isset($_POST['tanggal_pengembalian']) ? $_POST['tanggal_pengembalian'] : null,
                $_POST['status']
            );
            
            if ($peminjaman->createPeminjaman()) {
                header("Location: ?controller=peminjaman");
                exit();
            }
        }
        header("Location: ?controller=peminjaman&action=create");
        exit();
    }

    /**
     * Menampilkan form edit peminjaman
     */
    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: ?controller=peminjaman");
            exit();
        }

        $title = 'Edit Peminjaman - Perpustakaan';
        $stmt = $this->peminjamanModel->getPeminjamanById($_GET['id']);
        $peminjaman = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($peminjaman) {
            $stmt = $this->siswaModel->getAllSiswa();
            $siswaList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $stmt = $this->bukuModel->getAllBuku();
            $bukuList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            ob_start();
            include 'Views/Peminjaman/form.php';
            $content = ob_get_clean();
            include 'Views/layouts/main.php';
        } else {
            header("Location: ?controller=peminjaman");
            exit();
        }
    }

    /**
     * Memperbarui data peminjaman
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_peminjaman'])) {
            $peminjaman = new Peminjaman(
                $_POST['id_peminjaman'],
                $_POST['id_siswa'],
                $_POST['id_buku'],
                $_POST['tanggal_peminjaman'],
                $_POST['tanggal_pengembalian'],
                $_POST['status']
            );
            
            if ($peminjaman->updatePeminjaman()) {
                header("Location: ?controller=peminjaman");
                exit();
            }
        }
        header("Location: ?controller=peminjaman");
        exit();
    }

    /**
     * Menghapus peminjaman
     */
    public function destroy() {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if ($id > 0) {
                $this->peminjamanModel->deletePeminjaman($id);
            }
        }
        header("Location: ?controller=peminjaman");
        exit();
    }
}