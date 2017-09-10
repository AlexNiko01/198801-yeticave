<?php
function timeFormat($time)
{
    $currentTime = strtotime('now');
    $timeInterval = $currentTime - $time;
    $secInDay = 86400;
    if ($timeInterval > $secInDay) {
        return gmdate('m.d.y в H:i', $time);
    } else {
        return assureTimeFormatWords($timeInterval);
    }
}

function assureTimeFormatWords($time)
{
    $expression = '';
    $interval = '';
    $secInDay = 86400;
    if ($time < 3600) {
        $interval = gmdate('i', $time);

        if ($interval == 1 || ($interval % 10 == 1 && $interval > 20)) {
            $expression = 'минута назад';
        } else if (($interval % 10 >= 2 && $interval % 10 <= 4 && $interval > 20) || ($interval >= 2 && $interval <= 4)) {
            $expression = 'минуты назад';
        } else if (($interval % 10 >= 5 && $interval % 10 <= 9) || $interval % 10 == 0 || ($interval >= 11 && $interval <= 14)) {
            $expression = 'минут назад';
        }
    } else if ($time > 3600 && $time < $secInDay) {
        $interval = gmdate('H', $time);
        if ($interval == 1 || ($interval % 10 == 1 && $interval > 20)) {
            $expression = 'час назад';
        } else if (($interval % 10 >= 2 && $interval % 10 <= 4 && $interval > 20) || ($interval >= 2 && $interval <= 4)) {
            $expression = 'часа назад';
        } else if (($interval % 10 >= 5 && $interval % 10 <= 9) || $interval % 10 == 0 || ($interval >= 11 && $interval <= 14)) {
            $expression = 'часов назад';
        }
    }

    return $interval . ' ' . $expression;
}




function renderLotData()
{
    $lot_data = [];
    if (isset($_FILES['lot-file']['name']) && !empty($_FILES['lot-file']['name'])) {
        $file_name = $_FILES['lot-file']['name'];
        $file_path = __DIR__ . '/img/lots/';
        $file_url = '/img/lots/' . $file_name;
        if (!file_exists($file_url)) {
            move_uploaded_file($_FILES['lot-file']['tmp_name'], $file_path . $file_name);
        }
        $lot_data['img_url'] = $file_url;
    }
    $lot_data['title'] = $_POST['lot-name'];
    $lot_data['cat'] = $_POST['category'];
    $lot_data['price'] = $_POST['lot-rate'];
    $lot_data['descr'] = $_POST['message'];
    return $lot_data;
}