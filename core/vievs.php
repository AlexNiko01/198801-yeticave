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

function renderLayout($content, $title, $cats=[])
{
    $user_avatar = 'img/user.jpg';
    $user_menu = getTemplate('templates/user-menu.php', ['user_avatar' => $user_avatar]);
    $layout = getTemplate('templates/layout.php', ['content' => $content, 'page_title' => $title, 'user_menu' => $user_menu, 'cats' => $cats]);
    print $layout;
}
