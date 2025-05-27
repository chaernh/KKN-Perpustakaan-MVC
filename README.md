# Sistem Perpustakaan MVC

Sistem manajemen perpustakaan sederhana yang dibangun menggunakan arsitektur MVC (Model-View-Controller) dengan PHP.

## Deskripsi

Sistem ini memungkinkan pengguna untuk mengelola data buku perpustakaan dengan fitur CRUD (Create, Read, Update, Delete). Dibangun menggunakan pendekatan MVC untuk memisahkan logika bisnis, tampilan, dan kontrol data.

## Struktur Proyek

```
perpustakaan-mvc/
├── Configs/
│   └── database.php      # Konfigurasi koneksi database
├── Controllers/
│   └── BukuController.php # Controller untuk mengelola operasi buku
├── Models/
│   └── Buku.php          # Model untuk operasi data buku
├── Views/
│   └── Buku/
│       ├── list.php      # Tampilan daftar buku
│       └── form.php      # Form tambah/edit buku
└── index.php             # Entry point aplikasi
```

## Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL/MariaDB
- Web server (Apache/Nginx)
- XAMPP (direkomendasikan untuk development)

## Instalasi

1. Clone repositori ini ke direktori web server Anda:
   ```bash
   git clone [url-repositori]
   ```

2. Buat database baru di MySQL:
   ```sql
   CREATE DATABASE perpustakaan;
   ```

3. Import struktur tabel buku:
   ```sql
   CREATE TABLE buku (
       id INT AUTO_INCREMENT PRIMARY KEY,
       judul VARCHAR(255) NOT NULL,
       pengarang VARCHAR(255) NOT NULL
   );
   ```

4. Sesuaikan konfigurasi database di `Configs/database.php`:
   ```php
   private static $host = "localhost";
   private static $db_name = "perpustakaan";
   private static $username = "root";
   private static $password = ""; // sesuaikan dengan password MySQL Anda
   ```

## Penggunaan

1. Buka aplikasi melalui browser:
   ```
   http://localhost/perpustakaan-mvc
   ```

2. Fitur yang tersedia:
   - Melihat daftar buku
   - Menambah buku baru
   - Mengedit data buku
   - Menghapus buku

## Struktur MVC

### Model (Models/Buku.php)
- Menangani logika data dan operasi database
- Berisi method untuk CRUD operasi buku
- Menggunakan PDO untuk keamanan database

### View (Views/Buku/)
- Menampilkan antarmuka pengguna
- Terdiri dari form dan list view
- Menggunakan PHP untuk menampilkan data dinamis

### Controller (Controllers/BukuController.php)
- Menangani request dari user
- Mengkoordinasikan antara Model dan View
- Memproses data sebelum ditampilkan/disimpan

## Fitur

- [x] Melihat daftar buku
- [x] Menambah buku baru
- [x] Mengedit data buku
- [x] Menghapus buku
- [x] Validasi input
- [x] Proteksi SQL Injection menggunakan PDO

## Keamanan

- Menggunakan PDO untuk mencegah SQL Injection
- Validasi input pada form
- Escape output menggunakan htmlspecialchars
- Konfirmasi sebelum menghapus data

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