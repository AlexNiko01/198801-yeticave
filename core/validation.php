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