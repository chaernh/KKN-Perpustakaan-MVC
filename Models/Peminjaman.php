<?php
require_once 'Configs/Database.php';

/**
 * Model untuk mengelola data peminjaman
 * 
 * Model ini menangani operasi CRUD untuk tabel peminjaman dengan kolom:
 * - id_peminjaman (INT, PRIMARY KEY)
 * - id_siswa (INT)
 * - id_buku (INT)
 * - tanggal_peminjaman (DATE)
 * - tanggal_pengembalian (DATE)
 * 
 * @package Perpustakaan
 * @version 1.0
 */
class Peminjaman {
    private $conn;
    private $table = 'peminjaman';

    /** @var int|null ID peminjaman */
    public $id_peminjaman;
    /** @var int|null ID siswa */
    public $id_siswa;
    /** @var int|null ID buku */
    public $id_buku;
    /** @var string|null Tanggal peminjaman */
    public $tanggal_peminjaman;
    /** @var string|null Tanggal pengembalian */
    public $tanggal_pengembalian;
    /** @var string|null Status peminjaman */

    /**
     * Constructor untuk membuat instance peminjaman
     * @param int|null $id_peminjaman ID peminjaman
     * @param int|null $id_siswa ID siswa
     * @param int|null $id_buku ID buku
     * @param string|null $tanggal_peminjaman Tanggal peminjaman
     * @param string|null $tanggal_pengembalian Tanggal pengembalian
     * @param string|null $status Status peminjaman
     */
    public function __construct($id_peminjaman = null, $id_siswa = null, $id_buku = null, $tanggal_peminjaman = null, $tanggal_pengembalian = null, $status = null) {
        $database = new Database();
        $this->conn = $database->getConnection();
        
        $this->id_peminjaman = $id_peminjaman;
        $this->id_siswa = $id_siswa;
        $this->id_buku = $id_buku;
        $this->tanggal_peminjaman = $tanggal_peminjaman;
        $this->tanggal_pengembalian = $tanggal_pengembalian;
				$this->status = $status;
    }

    /**
     * Mengambil semua data peminjaman
     * @return PDOStatement Statement yang berisi semua data peminjaman
     */
    public function getAllPeminjaman() {
        $query = "SELECT
										p.ID_PEMINJAMAN,
										s.NAMA_SISWA as NAMA_PEMINJAM,
										b.NAMA_BUKU,
										k.NAMA_KATEGORI as NAMA_KATEGORI_BUKU,
										p.TANGGAL_PEMINJAMAN,
										p.TANGGAL_PENGEMBALIAN,
										DATE_FORMAT(p.TANGGAL_PEMINJAMAN, '%e %M %Y') AS TANGGAL_PEMINJAMAN,
										DATE_FORMAT(p.TANGGAL_PENGEMBALIAN, '%e %M %Y') AS TANGGAL_PENGEMBALIAN,
										p.STATUS
									FROM
										" . $this->table . " p
									LEFT JOIN buku b ON p.ID_BUKU = b.ID_BUKU
									LEFT JOIN kategori k ON b.ID_KATEGORI = k.ID_KATEGORI
									LEFT JOIN siswa s ON p.ID_SISWA = s.ID_SISWA
									ORDER BY p.TANGGAL_PEMINJAMAN, p.TANGGAL_PENGEMBALIAN DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Mencari peminjaman berdasarkan ID
     * @param int $id ID peminjaman yang dicari
     * @return PDOStatement Statement yang berisi data peminjaman
     */
    public function getPeminjamanById($id) {
			$query = "select
									p.ID_PEMINJAMAN,
									s.ID_SISWA,
									s.NAMA_SISWA as NAMA_PEMINJAM,
									b.ID_BUKU,
									b.NAMA_BUKU,
									k.ID_KATEGORI,
									k.NAMA_KATEGORI as NAMA_KATEGORI_BUKU,
									p.TANGGAL_PEMINJAMAN,
									p.TANGGAL_PENGEMBALIAN,
									p.STATUS
								from
									" . $this->table . " p
								left join buku b on p.ID_BUKU = b.ID_BUKU
								left join kategori k on b.ID_KATEGORI = k.ID_KATEGORI
								left join siswa s on p.ID_SISWA = s.ID_SISWA
								where p.ID_PEMINJAMAN = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt;
    }

    /**
     * Menyimpan data peminjaman baru
     * @return bool true jika berhasil disimpan, false jika gagal
     */
    public function createPeminjaman() {
        $query = "INSERT INTO " . $this->table . " (ID_SISWA, ID_BUKU, TANGGAL_PEMINJAMAN, TANGGAL_PENGEMBALIAN, STATUS) VALUES (:id_siswa, :id_buku, :tanggal_peminjaman, :tanggal_pengembalian, :status)";
        $stmt = $this->conn->prepare($query);
        
        // Sanitasi input
        $this->id_siswa = htmlspecialchars(strip_tags($this->id_siswa));
        $this->id_buku = htmlspecialchars(strip_tags($this->id_buku));
        $this->tanggal_peminjaman = htmlspecialchars(strip_tags($this->tanggal_peminjaman));
        $this->tanggal_pengembalian = htmlspecialchars(strip_tags($this->tanggal_pengembalian));
        $this->status = htmlspecialchars(strip_tags($this->status));
        
        // Bind parameter
        $stmt->bindParam(":id_siswa", $this->id_siswa);
        $stmt->bindParam(":id_buku", $this->id_buku);
				$stmt->bindParam(":tanggal_peminjaman", $this->tanggal_peminjaman);
				$stmt->bindParam(":tanggal_pengembalian", $this->tanggal_pengembalian);
				$stmt->bindParam(":status", $this->status);
        
        return $stmt->execute();
    }

    /**
     * Memperbarui data peminjaman
     * @return bool true jika berhasil diupdate, false jika gagal
     */
    public function updatePeminjaman() {
        $query = "UPDATE " . $this->table . " 
									SET ID_SISWA = :id_siswa, 
									ID_BUKU = :id_buku, 
									TANGGAL_PEMINJAMAN = :tanggal_peminjaman, 
									TANGGAL_PENGEMBALIAN = :tanggal_pengembalian, 
									STATUS = :status 
									WHERE ID_PEMINJAMAN = :id";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitasi input
        $this->id_siswa = htmlspecialchars(strip_tags($this->id_siswa));
        $this->id_buku = htmlspecialchars(strip_tags($this->id_buku));
        $this->tanggal_peminjaman = htmlspecialchars(strip_tags($this->tanggal_peminjaman));
        $this->tanggal_pengembalian = htmlspecialchars(strip_tags($this->tanggal_pengembalian));
        $this->status = htmlspecialchars(strip_tags($this->status));
        
        // Bind parameter
        $stmt->bindParam(":id_siswa", $this->id_siswa);
        $stmt->bindParam(":id_buku", $this->id_buku);
				$stmt->bindParam(":tanggal_peminjaman", $this->tanggal_peminjaman);
				$stmt->bindParam(":tanggal_pengembalian", $this->tanggal_pengembalian);
				$stmt->bindParam(":status", $this->status);
				$stmt->bindParam(":id", $this->id_peminjaman);

        return $stmt->execute();
    }

    /**
     * Menghapus peminjaman
     * @param int $id ID peminjaman yang akan dihapus
     * @return bool true jika berhasil dihapus, false jika gagal
     */
    public function deletePeminjaman($id) {
        $query = "DELETE FROM " . $this->table . " WHERE ID_PEMINJAMAN = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
} 