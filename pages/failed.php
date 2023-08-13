<?php
$conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(!isset($_GET['order_id'])) {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cart');
    exit;
}
$sql = "SELECT * FROM orders WHERE id=".$_GET['order_id']." AND status_id=1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
    $sql = "SELECT * FROM user WHERE email='".$token['user']."'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if($user['id'] == $order['user_id']) {
            $conn->query("UPDATE `orders` SET status_id=3 WHERE id=".$_GET['order_id']);
        } else {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cart');
            exit;
        }
    } else {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');
        exit;
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cart');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>failed</title>
    <link rel="stylesheet" href="./assets/styles/failed.css">
</head>
<body>
    <section class="container">
        <section class="failed-container">
            <p>عملیات پرداخت موفقیت آمیز نبود</p>
            <a href="/cart">بازگشت به سبد خرید</a>
        </section>
    </section>
</body>
</html>