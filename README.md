# Sistem Perpustakaan MVC

Sistem manajemen perpustakaan berbasis web yang dibangun menggunakan arsitektur MVC (Model-View-Controller) dengan PHP dan database MySQL.

## Deskripsi

Aplikasi ini memungkinkan pengguna untuk mengelola data buku, kategori, siswa, dan peminjaman buku dengan fitur CRUD (Create, Read, Update, Delete). Sistem ini menggunakan database MySQL untuk penyimpanan data dan menerapkan pemisahan logika bisnis, tampilan, dan kontrol data dengan pola MVC.

## Fitur

- [x] Halaman beranda dengan navigasi
- [x] Manajemen buku (CRUD)
- [x] Manajemen kategori (CRUD)
- [x] Manajemen siswa (CRUD)
- [x] Manajemen peminjaman buku (CRUD)
- [x] Layout responsif dengan navbar
- [x] Validasi input
- [x] Relasi antar data (buku, kategori, siswa, peminjaman)
- [x] Format tanggal otomatis

## Struktur Proyek

```
perpustakaan-mvc/
├── Configs/
│   └── Database.php         # Konfigurasi koneksi database MySQL
├── Controllers/
│   ├── BerandaController.php    # Controller halaman beranda
│   ├── BukuController.php       # Controller buku
│   ├── KategoriController.php   # Controller kategori
│   ├── SiswaController.php      # Controller siswa
│   └── PeminjamanController.php # Controller peminjaman
├── Models/
│   ├── Buku.php            # Model buku
│   ├── Kategori.php        # Model kategori
│   ├── Siswa.php           # Model siswa
│   └── Peminjaman.php      # Model peminjaman
├── Views/
│   ├── layouts/
│   │   └── main.php        # Layout utama dengan navbar
│   ├── Beranda/
│   │   └── index.php       # View halaman beranda
│   ├── Buku/
│   │   ├── list.php        # View daftar buku
│   │   └── form.php        # View form tambah/edit buku
│   ├── Kategori/
│   │   ├── list.php        # View daftar kategori
│   │   └── form.php        # View form tambah/edit kategori
│   ├── Siswa/
│   │   ├── list.php        # View daftar siswa
│   │   └── form.php        # View form tambah/edit siswa
│   └── Peminjaman/
│       ├── list.php        # View daftar peminjaman
│       └── form.php        # View form tambah/edit peminjaman
└── index.php               # Entry point aplikasi
```

## Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL/MariaDB
- Web server (Apache/Nginx)
- XAMPP (direkomendasikan untuk development)

## Instalasi

1. **Clone repositori ini ke direktori web server Anda:**
   ```bash
   git clone [url-repositori]
   ```

2. **Buat database MySQL:**
   ```sql
   CREATE DATABASE perpustakaan;
   ```

3. **Import struktur tabel:**
   Buat tabel `buku`, `kategori`, `siswa`, dan `peminjaman` sesuai kebutuhan. Contoh:
   ```sql
   CREATE TABLE kategori (
     id_kategori INT AUTO_INCREMENT PRIMARY KEY,
     nama_kategori VARCHAR(100) NOT NULL
   );
   CREATE TABLE buku (
     id_buku INT AUTO_INCREMENT PRIMARY KEY,
     id_kategori INT,
     nama_buku VARCHAR(100) NOT NULL,
     pengarang VARCHAR(100),
     genre VARCHAR(50),
     FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
   );
   CREATE TABLE siswa (
     id_siswa INT AUTO_INCREMENT PRIMARY KEY,
     nama_siswa VARCHAR(100) NOT NULL,
     kelas_siswa VARCHAR(20),
     jurusan VARCHAR(50),
     email VARCHAR(100)
   );
   CREATE TABLE peminjaman (
     id_peminjaman INT AUTO_INCREMENT PRIMARY KEY,
     id_siswa INT,
     id_buku INT,
     tanggal_peminjaman DATE,
     tanggal_pengembalian DATE,
     status VARCHAR(20),
     FOREIGN KEY (id_siswa) REFERENCES siswa(id_siswa),
     FOREIGN KEY (id_buku) REFERENCES buku(id_buku)
   );
   ```

4. **Konfigurasi koneksi database:**
   - Edit file `Configs/Database.php` dan sesuaikan host, username, password, dan nama database.

5. **Jalankan aplikasi melalui browser:**
   ```
   http://localhost/perpustakaan-mvc
   ```

## Penggunaan

- Navigasi melalui menu di navbar untuk mengelola buku, kategori, siswa, dan peminjaman.
- Gunakan tombol "Tambah" untuk menambah data baru.
- Gunakan tombol "Edit" dan "Hapus" untuk mengelola data yang ada.
- Tanggal otomatis diformat sesuai kebutuhan.

## Struktur MVC

### Model (Models/)
- Menangani logika data dan operasi CRUD ke database
- Setiap entitas (Buku, Kategori, Siswa, Peminjaman) memiliki model sendiri

### View (Views/)
- Menampilkan antarmuka pengguna
- Terdiri dari layout utama dan view spesifik untuk setiap fitur
- Menggunakan PHP untuk menampilkan data dinamis

### Controller (Controllers/)
- Menangani request dari user
- Mengkoordinasikan antara Model dan View
- Memproses data sebelum ditampilkan/disimpan

## Pengembangan

Untuk menambah fitur baru:
1. Tambahkan method di Model jika diperlukan
2. Buat View baru jika diperlukan
3. Tambahkan method di Controller
4. Update routing di index.php

## Kontribusi

1. Fork repositori
2. Buat branch fitur baru
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## Kontak

Jika ada pertanyaan atau saran, silakan buat issue di repositori ini. 