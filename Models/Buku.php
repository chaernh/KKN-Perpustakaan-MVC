<?php
require_once 'Configs/database.php';

class Buku {
    public $id;
    public $judul;
    public $pengarang;

    public function __construct($id = null, $judul = null, $pengarang = null) {
        $this->id = $id;
        $this->judul = $judul;
        $this->pengarang = $pengarang;
    }

    public static function all() {
        $pdo = Database::connect();
				$query = "SELECT * FROM buku";
        $stmt = $pdo->query($query);
        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Buku($row['id'], $row['judul'], $row['pengarang']);
        }
        return $result;
    }

    public function save() {
        $pdo = Database::connect();
				$query = "INSERT INTO buku (judul, pengarang) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->judul, $this->pengarang]);
    }
}