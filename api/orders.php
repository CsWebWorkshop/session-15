<?php
$user = null;
$conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($token['user'])) {
    $sql = "SELECT * FROM user WHERE email='".$token['user']."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userid = $result->fetch_assoc();
        $user = $userid['id'];
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
$meta = [];
if ($user != null) {
    $sql = "SELECT id FROM `orders` WHERE orders.user_id=$user";
    $result = $conn->query($sql);
    $meta['total'] = $result->num_rows;
    $meta['page'] = $page;
    $meta['totalpages'] = ceil($meta['total'] / $perpage);
    $sql = "SELECT orders.id, status.name, SUM(products.price * order_product.amount) as total, SUM(order_product.amount) as productCount
    FROM orders
    LEFT JOIN status ON status.id = orders.status_id
    LEFT JOIN order_product ON orders.id = order_product.order_id
    LEFT JOIN products ON products.id = order_product.product_id
    WHERE orders.user_id=$user
    GROUP BY id".$offset;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $meta['data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
echo json_encode($meta);
?>