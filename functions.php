<?php
function getTemplate($url, $args)
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

function getContent($content)
{
    return htmlentities($content, ENT_QUOTES, "UTF-8");
}