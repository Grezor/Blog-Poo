<?php

use App\Autoloader;
use App\Database;

require '../app/Autoloader.php';
Autoloader::register();

if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

// initialisation des objets
$db = new Database('tpgrafikart', 'root', '', 'localhost');

ob_start();

if($p === 'home') {
    require '../pages/home.php';
} elseif($p === 'article') {
    require '../pages/single.php';
}

$content = ob_get_clean();
require '../pages/templates/default.php';
?>
