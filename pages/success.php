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
            $conn->query("UPDATE `orders` SET status_id=2 WHERE id=".$_GET['order_id']);
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
    <title>Success</title>
    <link rel="stylesheet" href="./assets/styles/success.css">
</head>
<body>
    <section class="container">
        <section class="success-container">
            <p>عملیات پرداخت با موفقیت انجام شد</p>
            <a href="/">بازگشت به فروشگاه</a>
        </section>
    </section>
</body>
</html>