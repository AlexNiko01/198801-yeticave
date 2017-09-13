<?php
require_once '../models/cats.php';
require_once '../models/products.php';
require_once '../userdata.php';
try {
    $dbh = new PDO('mysql:host=db;dbname=yeticave;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
$cats = getAllCategories();
$users = returnUsers();
$products = getAllProducts();
function insertCats($cats, $dbh)
{
    $insertStatement = $dbh->prepare("INSERT INTO categories(name) VALUES( :name)");
    foreach ($cats as $cat) {
        $insertStatement->execute(array(':name' => $cat));
    }
}

//insertCats($cats, $dbh);

function insertUsers($users, $dbh, $table)
{
    $insertStatement = $dbh->prepare("INSERT INTO $table(name, email, password) VALUES(:name, :email, :password)");
    foreach ($users as $user) {

        $insertStatement->execute($user);
    }
}

//insertUsers($users, $dbh, 'users');

function insertData($data, $dbh, $table, $fields)
{
    $keys = implode(', ', $fields);
    $fieldBox = [];
    foreach ($fields as $field) {
        $fieldBox[] = ':' . $field;
    }
    $fieldsString = implode(',', $fieldBox);
    $insertStatement = $dbh->prepare("INSERT INTO $table($keys) VALUES($fieldsString)");
    foreach ($data as $row) {
        $insertStatement->execute($row);
    }
}

//insertData($products, $dbh, 'lots', ['title', 'photo', 'start_price']);