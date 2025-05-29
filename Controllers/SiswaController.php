<?php
require_once 'Models/Siswa.php';

/**
 * Controller untuk mengelola operasi CRUD siswa
 * 
 * Controller ini menangani semua operasi terkait siswa seperti:
 * - Menampilkan daftar siswa
 * - Menambah siswa baru
 * - Mengedit siswa
 * - Menghapus siswa
 * 
 * @package Perpustakaan
 * @version 1.0
 */
class SiswaController {
    private $siswaModel;

    public function __construct() {
        $this->siswaModel = new Siswa();
    }

    /**
     * Menampilkan daftar semua siswa
     * Method ini mengambil semua data siswa dan menampilkannya di view list.php
     */
    public function index() {
        $title = 'Siswa - Perpustakaan';
        $stmt = $this->siswaModel->getAllSiswa();
        $siswaList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        ob_start();
        include 'Views/Siswa/list.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }

    /**
     * Menampilkan form untuk menambah siswa baru
     * Method ini menampilkan form kosong di view form.php
     */
    public function create() {
        $title = 'Tambah Siswa - Perpustakaan';
        ob_start();
        include 'Views/Siswa/form.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }

    /**
     * Menyimpan data siswa baru
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						$siswa = new Siswa($_POST['id_siswa'], $_POST['nama_siswa'], $_POST['kelas_siswa'], $_POST['jurusan'], $_POST['email']);
            
            if ($siswa->createSiswa()) {
                header("Location: ?controller=siswa");
                exit();
            }
        }
        header("Location: ?controller=siswa&action=create");
        exit();
    }

    /**
     * Menampilkan form edit siswa
     */
    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: ?controller=siswa");
            exit();
        }

        $title = 'Edit Siswa - Perpustakaan';
        $stmt = $this->siswaModel->getSiswaById($_GET['id']);
        $siswa = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($siswa) {
            ob_start();
            include 'Views/Siswa/form.php';
            $content = ob_get_clean();
            include 'Views/layouts/main.php';
        } else {
            header("Location: ?controller=siswa");
            exit();
        }
    }

    /**
     * Memperbarui data siswa
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_siswa'])) {
            $siswa = new Siswa($_POST['id_siswa'], $_POST['nama_siswa'], $_POST['kelas_siswa'], $_POST['jurusan'], $_POST['email']);
            
            if ($siswa->updateSiswa()) {
                header("Location: ?controller=siswa");
                exit();
            }
        }
        header("Location: ?controller=siswa");
        exit();
    }

    /**
     * Menghapus siswa
     */
    public function destroy() {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            if ($id > 0) {
                if ($this->siswaModel->deleteSiswa($id)) {
                    header("Location: ?controller=siswa");
                    exit();
                } else {
                    // Siswa masih digunakan
                    $_SESSION['error'] = "Siswa tidak dapat dihapus karena masih digunakan oleh buku";
                    header("Location: ?controller=siswa");
                    exit();
                }
            }
        }
        header("Location: ?controller=siswa");
        exit();
    }
} 