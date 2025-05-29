<?php
require_once 'Controllers/BukuController.php';
require_once 'Controllers/BerandaController.php';
require_once 'Controllers/KategoriController.php';
require_once 'Controllers/SiswaController.php';
require_once 'Controllers/PeminjamanController.php';

$controller = $_GET['controller'] ?? 'beranda';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'buku':
        $controller = new BukuController();
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            $controller->index();
        }
        break;
		case 'kategori':
				$controller = new KategoriController();
				if (method_exists($controller, $action)) {
					$controller->$action();
				} else {
					$controller->index();
				}
				break;
		case 'siswa':
				$controller = new SiswaController();
				if (method_exists($controller, $action)) {
					$controller->$action();
				} else {
					$controller->index();
				}
				break;
		case 'peminjaman':
				$controller = new PeminjamanController();
				if (method_exists($controller, $action)) {
					$controller->$action();
				} else {
					$controller->index();
				}
				break;
    default:
        $controller = new BerandaController();
        $controller->index();
}