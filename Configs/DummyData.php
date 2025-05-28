<?php
/**
 * Kelas DummyData untuk menyimpan data dummy
 * 
 * Kelas ini menyediakan data dummy untuk pengembangan tanpa database.
 * Data disimpan dalam file JSON dan dapat diakses melalui method-method yang tersedia.
 * 
 * @package Perpustakaan
 * @version 1.0
 */
class DummyData {
    private static $dataFile = 'Configs/data.json';
    private static $bukuList = [];
    private static $anggotaList = [];
    private static $lastBukuId = 0;
    private static $lastAnggotaId = 0;

    /**
     * Memuat data dari file
     */
    private static function loadData() {
        if (file_exists(self::$dataFile)) {
            $data = json_decode(file_get_contents(self::$dataFile), true);
            self::$bukuList = $data['buku'] ?? [];
            self::$anggotaList = $data['anggota'] ?? [];
            self::$lastBukuId = $data['lastBukuId'] ?? 0;
            self::$lastAnggotaId = $data['lastAnggotaId'] ?? 0;
        } else {
            // Data awal jika file belum ada
            self::$bukuList = [
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
            self::$lastBukuId = 3;

            self::$anggotaList = [
                [
                    'id' => 1,
                    'nama' => 'John Doe',
                    'email' => 'john@example.com',
                    'telepon' => '08123456789'
                ],
                [
                    'id' => 2,
                    'nama' => 'Jane Smith',
                    'email' => 'jane@example.com',
                    'telepon' => '08987654321'
                ]
            ];
            self::$lastAnggotaId = 2;

            self::saveData();
        }
    }

    /**
     * Menyimpan data ke file
     */
    private static function saveData() {
        $data = [
            'buku' => self::$bukuList,
            'anggota' => self::$anggotaList,
            'lastBukuId' => self::$lastBukuId,
            'lastAnggotaId' => self::$lastAnggotaId
        ];
        file_put_contents(self::$dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }

    /**
     * Mengambil semua data buku
     * 
     * @return array Array berisi data buku
     */
    public static function getAllBuku() {
        self::loadData();
        return self::$bukuList;
    }

    /**
     * Mencari buku berdasarkan ID
     * 
     * @param int $id ID buku yang dicari
     * @return array|null Data buku jika ditemukan, null jika tidak ditemukan
     */
    public static function findBuku($id) {
        self::loadData();
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
        self::loadData();
        self::$lastBukuId++;
        $buku = [
            'id' => self::$lastBukuId,
            'judul' => $judul,
            'pengarang' => $pengarang
        ];
        self::$bukuList[] = $buku;
        self::saveData();
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
        self::loadData();
        foreach (self::$bukuList as &$buku) {
            if ($buku['id'] == $id) {
                $buku['judul'] = $judul;
                $buku['pengarang'] = $pengarang;
                self::saveData();
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
        self::loadData();
        foreach (self::$bukuList as $key => $buku) {
            if ($buku['id'] == $id) {
                unset(self::$bukuList[$key]);
                self::$bukuList = array_values(self::$bukuList);
                self::saveData();
                return true;
            }
        }
        return false;
    }

    /**
     * Mengambil semua data anggota
     * 
     * @return array Array berisi data anggota
     */
    public static function getAllAnggota() {
        self::loadData();
        return self::$anggotaList;
    }

    /**
     * Mencari anggota berdasarkan ID
     * 
     * @param int $id ID anggota yang dicari
     * @return array|null Data anggota jika ditemukan, null jika tidak ditemukan
     */
    public static function findAnggota($id) {
        self::loadData();
        foreach (self::$anggotaList as $anggota) {
            if ($anggota['id'] == $id) {
                return $anggota;
            }
        }
        return null;
    }

    /**
     * Menambah anggota baru
     * 
     * @param string $nama Nama anggota
     * @param string $email Email anggota
     * @param string $telepon Telepon anggota
     * @return array Data anggota yang baru ditambahkan
     */
    public static function addAnggota($nama, $email, $telepon) {
        self::loadData();
        self::$lastAnggotaId++;
        $anggota = [
            'id' => self::$lastAnggotaId,
            'nama' => $nama,
            'email' => $email,
            'telepon' => $telepon
        ];
        self::$anggotaList[] = $anggota;
        self::saveData();
        return $anggota;
    }

    /**
     * Memperbarui data anggota
     * 
     * @param int $id ID anggota yang akan diupdate
     * @param string $nama Nama anggota baru
     * @param string $email Email anggota baru
     * @param string $telepon Telepon anggota baru
     * @return bool true jika berhasil, false jika anggota tidak ditemukan
     */
    public static function updateAnggota($id, $nama, $email, $telepon) {
        self::loadData();
        foreach (self::$anggotaList as &$anggota) {
            if ($anggota['id'] == $id) {
                $anggota['nama'] = $nama;
                $anggota['email'] = $email;
                $anggota['telepon'] = $telepon;
                self::saveData();
                return true;
            }
        }
        return false;
    }

    /**
     * Menghapus anggota
     * 
     * @param int $id ID anggota yang akan dihapus
     * @return bool true jika berhasil, false jika anggota tidak ditemukan
     */
    public static function deleteAnggota($id) {
        self::loadData();
        foreach (self::$anggotaList as $key => $anggota) {
            if ($anggota['id'] == $id) {
                unset(self::$anggotaList[$key]);
                self::$anggotaList = array_values(self::$anggotaList);
                self::saveData();
                return true;
            }
        }
        return false;
    }
} 