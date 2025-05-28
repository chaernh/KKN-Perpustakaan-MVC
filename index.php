<?php
require_once 'Controllers/BukuController.php';
require_once 'Controllers/BerandaController.php';

$controller = $_GET['controller'] ?? 'beranda';
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'buku':
        $controller = new BukuController();
        switch ($action) {
            case 'create':
                $controller->create();
                break;
            case 'store':
                $controller->store($_POST);
                break;
            case 'edit':
                $controller->edit($_GET['id']);
                break;
            case 'update':
                $controller->update($_POST);
                break;
            case 'destroy':
                $controller->destroy($_GET['id']);
                break;
            default:
                $controller->index();
        }
        break;
    default:
        $controller = new BerandaController();
        $controller->index();
}