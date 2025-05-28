<?php

class BerandaController {
    public function index() {
        $title = 'Beranda - Perpustakaan';
        ob_start();
        include 'Views/Beranda/index.php';
        $content = ob_get_clean();
        include 'Views/layouts/main.php';
    }
} 