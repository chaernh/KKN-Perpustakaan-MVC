<?php
require_once 'Configs/DummyData.php';

/**
 * Model untuk mengelola data buku
 * 
 * Model ini menggunakan DummyData untuk operasi CRUD buku.
 * Semua operasi database digantikan dengan operasi pada array di DummyData.
 * 
 * @package Perpustakaan
 * @version 1.0
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
     * Mengambil semua data buku dari DummyData
     * @return array Array berisi objek Buku
     */
    public static function all() {
        $result = [];
        foreach (DummyData::getAllBuku() as $buku) {
            $result[] = new Buku($buku['id'], $buku['judul'], $buku['pengarang']);
        }
        return $result;
    }

    /**
     * Mencari buku berdasarkan ID
     * @param int $id ID buku yang dicari
     * @return Buku|null Objek Buku jika ditemukan, null jika tidak ditemukan
     */
    public static function find($id) {
        $buku = DummyData::findBuku($id);
        if ($buku) {
            return new Buku($buku['id'], $buku['judul'], $buku['pengarang']);
        }
        return null;
    }

    /**
     * Menyimpan data buku baru ke DummyData
     * Method ini akan membuat record baru di DummyData
     */
    public function save() {
        DummyData::addBuku($this->judul, $this->pengarang);
    }

    /**
     * Memperbarui data buku di DummyData
     * Method ini akan mengupdate record yang sudah ada di DummyData
     */
    public function update() {
        DummyData::updateBuku($this->id, $this->judul, $this->pengarang);
    }

    /**
     * Menghapus buku dari DummyData
     * @param int $id ID buku yang akan dihapus
     */
    public static function delete($id) {
        DummyData::deleteBuku($id);
    }
}