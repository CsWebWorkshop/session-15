<?php
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

if ($admin == true) {
    $sql1 = '';
    $sql2 = '';
    $time = null;
    if(isset($_GET['time'])) {
        $time = $_GET['time'];
    }
    switch ($time) {
        case 'year':
            $sql2 = 'GROUP BY `year` ORDER BY `year` DESC';
            break;
        
        case 'month':
            $sql1 = ', MONTH(orders.created_at) as `month`';
            $sql2 = 'GROUP BY `month` ORDER BY `year`, `month` DESC';
            break;

        case 'week':
            $sql1 = ', WEEK(orders.created_at) as `week`';
            $sql2 = 'GROUP BY `week` ORDER BY `year`, `week` DESC';
            break;
        
        default:
            $sql1 = ', MONTH(orders.created_at) as `month`, DAY(orders.created_at) as `day`';
            $sql2 = 'GROUP BY `day` ORDER BY `year`, `month`, `day` DESC';
            break;
    }
    $sql = "SELECT YEAR(orders.created_at) as `year` $sql1, SUM(products.price * order_product.amount) as total, SUM(order_product.amount) as productCount
    FROM orders
    LEFT JOIN status ON status.id = orders.status_id
    LEFT JOIN order_product ON orders.id = order_product.order_id
    LEFT JOIN products ON products.id = order_product.product_id
    WHERE orders.status_id=2
    $sql2";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $meta['data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    echo json_encode($meta);
} else {
    echo '404';
}
?>