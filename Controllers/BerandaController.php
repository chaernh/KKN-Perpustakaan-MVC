<?php
/**
 * Controller untuk mengelola halaman beranda
 * 
 * Controller ini menangani tampilan halaman utama aplikasi perpustakaan.
 * Berisi method untuk menampilkan halaman beranda dengan layout utama.
 */
class BerandaController {
    /**
     * Menampilkan halaman beranda
     * 
     * Method ini akan:
     * 1. Mengatur judul halaman
     * 2. Mengambil konten dari view beranda
     * 3. Menampilkan konten dalam layout utama
     */
    public function index() {
        $title = 'Beranda - Perpustakaan';
        ob_start();
        include 'Views/Beranda/index.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }
} 