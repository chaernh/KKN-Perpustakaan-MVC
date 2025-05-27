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
    default:
        $controller->index();
}