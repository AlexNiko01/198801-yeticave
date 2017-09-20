<?php
function formValidation($rules)
{
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        foreach ($rules as $key => $rule) {
            foreach ($rule as $singleRule) {
                if ($singleRule === 'required') {
                    if (!isset($_POST[$key]) || $_POST[$key] == '') {
                        $errors[$key][] = 'Заполните это поле';
                    }
                }
                if ($singleRule === 'numeric') {
                    if (isset($_POST[$key])) {
                        if (!filter_var($_POST[$key], FILTER_VALIDATE_FLOAT)) {
                            $errors[$key][] = 'Данное значение должно быть числовым';
                        }
                    }
                }
                if ($singleRule === 'email') {
                    if (isset($_POST[$key]) && !empty($_POST[$key])) {
                        if (!filter_var($_POST[$key], FILTER_VALIDATE_EMAIL)) {
                            $errors[$key][] = 'Введите корректный email';
                        }
                    }
                }
                if ($singleRule === 'min_rate'){
                    if (isset($_POST[$key]) && !empty($_POST[$key])){
                        if($_POST[$key]< $_POST['lot_start_price'] + $_POST['lot_rate_step']){
                            $errors[$key][] = 'Данное значение не может быть меньше чем цена плюс минимальная ставка';
                        }
                    }
                }
            }
        }
    }
    return $errors;
}

function fileValidation($fileName)
{
    $file_error_text = false;
    $file_max_size = 300000;
    if (isset($_FILES[$fileName]) && !empty($_FILES[$fileName]['name']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $file_name = $_FILES[$fileName]['tmp_name'];
        $file_size = $_FILES[$fileName]['size'];
        $file_type = finfo_file($file_info, $file_name);

        if ($file_type !== 'image/jpeg' && $file_type !== 'image/png') {
            $file_error_text = 'Загрузите картинку в формате jpg или png ';
        }
        if ($file_size > $file_max_size) {
            $file_error_text .= 'Максимальный размер файла: 200Кб';
        }
    }

    return $file_error_text;
}