<?php

try {
    $dbh = new PDO('mysql:host=db;dbname=yeticave;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


function insertCats($cats, $dbh)
{
    $insertStatement = $dbh->prepare("INSERT INTO categories(name) VALUES( :name)");
    foreach ($cats as $cat) {
        $insertStatement->execute(array(':name' => $cat));
    }
}

//insertCats($cats, $dbh);

$products = [
    [
        'title' => '2014 Rossignol District Snowboard',
        'photo' => 'img/lot-1.jpg',
        'start_price' => '10999'
    ],
    [
        'title' => 'DC Ply Mens 2016/2017 Snowboard',
        'photo' => 'img/lot-2.jpg',
        'start_price' => '159999'
    ],
    [
        'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'photo' => 'img/lot-3.jpg',
        'start_price' => '8000'
    ],
    [
        'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'photo' => 'img/lot-4.jpg',
        'start_price' => '10999'
    ],
    [
        'title' => 'Куртка для сноуборда DC Mutiny Charocal',
        'photo' => 'img/lot-5.jpg',
        'start_price' => '7500'

    ],
    [
        'title' => 'Маска Oakley Canopy',
        'photo' => 'img/lot-6.jpg',
        'start_price' => '5400'
    ],
];


function insertData($data, $dbh, $table, $fields)
{
    $keys = implode(', ', $fields);
    $fieldBox = [];
    foreach ($fields as $field) {
        $fieldBox[] = ':' . $field;
    }
    $fieldsString = implode(',', $fieldBox);
    $insertStatement = $dbh->prepare("INSERT INTO $table($keys) VALUES ($fieldsString)");
    foreach ($data as $item) {
        $insertStatement->execute($item);

    }
}

//insertData($products, $dbh, 'lots', ['title', 'photo', 'start_price']);
function selectAllCats()
{
    $dbh = new PDO('mysql:host=db;dbname=yeticave;charset=utf8', 'root', 'root');
    $insertStatement = $dbh->prepare('SELECT * FROM `categories`');
    $insertStatement->execute();
    $allCats = $insertStatement->fetchAll(PDO::FETCH_ASSOC);
    return $allCats;

}

?>
<!--<pre>-->
<!--    --><?php //var_dump(selectAllCats()); ?>
<!--</pre>-->
