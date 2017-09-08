<?php
session_start();
require_once 'functions.php';
require_once 'userdata.php';
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
$users = returnUsers();
$passwordErrorMessage = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($errors)) {

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($user = searchUserByEmail($email, $users)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['name'];
                header("Location: index.php");
            } else {
                $passwordErrorMessage = 'Вы ввели неверный пароль';
            }
        }
    }
}
$content = getTemplate('templates/login.php', ['errors' => $errors, 'passwordErrorMessage' => $passwordErrorMessage]);
renderLayout($content, 'Вход');