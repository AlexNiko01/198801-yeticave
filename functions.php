<?php
function getTemplate($url, $args = [])
{
    if (!file_exists($url)) {
        return '';
    }
    if ($args) {
        extract($args);
    };
    ob_start('ob_gzhandler');
    require_once $url;
    $content = ob_get_clean();
    return $content;
}

function filterContent($content)
{
    return htmlentities($content, ENT_QUOTES, "UTF-8");
}

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

function validateNumeric($num)
{
    if (preg_match('/^[0-9\.\ ]+$/', $num)) {
        return true;
    } else {
        return false;
    }
}

function formValidation()
{
    $errors = ['errors_required' => [], 'errors_rules' => []];
    $required = ['lot-name', 'category', 'message', 'lot-rate', 'lot-step', 'lot-date'];
    $has_rule = ['lot-rate' => 'validateNumeric', 'lot-step' => 'validateNumeric'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($required as $field) {
            if ((isset($_POST[$field]) && $_POST[$field] == '') || !isset($_POST[$field])) {
                $errors['errors_required'][] = $field;
            }
        }
        foreach ($has_rule as $key => $value) {
            if (isset($_POST[$key]) && $_POST[$key] != '') {
                $validation = call_user_func($value, $_POST[$key]);
                if (!$validation) {
                    $errors['errors_rules'][] = $key;
                }

            }
        }

    }
    return $errors;
}

function fileValidation()
{
    $file_error_text = false;
    $file_max_size = 300000;
    if (isset($_FILES['lot-file']) && !empty($_FILES['lot-file']['name']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_name = $_FILES['lot-file']['tmp_name'];
        $file_size = $_FILES['lot-file']['size'];
        $file_type = finfo_file($file_info, $file_name);
        if ($file_type !== 'image/jpeg') {
            $file_error_text = 'Загрузите картинку в формате jpg';
        }
        if ($file_size > $file_max_size) {
            $file_error_text .= 'Максимальный размер файла: 200Кб';
        }
    }
    return $file_error_text;
}

function renderLotData()
{
    $lot_data = [];
    if (isset($_FILES['lot-file']['name']) && !empty($_FILES['lot-file']['name'])) {
        $file_name = $_FILES['lot-file']['name'];
        $file_path = __DIR__ . '/img/';
        $file_url = '/img/'.$file_name;
        if(!file_exists($file_url)){
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