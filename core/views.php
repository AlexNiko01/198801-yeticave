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

function renderLayout($content, $page_title)
{
    global $mysqliConnect;
    $user_avatar = '';
    if (isUserAuthenticated()) {
        $authUserData = getAuthUser();
        $authUserData = array_shift($authUserData);
        $user_avatar = $authUserData['avatar'];
    }
    $cats = select_data($mysqliConnect, 'SELECT * FROM categories');

    $catMenu = getTemplate('templates/cat-menu.php', ['cats' => $cats]);
    $user_menu = getTemplate('templates/user-menu.php', ['user_avatar' => $user_avatar]);
    $data = compact('content', 'page_title', 'user_menu', 'catMenu');
    $layout = getTemplate('templates/layout.php', $data);
    print $layout;
}
