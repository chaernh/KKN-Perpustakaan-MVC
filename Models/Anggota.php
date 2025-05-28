<?php
require_once 'Configs/DummyData.php';

/**
 * Model untuk mengelola data anggota
 * 
 * Model ini menggunakan DummyData untuk operasi CRUD anggota.
 * Semua operasi database digantikan dengan operasi pada array di DummyData.
 * 
 * @package Perpustakaan
 * @version 1.0
 */
class Anggota {
    /** @var int|null ID anggota */
    public $id;
    /** @var string|null Nama anggota */
    public $nama;
    /** @var string|null Email anggota */
    public $email;
    /** @var string|null Telepon anggota */
    public $telepon;

    /**
     * Constructor untuk membuat instance anggota
     * @param int|null $id ID anggota
     * @param string|null $nama Nama anggota
     * @param string|null $email Email anggota
     * @param string|null $telepon Telepon anggota
     */
    public function __construct($id = null, $nama = null, $email = null, $telepon = null) {
        $this->id = $id;
        $this->nama = $nama;
        $this->email = $email;
        $this->telepon = $telepon;
    }

    /**
     * Mengambil semua data anggota dari DummyData
     * @return array Array berisi objek Anggota
     */
    public static function all() {
        $result = [];
        foreach (DummyData::getAllAnggota() as $anggota) {
            $result[] = new Anggota(
                $anggota['id'],
                $anggota['nama'],
                $anggota['email'],
                $anggota['telepon']
            );
        }
        return $result;
    }

    /**
     * Mencari anggota berdasarkan ID
     * @param int $id ID anggota yang dicari
     * @return Anggota|null Objek Anggota jika ditemukan, null jika tidak ditemukan
     */
    public static function find($id) {
        $anggota = DummyData::findAnggota($id);
        if ($anggota) {
            return new Anggota(
                $anggota['id'],
                $anggota['nama'],
                $anggota['email'],
                $anggota['telepon']
            );
        }
        return null;
    }

    /**
     * Menyimpan data anggota baru ke DummyData
     * Method ini akan membuat record baru di DummyData
     */
    public function save() {
        DummyData::addAnggota($this->nama, $this->email, $this->telepon);
    }

    /**
     * Memperbarui data anggota di DummyData
     * Method ini akan mengupdate record yang sudah ada di DummyData
     */
    public function update() {
        DummyData::updateAnggota($this->id, $this->nama, $this->email, $this->telepon);
    }

    /**
     * Menghapus anggota dari DummyData
     * @param int $id ID anggota yang akan dihapus
     * @return bool true jika berhasil dihapus, false jika gagal
     */
    public static function delete($id) {
        return DummyData::deleteAnggota($id);
    }
} 