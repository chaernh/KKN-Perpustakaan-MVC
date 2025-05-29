<?php
require_once 'Configs/Database.php';

/**
 * Model untuk mengelola data siswa
 * 
 * Model ini menangani operasi CRUD untuk tabel siswa dengan kolom:
 * - id_siswa (INT, PRIMARY KEY)
 * - nama_siswa (VARCHAR)
 * - kelas_siswa (VARCHAR)
 * - jurusan (VARCHAR)
 * - email (VARCHAR)
 * 
 * @package Perpustakaan
 * @version 1.0
 */
class Siswa {
    private $conn;
    private $table = 'siswa';

		/** @var int|null ID siswa */
    public $id_siswa;
    /** @var string|null Nama siswa */
    public $nama_siswa;
		/** @var string|null Kelas siswa */
    public $kelas_siswa;
		/** @var string|null Jurusan */
    public $jurusan;
		/** @var string|null Email */
    public $email;

		/**
     * Constructor untuk membuat instance kategori
     * @param int|null $id_kategori ID kategori
     * @param string|null $nama_siswa Nama siswa
     * @param string|null $kelas_siswa Kelas siswa
     * @param string|null $jurusan Jurusan
     * @param string|null $email Email
     */
    public function __construct($id_siswa = null, $nama_siswa = null, $kelas_siswa = null, $jurusan = null, $email = null) {
        $database = new Database();
        $this->conn = $database->getConnection();

        $this->id_siswa = $id_siswa;
        $this->nama_siswa = $nama_siswa;
        $this->kelas_siswa = $kelas_siswa;
        $this->jurusan = $jurusan;
        $this->email = $email;
    }

		/**
     * Mengambil semua data kategori
     * @return PDOStatement Statement yang berisi semua data siswa
     */
    public function getAllSiswa() {
        $query = "SELECT * FROM $this->table ORDER BY nama_siswa ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

		/**
     * Mencari siswa berdasarkan ID
     * @param int $id ID siswa yang dicari
     * @return PDOStatement Statement yang berisi data siswa
     */
    public function getSiswaById($id) {
        $query = "SELECT * FROM $this->table WHERE id_siswa = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

		/**
     * Menyimpan data siswa baru
     * @return bool true jika berhasil disimpan, false jika gagal
     */
    public function createSiswa() {
        $query = "INSERT INTO $this->table (nama_siswa, kelas_siswa, jurusan, email) VALUES (:nama_siswa, :kelas_siswa, :jurusan, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama_siswa', $this->nama_siswa);
        $stmt->bindParam(':kelas_siswa', $this->kelas_siswa);
        $stmt->bindParam(':jurusan', $this->jurusan);
        $stmt->bindParam(':email', $this->email);
        return $stmt->execute();
    }

		/**
     * Memperbarui data siswa
     * @return bool true jika berhasil diperbarui, false jika gagal
     */
    public function updateSiswa() {
        $query = "UPDATE $this->table SET nama_siswa = :nama_siswa, kelas_siswa = :kelas_siswa, jurusan = :jurusan, email = :email WHERE id_siswa = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama_siswa', $this->nama_siswa);
        $stmt->bindParam(':kelas_siswa', $this->kelas_siswa);
        $stmt->bindParam(':jurusan', $this->jurusan);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':id', $this->id_siswa);
        return $stmt->execute();
    }

		/**
     * Menghapus data siswa
     * @param int $id ID siswa yang akan dihapus
     * @return bool true jika berhasil dihapus, false jika gagal
     */
    public function deleteSiswa($id) {
        $query = "DELETE FROM $this->table WHERE id_siswa = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
} 