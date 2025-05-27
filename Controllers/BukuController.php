<?php
require_once 'Models/Buku.php';

class BukuController {
    public function index() {
        $bukuList = Buku::all();
        include 'Views/Buku/list.php';
    }

    public function create() {
        include 'Views/Buku/form.php';
    }

    public function store($data) {
        $buku = new Buku(null, $data['judul'], $data['pengarang']);
        $buku->save();
        header("Location: index.php");
    }
}