<?php

function returnMysqliConnect()
{
    $mysqliConnect = mysqli_connect('db', 'root', 'root', 'yeticave');
    return $mysqliConnect;
}

$mysqliConnect = returnMysqliConnect();

function select_data($mysqliConnect, $queryString, $arr = [])
{
    $stmt = db_get_prepare_stmt($mysqliConnect, $queryString, $arr);
    $selectedData = [];
    if ($stmt != false) {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $selectedData[] = $row;
        }
        mysqli_stmt_close($stmt);
        mysqli_close($mysqliConnect);
        return $selectedData;


    } else {
        mysqli_close($mysqliConnect);
        return $selectedData;
    }
}


function insert_data($mysqliConnect, $table, $arr = [])
{
    $keysArr = [];
    foreach ($arr as $key => $value) {
        $keysArr[] = $key;
    }
    $valuesArr = [];
    for ($i = count($arr); $i > 0; $i--) {
        $valuesArr[] = '?';
    }
    $values = implode(", ", $valuesArr);
    $keys = implode(",", $keysArr);
    $queryString = "INSERT INTO $table ($keys) VALUES ($values)";
    $stmt = db_get_prepare_stmt($mysqliConnect, $queryString, $arr);
    if ($stmt != false) {
        mysqli_stmt_execute($stmt);
        $lastInsertedId = mysqli_insert_id($mysqliConnect);
        if (!empty($lastInsertedId)) {
            mysqli_stmt_close($stmt);
            mysqli_close($mysqliConnect);
            return $lastInsertedId;
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($mysqliConnect);
            return false;
        }
    } else {
        mysqli_close($mysqliConnect);
        return false;
    }
}


function exec_query($mysqliConnect, $queryString, $arr = [])
{
    $stmt = db_get_prepare_stmt($mysqliConnect, $queryString, $arr);
    $result = false;
    if ($stmt != false) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    mysqli_close($mysqliConnect);
    return $result;
}

