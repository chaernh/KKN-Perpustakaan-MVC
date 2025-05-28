<?php
/**
 * Kelas DummyData untuk menyimpan data dummy
 * 
 * Kelas ini menyediakan data dummy untuk pengembangan tanpa database.
 * Data disimpan dalam array statis dan dapat diakses melalui method-method yang tersedia.
 * 
 * @package Perpustakaan
 * @version 1.0
 */
class DummyData {
    /**
     * Array untuk menyimpan data buku
     * @var array
     */
    private static $bukuList = [
        [
            'id' => 1,
            'judul' => 'Laskar Pelangi',
            'pengarang' => 'Andrea Hirata'
        ],
        [
            'id' => 2,
            'judul' => 'Bumi Manusia',
            'pengarang' => 'Pramoedya Ananta Toer'
        ],
        [
            'id' => 3,
            'judul' => 'Filosofi Teras',
            'pengarang' => 'Henry Manampiring'
        ]
    ];

    /**
     * ID terakhir yang digunakan
     * @var int
     */
    private static $lastId = 3;

    /**
     * Mengambil semua data buku
     * 
     * @return array Array berisi data buku
     */
    public static function getAllBuku() {
        return self::$bukuList;
    }

    /**
     * Mencari buku berdasarkan ID
     * 
     * @param int $id ID buku yang dicari
     * @return array|null Data buku jika ditemukan, null jika tidak ditemukan
     */
    public static function findBuku($id) {
        foreach (self::$bukuList as $buku) {
            if ($buku['id'] == $id) {
                return $buku;
            }
        }
        return null;
    }

    /**
     * Menambah buku baru
     * 
     * @param string $judul Judul buku
     * @param string $pengarang Nama pengarang
     * @return array Data buku yang baru ditambahkan
     */
    public static function addBuku($judul, $pengarang) {
        self::$lastId++;
        $buku = [
            'id' => self::$lastId,
            'judul' => $judul,
            'pengarang' => $pengarang
        ];
        self::$bukuList[] = $buku;
        return $buku;
    }

    /**
     * Memperbarui data buku
     * 
     * @param int $id ID buku yang akan diupdate
     * @param string $judul Judul buku baru
     * @param string $pengarang Nama pengarang baru
     * @return bool true jika berhasil, false jika buku tidak ditemukan
     */
    public static function updateBuku($id, $judul, $pengarang) {
        foreach (self::$bukuList as &$buku) {
            if ($buku['id'] == $id) {
                $buku['judul'] = $judul;
                $buku['pengarang'] = $pengarang;
                return true;
            }
        }
        return false;
    }

    /**
     * Menghapus buku
     * 
     * @param int $id ID buku yang akan dihapus
     * @return bool true jika berhasil, false jika buku tidak ditemukan
     */
    public static function deleteBuku($id) {
        foreach (self::$bukuList as $key => $buku) {
            if ($buku['id'] == $id) {
                unset(self::$bukuList[$key]);
                self::$bukuList = array_values(self::$bukuList); // Reindex array
                return true;
            }
        }
        return false;
    }
} 