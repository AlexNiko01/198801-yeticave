<?php
require_once 'functions.php';



$content = getTemplate('templates/index.php', ['cats' => $cats, 'products' => $products, 'lot_time_remaining' => $lot_time_remaining]);

renderLayout($content);