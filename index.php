<?php
require_once 'Controllers/BukuController.php';
require_once 'Controllers/BerandaController.php';
require_once 'Controllers/AnggotaController.php';

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
    case 'anggota':
        $controller = new AnggotaController();
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