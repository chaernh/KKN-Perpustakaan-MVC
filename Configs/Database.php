<?php
/**
 * Kelas Database
 * 
 * Kelas ini menangani koneksi ke database MySQL menggunakan PDO.
 * Menggunakan pola Singleton untuk memastikan hanya ada satu instance koneksi database.
 * 
 * @package Perpustakaan
 * @author Claude
 * @version 1.0
 */
class Database {
    /**
     * @var string Host database (localhost)
     */
    private $host = "localhost";

    /**
     * @var string Username database
     */
    private $username = "root";

    /**
     * @var string Password database
     */
    private $password = "";

    /**
     * @var string Nama database
     */
    private $database = "perpustakaan";

    /**
     * @var PDO|null Instance koneksi database
     */
    private $conn;

    /**
     * Mendapatkan koneksi database
     * 
     * Method ini akan membuat koneksi baru ke database jika belum ada
     * atau mengembalikan koneksi yang sudah ada.
     * 
     * @return PDO|null Koneksi database
     * @throws PDOException Jika terjadi error saat koneksi
     */
    public function getConnection() {
        $this->conn = null;

        try {
            // Membuat koneksi PDO dengan parameter yang telah dikonfigurasi
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->database,
                $this->username,
                $this->password
            );

            // Mengatur mode error ke exception untuk penanganan error yang lebih baik
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Mengatur default fetch mode ke associative array
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            // Mengatur karakter encoding ke UTF-8
            $this->conn->exec("SET NAMES utf8");
            
        } catch(PDOException $e) {
            // Menampilkan pesan error jika koneksi gagal
            echo "Koneksi Error: " . $e->getMessage();
        }

        return $this->conn;
    }

    /**
     * Menutup koneksi database
     * 
     * Method ini digunakan untuk menutup koneksi database secara eksplisit
     * ketika sudah tidak digunakan lagi.
     */
    public function closeConnection() {
        $this->conn = null;
    }
}