<?php
session_start();
require_once 'functions.php';
$mysqliConnect = returnMysqliConnect();
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
    insert_data($mysqliConnect, 'users', ['registration_date' => getCurrentDate(), 'name' => $_POST['name'], 'email' => $_POST['email'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'avatar' => $avatarPath, 'contacts' => $_POST['message']]);
}
$data = compact('errors', 'file_error_text');
$content = getTemplate('templates/sign-up.php', $data);
renderLayout($content, 'Регистрация', $cats);
