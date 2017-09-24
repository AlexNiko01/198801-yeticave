<?php
function returnMysqliConnect()
{
    global $mysqliConnect;
    if (!$mysqliConnect) {
        $error = "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        $content = getTemplate('templates/error.php', ['error' => $error]);
        renderLayout($content, 'Error');
        exit;
    }
    $mysqliConnect->set_charset("utf8");
    return $mysqliConnect;
}

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
        return $selectedData;

    } else {
        return $selectedData;
    }
}


function insert_data($mysqliConnect, $table, $arr = [])
{
    $keysArr = array_keys($arr);
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
            return $lastInsertedId;
        } else {
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
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

    return $result;
}

