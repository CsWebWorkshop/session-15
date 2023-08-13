<?php
require './models/products.php';
$admin = false;
$conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($token['user'])) {
    $sql = "SELECT * FROM user WHERE email='".$token['user']."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $admin = $user['is_admin'];
    }
}
$where = '';
$offset = '';
$perpage = 2;
$page = 1;
if(isset($_GET['page'])) {
    $page = intval($_GET['page']);
    $offset = " LIMIT $perpage OFFSET ".(($page - 1) * $perpage);
} else {
    $offset = " LIMIT $perpage";
}
if (isset($_GET['query'])) {
    $where = " WHERE title LIKE '%".$_GET['query']."%'";
}
$meta = [];
$sql = "SELECT id
FROM products".$where;
$result = $conn->query($sql);
$meta['total'] = $result->num_rows;
$meta['page'] = $page;
$meta['totalpages'] = ceil($meta['total'] / $perpage);

if ($admin == true) {
    
    $sql = "SELECT products.*, orders.count as orderCount
    FROM products
    LEFT JOIN (SELECT SUM(amount) AS count, product_id
        FROM order_product
        GROUP BY product_id) AS orders ON products.id = orders.product_id".$where.$offset;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $meta['data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
} else {
    $database = new Products($msqlserver, $msqluser, $msqlpass, $msqldb);
    $meta['data'] =$database->ProductList($where.$offset);
}
echo json_encode($meta);
?>