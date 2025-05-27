<?php
require_once 'Configs/database.php';

/**
 * Model untuk mengelola data buku
 * Berisi method-method untuk operasi database terkait buku
 */
class Buku {
    /** @var int|null ID buku */
    public $id;
    /** @var string|null Judul buku */
    public $judul;
    /** @var string|null Nama pengarang buku */
    public $pengarang;

    /**
     * Constructor untuk membuat instance buku
     * @param int|null $id ID buku
     * @param string|null $judul Judul buku
     * @param string|null $pengarang Nama pengarang buku
     */
    public function __construct($id = null, $judul = null, $pengarang = null) {
        $this->id = $id;
        $this->judul = $judul;
        $this->pengarang = $pengarang;
    }

    /**
     * Mengambil semua data buku dari database
     * @return array Array berisi objek Buku
     */
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

    /**
     * Mencari buku berdasarkan ID
     * @param int $id ID buku yang dicari
     * @return Buku|null Objek Buku jika ditemukan, null jika tidak ditemukan
     */
    public static function find($id) {
        $pdo = Database::connect();
        $query = "SELECT * FROM buku WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Buku($row['id'], $row['judul'], $row['pengarang']);
        }
        return null;
    }

    /**
     * Menyimpan data buku baru ke database
     * Method ini akan membuat record baru di tabel buku
     */
    public function save() {
        $pdo = Database::connect();
        $query = "INSERT INTO buku (judul, pengarang) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->judul, $this->pengarang]);
    }

    /**
     * Memperbarui data buku di database
     * Method ini akan mengupdate record yang sudah ada di tabel buku
     */
    public function update() {
        $pdo = Database::connect();
        $query = "UPDATE buku SET judul = ?, pengarang = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->judul, $this->pengarang, $this->id]);
    }

    /**
     * Menghapus buku dari database
     * @param int $id ID buku yang akan dihapus
     */
    public static function delete($id) {
        $pdo = Database::connect();
        $query = "DELETE FROM buku WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
    }
}