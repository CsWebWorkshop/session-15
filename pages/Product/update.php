<?php
$action = './update';
require './models/products.php';
$database = new Products($msqlserver, $msqluser, $msqlpass, $msqldb);
$product = $database->getProduct($productID);
if(isset($_POST['title']) && isset($_POST['creator']) && isset($_POST['Size']) && isset($_POST['Material'])
    && isset($_POST['description']) && isset($_POST['rating']) && isset($_POST['ratingCount']) && isset($_POST['location'])
    && isset($_POST['price']) && isset($_POST['Discount']) && isset($_POST['previousPrice'])) {
    if($_POST['Discount'] < 100 && $_POST['rating'] < 10) {
        $parentid = '';
        if($_POST['parent_id'] != "") {
            $parentid = ",`parent_id`='".$_POST['parent_id']."'";
        }
        $conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $result = $conn->query("UPDATE `products` SET `price`='".$_POST['price']."', `Discount`='".$_POST['Discount']."', `previousPrice`='".$_POST['previousPrice']."',`location`='".$_POST['location']."', `Size`='".$_POST['Size']."' ,`title`='".$_POST['title']."', `rating`='".$_POST['rating']."', `ratingCount`='".$_POST['ratingCount']."' , `creator`='".$_POST['creator']."', `Material`='".$_POST['Material']."', `description`='".$_POST['description']."' $parentid  WHERE `products`.`id` = $productID");
        if ($result == true) {
            require_once './pages/Product/form.php';
        }
    }
} else {
    require_once './pages/Product/form.php';
}
?>