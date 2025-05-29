<?php
require_once 'Configs/Database.php';

/**
 * Model untuk mengelola data buku
 * 
 * Model ini menangani operasi CRUD untuk tabel buku dengan kolom:
 * - id_buku (INT, PRIMARY KEY)
 * - id_kategori (INT, FOREIGN KEY)
 * - nama_buku (VARCHAR)
 * - pengarang (VARCHAR)
 * - genre (VARCHAR)
 * 
 * @package Perpustakaan
 * @version 1.0
 */
class Buku {
    private $conn;
    private $table = 'buku';

    /** @var int|null ID buku */
    public $id_buku;
    /** @var int|null ID kategori */
    public $id_kategori;
    /** @var string|null Nama buku */
    public $nama_buku;
    /** @var string|null Nama pengarang buku */
    public $pengarang;
    /** @var string|null Genre buku */
    public $genre;

    /**
     * Constructor untuk membuat instance buku
     * @param int|null $id_buku ID buku
     * @param int|null $id_kategori ID kategori
     * @param string|null $nama_buku Nama buku
     * @param string|null $pengarang Nama pengarang buku
     * @param string|null $genre Genre buku
     */
    public function __construct($id_buku = null, $id_kategori = null, $nama_buku = null, $pengarang = null, $genre = null) {
        $database = new Database();
        $this->conn = $database->getConnection();
        
        $this->id_buku = $id_buku;
        $this->id_kategori = $id_kategori;
        $this->nama_buku = $nama_buku;
        $this->pengarang = $pengarang;
        $this->genre = $genre;
    }

    /**
     * Mengambil semua data buku
     * @return PDOStatement Statement yang berisi semua data buku
     */
    public function getAllBuku() {
        $query = "SELECT b.*, k.nama_kategori as 'NAMA_KATEGORI'
                 FROM " . $this->table . " b
                 LEFT JOIN kategori k ON b.id_kategori = k.id_kategori";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Mencari buku berdasarkan ID
     * @param int $id ID buku yang dicari
     * @return PDOStatement Statement yang berisi data buku
     */
    public function getBukuById($id) {
        $query = "SELECT b.*, k.nama_kategori as 'NAMA_KATEGORI'
                 FROM " . $this->table . " b
                 LEFT JOIN kategori k ON b.id_kategori = k.id_kategori
                 WHERE b.id_buku = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Menyimpan data buku baru
     * @return bool true jika berhasil disimpan, false jika gagal
     */
    public function createBuku() {
        $query = "INSERT INTO " . $this->table . " 
                 (id_kategori, nama_buku, pengarang, genre) 
                 VALUES (:id_kategori, :nama_buku, :pengarang, :genre)";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitasi input
        $this->id_kategori = htmlspecialchars(strip_tags($this->id_kategori));
        $this->nama_buku = htmlspecialchars(strip_tags($this->nama_buku));
        $this->pengarang = htmlspecialchars(strip_tags($this->pengarang));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        
        // Bind parameter
        $stmt->bindParam(":id_kategori", $this->id_kategori);
        $stmt->bindParam(":nama_buku", $this->nama_buku);
        $stmt->bindParam(":pengarang", $this->pengarang);
        $stmt->bindParam(":genre", $this->genre);
        
        return $stmt->execute();
    }

    /**
     * Memperbarui data buku
     * @return bool true jika berhasil diupdate, false jika gagal
     */
    public function updateBuku() {
        $query = "UPDATE " . $this->table . " 
                 SET id_kategori = :id_kategori,
                     nama_buku = :nama_buku,
                     pengarang = :pengarang,
                     genre = :genre
                 WHERE id_buku = :id";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitasi input
        $this->id_kategori = htmlspecialchars(strip_tags($this->id_kategori));
        $this->nama_buku = htmlspecialchars(strip_tags($this->nama_buku));
        $this->pengarang = htmlspecialchars(strip_tags($this->pengarang));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->id_buku = htmlspecialchars(strip_tags($this->id_buku));
        
        // Bind parameter
        $stmt->bindParam(":id_kategori", $this->id_kategori);
        $stmt->bindParam(":nama_buku", $this->nama_buku);
        $stmt->bindParam(":pengarang", $this->pengarang);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":id", $this->id_buku);
        
        return $stmt->execute();
    }

    /**
     * Menghapus buku
     * @param int $id ID buku yang akan dihapus
     * @return bool true jika berhasil dihapus, false jika gagal
     */
    public function deleteBuku($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_buku = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}