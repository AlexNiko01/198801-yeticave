<?php
session_start();
require_once 'functions.php';
require_once 'models/bets.php';
$mysqliConnect = returnMysqliConnect();
$cats = select_data($mysqliConnect, 'SELECT * FROM categories');

$rules = [
    'lot-name' => [
        'required',
    ],
    'category' => [
        'required',
    ],
    'message' => [
        'required',
    ],
    'lot-rate' => [
        'required',
        'numeric'
    ],
    'lot-step' => [
        'required',
        'numeric'
    ],
    'lot-date' => [
        'required',
    ],
];
$errors = formValidation($rules);
$file_error_text = fileValidation('lot-file');
$currentUserId = $_SESSION['id'];

if (isUserAuthenticated()) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors) && !$file_error_text) {
        $photoPath = saveUploadedFile('lot-file', '/img/lots');

        $id = insert_data($mysqliConnect, 'lots', $arr = [
            'title' => $_POST['lot-name'],
            'creation_date' => getCurrentDate(),
            'expire_date' => convertDateToBaseFormat($_POST['lot-date']),
            'description' => $_POST['message'],
            'photo' => $photoPath,
            'start_price' => $_POST['lot-rate'],
            'rate_step' => $_POST['lot-step'],
            'category_id' => $_POST['category'],
            'author_id' => $currentUserId,
        ]);
        header('Location: lot.php?id=' . $id);
    }
    $data = compact('cats', 'errors', 'file_error_text');
    $content = getTemplate('templates/add-lot.php', $data);
    renderLayout($content, 'Добавление лота');

} else {
    header('HTTP/1.1 403 FORBIDDEN');
}
