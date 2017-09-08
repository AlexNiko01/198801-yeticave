<?php
session_start();
require_once 'functions.php';
require_once 'models/products.php';
$products = getAllProducts();

if (isset($_SESSION['user'])) {
    if (isset($_COOKIE['lot_data'])) {
        $ratesList = json_decode($_COOKIE['lot_data'], true);

        $ratedProducts = getRatedProducts($ratesList);
        $content = getTemplate('templates/mylots.php', ['ratedProducts' => $ratedProducts]);

        renderLayout($content, 'Мои ставки');
    }
} else {
    header('HTTP/1.1 403 FORBIDDEN');
}
