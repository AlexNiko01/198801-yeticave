<?php
session_start();
require_once 'functions.php';
require_once 'mysql_helper.php';
require_once 'init.php';
require_once 'models/products.php';
require_once 'models/cats.php';
$cats = getAllCategories();
$catMenu = getTemplate('templates/cat-menu.php', ['cats' => $cats]);
$products = getAllProducts();

if (isUserAuthenticated() && isset($_COOKIE['lot_data'])) {
    $ratesList = json_decode($_COOKIE['lot_data'], true);
    $ratedProducts = getRatedProducts($ratesList);
    $content = getTemplate('templates/mylots.php', ['ratedProducts' => $ratedProducts, 'catMenu' => $catMenu]);
    renderLayout($content, 'Мои ставки');
} else {
    header('HTTP/1.1 403 FORBIDDEN');
}
