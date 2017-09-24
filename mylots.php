<?php
session_start();
require_once 'functions.php';
$mysqliConnect = returnMysqliConnect();

if (isUserAuthenticated()) {
    $id = $_SESSION['id'];

    $ratedProducts = select_data($mysqliConnect, "SELECT lots.id AS lot_id,lots.photo, lots.title, lots.expire_date, lots.winner_id, lots.author_id, rates.price, users.contacts, 
                                                    DATE_FORMAT(date, '%d.%m.%y %H:%i') as date, categories.name AS cat_name
                                                    FROM lots 
                                                    JOIN categories ON categories.id = lots.category_id
                                                    JOIN rates ON lots.id = rates.lot_id 
                                                    JOIN users ON lots.author_id = users.id 
                                                    WHERE rates.user_id = '$id' ORDER BY lots.expire_date DESC");


    $data = compact('ratedProducts', 'id');
    $content = getTemplate('templates/mylots.php', $data);
    renderLayout($content, 'Мои ставки');
} else {
    header('HTTP/1.1 403 FORBIDDEN');
}
