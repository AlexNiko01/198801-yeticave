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

//function checkLotIdAtCookie($id)
//{
//    $flag = false;
//    if (isset($_COOKIE['lot_data'])) {
//        $lotDataIsset = json_decode($_COOKIE['lot_data'], true);
//        foreach ($lotDataIsset as $singleLotData) {
//            $idAtCookie = $singleLotData["lot-id"];
//            if ($id === $idAtCookie) {
//                $flag = true;
//            }
//        }
//    }
//    return $flag;
//}



function isUserAuthenticated()
{
    return isset($_SESSION['id']);

}