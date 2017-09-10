<?php
function searchUserByEmail($email, $users)
{
    $result = null;
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $result = $user;
            break;
        }
    }
    return $result;
}

function getRatedProducts($ratesList)
{

    foreach ($ratesList as $key => $rate) {
        $id = $rate['lot-id'];
        $ratesList[$key]['product'] = getSingleProduct($id);
    }
    return $ratesList;
}

function checkLotIdAtCookie($id)
{
    $flag = false;
    if (isset($_COOKIE['lot_data'])) {
        $lotDataIsset = json_decode($_COOKIE['lot_data'], true);
        foreach ($lotDataIsset as $singleLotData) {
            $idAtCookie = $singleLotData["lot-id"];
            if ($id === $idAtCookie) {
                $flag = true;
            }
        }
    }
    return $flag;
}



function isUserAuthenticated()
{
    return isset($_SESSION['user']);

}