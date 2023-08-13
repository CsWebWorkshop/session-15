<?php
require './models/products.php';
$database = new Products($msqlserver, $msqluser, $msqlpass, $msqldb);
$product = $database->getProduct($productID);
echo json_encode($product);
?>