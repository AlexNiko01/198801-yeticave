<?php session_start();
require_once 'functions.php';
$mysqliConnect = returnMysqliConnect();

$currentPage = 1;

if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
$queryString = '';
if (isset($_GET['search']) && !empty(($_GET['search']))) {
    $queryString = $_GET['search'];
}
$phrase = htmlspecialchars(trim($queryString),ENT_QUOTES);
$postPerPage = 9;
$postsQuantity = count(select_data($mysqliConnect, "SELECT * FROM lots WHERE (title LIKE '%$phrase%' OR description LIKE '%$phrase%') AND expire_date > NOW()"));
$pagesQuantity = ceil($postsQuantity / $postPerPage);
$offset = ($currentPage - 1) * $postPerPage;
$searchedData = select_data($mysqliConnect, "SELECT * FROM lots WHERE (title LIKE '%$phrase%' OR description LIKE '%$phrase%') AND expire_date > NOW() ORDER BY creation_date DESC LIMIT $postPerPage OFFSET $offset");


$baseUrl = '/search.php?search='.$phrase.'&';
$pagination = getTemplate('templates/pagination.php', ['pagesQuantity' => $pagesQuantity, 'currentPage' => $currentPage, 'baseUrl' => $baseUrl]);
$data = compact(['searchedData', 'pagination']);
$content = getTemplate('templates/search.php', $data);
$title = 'Результаты поиска по запросу'.$phrase;

renderLayout($content, $title);

