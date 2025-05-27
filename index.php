<?php
require_once 'Controllers/BukuController.php';

$controller = new BukuController();
$action = $_GET['action'] ?? 'index';

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