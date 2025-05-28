<?php
/**
 * Kelas Database untuk mengelola koneksi database
 * 
 * Kelas ini menyediakan konfigurasi dan method untuk koneksi ke database MySQL.
 * Menggunakan PDO untuk koneksi yang aman dan konsisten.
 * 
 * @package Perpustakaan
 * @author [Nama Pengembang]
 * @version 1.0
 */
class Database {
    /**
     * Host database
     * @var string
     */
    private static $host = "localhost";

    /**
     * Nama database
     * @var string
     */
    private static $db_name = "perpustakaan";

    /**
     * Username database
     * @var string
     */
    private static $username = "root";

    /**
     * Password database
     * @var string
     */
    private static $password = ""; // sesuaikan dengan password MySQL kamu

    /**
     * Membuat koneksi ke database
     * 
     * Method ini akan:
     * 1. Membuat koneksi PDO ke database
     * 2. Mengatur mode error ke exception
     * 3. Mengembalikan objek PDO jika berhasil
     * 4. Menampilkan pesan error jika gagal
     * 
     * @return PDO Objek koneksi database
     * @throws PDOException Jika koneksi gagal
     */
    public static function connect() {
        try {
            $pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Koneksi Gagal: " . $e->getMessage());
        }
    }
}