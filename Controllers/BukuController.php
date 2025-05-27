<?php
require_once 'Models/Buku.php';

class BukuController {
    public function index() {
        $bukuList = Buku::all();
        include 'Views/buku_list.php';
    }

    public function create() {
        include 'Views/buku_form.php';
    }

    public function store($data) {
        $buku = new Buku(null, $data['judul'], $data['pengarang']);
        $buku->save();
        header("Location: index.php");
    }
}