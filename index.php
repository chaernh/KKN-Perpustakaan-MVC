<?php
require_once 'Controllers/BerandaController.php';

$controller = $_GET['controller'] ?? 'beranda';
$action = $_GET['action'] ?? 'index';

$controller = new BerandaController();
$controller->index();