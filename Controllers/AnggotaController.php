<?php
require_once 'Models/Anggota.php';

/**
 * Controller untuk mengelola operasi CRUD anggota
 * 
 * Controller ini menangani semua operasi terkait anggota seperti:
 * - Menampilkan daftar anggota
 * - Menambah anggota baru
 * - Mengedit anggota
 * - Menghapus anggota
 * 
 * @package Perpustakaan
 * @version 1.0
 */
class AnggotaController {
    /**
     * Menampilkan daftar semua anggota
     * Method ini mengambil semua data anggota dan menampilkannya di view list.php
     */
    public function index() {
        $title = 'Daftar Anggota - Perpustakaan';
        $anggotaList = Anggota::all();
        ob_start();
        include 'Views/Anggota/list.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }

    /**
     * Menampilkan form untuk menambah anggota baru
     * Method ini menampilkan form kosong di view form.php
     */
    public function create() {
        $title = 'Tambah Anggota - Perpustakaan';
        ob_start();
        include 'Views/Anggota/form.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }

    /**
     * Menyimpan data anggota baru
     */
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $anggota = new Anggota(
                null,
                $_POST['nama'],
                $_POST['email'],
                $_POST['telepon']
            );
            $anggota->save();
        }
        header("Location: ?controller=anggota");
        exit();
    }

    /**
     * Menampilkan form edit anggota
     */
    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: ?controller=anggota");
            exit();
        }

        $title = 'Edit Anggota - Perpustakaan';
        $anggota = Anggota::find($_GET['id']);
        
        if ($anggota) {
            ob_start();
            include 'Views/Anggota/form.php';
            $content = ob_get_clean();
            include 'Views/layouts/main.php';
        } else {
            header("Location: ?controller=anggota");
            exit();
        }
    }

    /**
     * Memperbarui data anggota
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $anggota = new Anggota(
                $_POST['id'],
                $_POST['nama'],
                $_POST['email'],
                $_POST['telepon']
            );
            $anggota->update();
        }
        header("Location: ?controller=anggota");
        exit();
    }

    /**
     * Menghapus anggota
     */
    public function destroy() {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id']; // Konversi ke integer untuk keamanan
            if ($id > 0) { // Pastikan ID valid
                Anggota::delete($id);
            }
        }
        header("Location: ?controller=anggota");
        exit();
    }
} 