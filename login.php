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
    ]
];
$errors = formValidation($rules);
$passwordErrorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {
    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user = searchUserByEmail($email,$mysqliConnect)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['name'];
                $_SESSION['id'] = $user['id'];
                header("Location: index.php");
            } else {
                $passwordErrorMessage = 'Вы ввели неверный пароль';
            }
        }
    }
}
$data = compact('errors','passwordErrorMessage');
$content = getTemplate('templates/login.php', $data);
renderLayout($content, 'Вход');