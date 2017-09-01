<?php
function getAllProducts()
{
    $products = [
        [
            'title' => '2014 Rossignol District Snowboard',
            'cat' => 'Доски и лыжи',
            'price' => '10999',
            'img_url' => 'img/lot-1.jpg'
        ],
        [
            'title' => 'DC Ply Mens 2016/2017 Snowboard',
            'cat' => 'Доски и лыжи',
            'price' => '159999',
            'img_url' => 'img/lot-2.jpg'
        ],
        [
            'title' => 'Крепления Union Contact Pro 2015 года размер L/XL',
            'cat' => 'Крепления',
            'price' => '8000',
            'img_url' => 'img/lot-3.jpg'
        ],
        [
            'title' => 'Ботинки для сноуборда DC Mutiny Charocal',
            'cat' => 'Ботинки',
            'price' => '10999',
            'img_url' => 'img/lot-4.jpg'
        ],
        [
            'title' => 'Куртка для сноуборда DC Mutiny Charocal',
            'cat' => 'Одежда',
            'price' => '7500',
            'img_url' => 'img/lot-5.jpg'
        ],
        [
            'title' => 'Маска Oakley Canopy',
            'cat' => 'Разное',
            'price' => '5400',
            'img_url' => 'img/lot-6.jpg'
        ],
    ];
    return $products;
}

function getSingleProduct($id)
{
    $productsList = getAllProducts();
    if (isset($productsList[$id])) {
        return $productsList[$id];
    }else{
       return false;
    }
}