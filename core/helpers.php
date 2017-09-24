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
            return $path . '/' . $file_name;
        }
    }
    return false;
}

function getCurrentDate()
{
    $now = gmdate('Y-m-d H:i:s', strtotime('now'));
    return $now;
}

function convertDateToBaseFormat($date)
{
    return gmdate('Y-m-d H:i:s', strtotime($date));
}

function determineWinners()
{
    global $mysqliConnect;
    $productsId = select_data($mysqliConnect, "SELECT id FROM lots WHERE expire_date <= NOW() AND winner_id is null");

    $lastRatesAuthorsData = [];
    if (!empty($productsId)) {
        foreach ($productsId as $productId) {
            $id = $productId['id'];
            $lastRate = select_data($mysqliConnect, "SELECT rates.user_id, rates.lot_id, users.email, users.name, lots.title, rates.price FROM rates JOIN users ON rates.user_id = users.id JOIN lots ON rates.lot_id = lots.id 
WHERE price = (SELECT MAX(price) FROM rates WHERE lot_id = '$id') AND lot_id = '$id' ");
            if (!empty($lastRate)) {
                $lastRatesAuthorsData[] = $lastRate;
            }
        }
    }

    if (!empty($lastRatesAuthorsData)) {
        $winnersId = [];

        foreach ($lastRatesAuthorsData as $lastRatesAuthorData) {
            $winnersId[] = $lastRatesAuthorData[0]['user_id'];
            $lotId = $lastRatesAuthorData[0]['lot_id'];
            exec_query($mysqliConnect, "UPDATE lots SET winner_id = ? WHERE id = $lotId", $arr = ['winner_id' => $lastRatesAuthorData[0]['user_id']]);
            sendWinnerEmail($lastRatesAuthorData[0]);
        }
    }
}

function sendWinnerEmail($lotData, $subject = 'ваша ставка победила')
{
    $mailerEmail = 'doingsdone@mail.ru';
    $email = $lotData['email'];

    $name = $lotData['name'];
    $lot_name = $lotData['title'];
    $mylots_link = SITE_URL . '/mylots.php';
    $lot_link = SITE_URL . '/lot.php?id=' . $lotData['lot_id'];
    $data = compact('name', 'email', 'lot_name', 'mylots_link', 'lot_link');
    $messageBody = getTemplate('templates/email.php', $data);

    $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465))
        ->setUsername('doingsdone@mail.ru')
        ->setPassword('rds7BgcL');

    $mailer = new Swift_Mailer($transport);

    $message = (new Swift_Message($subject))
        ->setFrom($mailerEmail)
        ->setTo([$email => $name])
        ->setBody($messageBody,
            'text/html');
    try{
        $mailer->send($message);
    }catch (Exception $exception){
        var_dump($exception);
    };


}

