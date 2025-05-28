<?php
/**
 * Layout utama aplikasi perpustakaan
 * 
 * File ini berisi template HTML dasar yang digunakan di seluruh aplikasi.
 * Layout ini menyediakan:
 * - Navbar untuk navigasi
 * - Container untuk konten
 * - Styling dasar
 * 
 * Variabel yang digunakan:
 * @var string $title Judul halaman (opsional)
 * @var string $content Konten halaman yang akan ditampilkan
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .navbar {
            background-color: #333;
            padding: 10px;
            margin-bottom: 20px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }
        .navbar a:hover {
            color: #ddd;
        }
        div {
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .btn-tambah-buku {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .btn-tambah-buku:hover {
            background-color: #45a049;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: white;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .anggota-info, .buku-info {
            flex-grow: 1;
        }
        .anggota-actions, .buku-actions {
            margin-left: 20px;
        }
        .btn-edit {
            background-color: #2196F3;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn-cancel {
            background-color: #808080;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 10px;
        }
        .btn-cancel:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="?controller=beranda">Beranda</a>
        <a href="?controller=buku">Buku</a>
        <a href="?controller=anggota">Anggota</a>
    </div>
    
    <?php echo $content; ?>
</body>
</html> 