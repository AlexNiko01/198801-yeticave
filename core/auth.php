<?php
function searchUserByEmail($email,$mysqliConnect)
{
    $users = select_data($mysqliConnect, 'SELECT * FROM users');

    $result = null;
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $result = $user;
            break;
        }
    }
    return $result;
}

function isUserAuthenticated()
{
    return isset($_SESSION['id']);

}