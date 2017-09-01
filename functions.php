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
    if ($timeInterval > 86400) {
        return gmdate('m.d.y в H:i', $time);
    } else {
        return assureTimeFormatWords($timeInterval);
    }
}

function assureTimeFormatWords($time)
{
    $expression = '';
    $interval = '';
    if ($time < 3600) {
        $interval = gmdate('i', $time);

        if ($interval == 1 || ($interval % 10 == 1 && $interval > 20)) {
            $expression = 'минута назад';
        } else if (($interval % 10 >= 2 && $interval % 10 <= 4 && $interval > 20) || ($interval >=2 && $interval <=4)) {
            $expression = 'минуты назад';
        } else if (($interval % 10 >= 5 && $interval % 10 <= 9) || $interval % 10 == 0 || ($interval >= 11 && $interval <= 14)) {
            $expression = 'минут назад';
        }
    } else if ($time > 3600 && $time < 86400) {
        $interval = gmdate('H', $time);
        if ($interval == 1 || ($interval % 10 == 1 && $interval > 20)) {
            $expression = 'час назад';
        } else if (($interval % 10 >= 2 && $interval % 10 <= 4 && $interval > 20) || ($interval >=2 && $interval <=4)) {
            $expression = 'часа назад';
        } else if (($interval % 10 >= 5 && $interval % 10 <= 9) || $interval % 10 == 0 || ($interval >= 11 && $interval <= 14)) {
            $expression = 'часов назад';
        }
    }

    return $interval. ' ' .$expression;
}