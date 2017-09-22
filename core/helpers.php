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


function saveUploadedFile($name, $path)
{
    if (isset($_FILES[$name]['name']) && !empty($_FILES[$name]['name'])) {
        $file_name = $_FILES[$name]['name'];
        $file_path = $_SERVER['DOCUMENT_ROOT'] . $path;
        $file_url = $path . $file_name;
        if (!file_exists($file_url)) {
            $fullPath = $file_path . '/' . $file_name;
            move_uploaded_file($_FILES[$name]['tmp_name'], $fullPath);
            return $path. '/' . $file_name;
        }
    }
    return false;
}

function getCurrentDate()
{
    $now = gmdate('Y-m-d H:i:s', strtotime('now'));
    return $now;
}
function convertDateToBaseFormat($date){
    return gmdate('Y-m-d H:i:s',strtotime($date));
}