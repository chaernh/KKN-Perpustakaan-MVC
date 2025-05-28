<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?? 'Perpustakaan' ?></title>
    <style>
        .navbar {
            background-color: #333;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-right: 1rem;
        }
        .navbar a:hover {
            color: #ddd;
        }
        .container {
            padding: 0 1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="?controller=beranda">Beranda</a>
        <a href="?controller=buku">Daftar Buku</a>
    </nav>
    
    <div class="container">
        <?= $content ?>
    </div>
</body>
</html> 