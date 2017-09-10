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

function renderLayout($content, $title)
{
    $user_name = 'Константин';
    $user_avatar = 'img/user.jpg';

    $user_data = compact('user_name', 'user_avatar');

    $user_menu = getTemplate('templates/user-menu.php', $user_data);
    $layout = getTemplate('templates/layout.php', ['content' => $content, 'page_title' => $title, 'user_menu' => $user_menu]);
    print $layout;
}
