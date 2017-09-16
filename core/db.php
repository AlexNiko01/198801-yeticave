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
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $selectedData[] = $row;
        }
        return $selectedData;
    } else {
        return $selectedData;
    }

}
//select_data($mysqliConnect, 'SELECT * FROM users WHERE id = ? AND name LIKE ?', [4, 'test']);

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
        $stmt->execute();
        $lastInsertedId = mysqli_insert_id($mysqliConnect);
        if (!empty($lastInsertedId)) {
            return $lastInsertedId;
        } else {
            return false;
        }
    } else {
        return false;
    }

}

//insert_data($mysqliConnect, 'users', [
//    'emaile' => 'test3.v@gmail.com',
//    'name' => 'test4',
//    'password' => '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'
//]);


function exec_query($mysqliConnect, $queryString, $arr = [])
{

}