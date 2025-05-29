<?php
require_once 'Configs/Database.php';

/**
 * Model untuk mengelola data kategori
 * 
 * Model ini menangani operasi CRUD untuk tabel kategori dengan kolom:
 * - id_kategori (INT, PRIMARY KEY)
 * - nama_kategori (VARCHAR)
 * 
 * @package Perpustakaan
 * @version 1.0
 */
class Kategori {
    private $conn;
    private $table = 'kategori';

    /** @var int|null ID kategori */
    public $id_kategori;
    /** @var string|null Nama kategori */
    public $nama_kategori;

    /**
     * Constructor untuk membuat instance kategori
     * @param int|null $id_kategori ID kategori
     * @param string|null $nama_kategori Nama kategori
     */
    public function __construct($id_kategori = null, $nama_kategori = null) {
        $database = new Database();
        $this->conn = $database->getConnection();
        
        $this->id_kategori = $id_kategori;
        $this->nama_kategori = $nama_kategori;
    }

    /**
     * Mengambil semua data kategori
     * @return PDOStatement Statement yang berisi semua data kategori
     */
    public function getAllKategori() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nama_kategori ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Mencari kategori berdasarkan ID
     * @param int $id ID kategori yang dicari
     * @return PDOStatement Statement yang berisi data kategori
     */
    public function getKategoriById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_kategori = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Menyimpan data kategori baru
     * @return bool true jika berhasil disimpan, false jika gagal
     */
    public function createKategori() {
        $query = "INSERT INTO " . $this->table . " (nama_kategori) VALUES (:nama_kategori)";
        $stmt = $this->conn->prepare($query);
        
        // Sanitasi input
        $this->nama_kategori = htmlspecialchars(strip_tags($this->nama_kategori));
        
        // Bind parameter
        $stmt->bindParam(":nama_kategori", $this->nama_kategori);
        
        return $stmt->execute();
    }

    /**
     * Memperbarui data kategori
     * @return bool true jika berhasil diupdate, false jika gagal
     */
    public function updateKategori() {
        $query = "UPDATE " . $this->table . " 
                 SET nama_kategori = :nama_kategori 
                 WHERE id_kategori = :id";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitasi input
        $this->nama_kategori = htmlspecialchars(strip_tags($this->nama_kategori));
        $this->id_kategori = htmlspecialchars(strip_tags($this->id_kategori));
        
        // Bind parameter
        $stmt->bindParam(":nama_kategori", $this->nama_kategori);
        $stmt->bindParam(":id", $this->id_kategori);
        
        return $stmt->execute();
    }

    /**
     * Menghapus kategori
     * @param int $id ID kategori yang akan dihapus
     * @return bool true jika berhasil dihapus, false jika gagal
     */
    public function deleteKategori($id) {
        // Cek apakah kategori masih digunakan di tabel buku
        $checkQuery = "SELECT COUNT(*) as total FROM buku WHERE id_kategori = :id";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindParam(":id", $id);
        $checkStmt->execute();
        $result = $checkStmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result['total'] > 0) {
            return false; // Kategori masih digunakan, tidak bisa dihapus
        }
        
        $query = "DELETE FROM " . $this->table . " WHERE id_kategori = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
} 