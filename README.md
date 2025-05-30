# Sistem Perpustakaan MVC

Sistem manajemen perpustakaan sederhana yang dibangun menggunakan arsitektur MVC (Model-View-Controller) dengan PHP.

## Deskripsi

Sistem ini memungkinkan pengguna untuk mengelola data buku dan anggota perpustakaan dengan fitur CRUD (Create, Read, Update, Delete). Dibangun menggunakan pendekatan MVC untuk memisahkan logika bisnis, tampilan, dan kontrol data. Sistem ini menggunakan data dummy untuk memudahkan pengembangan tanpa memerlukan database.

## Fitur

- [x] Halaman beranda dengan navigasi
- [x] Manajemen buku (CRUD)
  - Melihat daftar buku
  - Menambah buku baru
  - Mengedit data buku
  - Menghapus buku
- [x] Manajemen anggota (CRUD)
  - Melihat daftar anggota
  - Menambah anggota baru
  - Mengedit data anggota
  - Menghapus anggota
- [x] Layout responsif dengan navbar
- [x] Validasi input
- [x] Data dummy untuk pengembangan

## Struktur Proyek

```
perpustakaan-mvc/
├── Configs/
│   └── DummyData.php     # Data dummy untuk pengembangan
├── Controllers/
│   ├── BerandaController.php # Controller untuk halaman beranda
│   ├── BukuController.php    # Controller untuk operasi buku
│   └── AnggotaController.php # Controller untuk operasi anggota
├── Models/
│   ├── Buku.php          # Model untuk operasi data buku
│   └── Anggota.php       # Model untuk operasi data anggota
├── Views/
│   ├── layouts/
│   │   └── main.php      # Layout utama dengan navbar
│   ├── Beranda/
│   │   └── index.php     # View halaman beranda
│   ├── Buku/
│   │   ├── list.php      # View daftar buku
│   │   └── form.php      # View form tambah/edit buku
│   └── Anggota/
│       ├── list.php      # View daftar anggota
│       └── form.php      # View form tambah/edit anggota
└── index.php             # Entry point aplikasi
```

## Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- Web server (Apache/Nginx)
- XAMPP (direkomendasikan untuk development)

## Instalasi

1. Clone repositori ini ke direktori web server Anda:
   ```bash
   git clone [url-repositori]
   ```

2. Buka aplikasi melalui browser:
   ```
   http://localhost/perpustakaan-mvc
   ```

## Penggunaan

1. Buka aplikasi melalui browser:
   ```
   http://localhost/perpustakaan-mvc
   ```

2. Navigasi:
   - Klik "Beranda" untuk kembali ke halaman utama
   - Klik "Daftar Buku" untuk melihat dan mengelola buku
   - Klik "Daftar Anggota" untuk melihat dan mengelola anggota
   - Gunakan tombol "Tambah" untuk menambah data baru
   - Gunakan tombol "Edit" dan "Hapus" untuk mengelola data yang ada

## Struktur MVC

### Model (Models/)
- Menangani logika data
- Berisi method untuk CRUD operasi
- Menggunakan DummyData untuk penyimpanan data

### View (Views/)
- Menampilkan antarmuka pengguna
- Terdiri dari layout utama dan view spesifik
- Menggunakan PHP untuk menampilkan data dinamis

### Controller (Controllers/)
- Menangani request dari user
- Mengkoordinasikan antara Model dan View
- Memproses data sebelum ditampilkan/disimpan

## Data Dummy

Sistem menggunakan data dummy yang disimpan di `Configs/DummyData.php`. Data ini mencakup:
- Daftar buku dan anggota awal
- Method untuk operasi CRUD
- Manajemen ID otomatis

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