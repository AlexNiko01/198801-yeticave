<?php
session_start();
require_once 'functions.php';
$mysqliConnect = returnMysqliConnect();
$cats = select_data($mysqliConnect, 'SELECT * FROM categories');
$catMenu = getTemplate('templates/cat-menu.php', ['cats' => $cats]);
$rules = [
    'email' => [
        'required',
        'email'
    ],
    'password' => [
        'required',
    ],
    'name' => [
        'required',
    ],
    'message' => [
        'required',
    ]

];
$errors = formValidation($rules);
$file_error_text = fileValidation('file');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors) && !$file_error_text) {
    $avatarPath = saveUploadedFile('file', '/img/avatar');
    insert_data($mysqliConnect, 'users', ['registration_date' => getCurrentDate(), 'name' => $_POST['name'], 'email' => $_POST['email'], 'password' => md5($_POST['password']), 'avatar' => $avatarPath, 'contacts' => $_POST['message']]);
}

$content = getTemplate('templates/sign-up.php', ['catMenu' => $catMenu, 'errors' => $errors, 'file_error_text' => $file_error_text]);
renderLayout($content, 'Регистрация', $cats);
