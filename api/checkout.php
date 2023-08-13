<?php
$items = [];
$input = file_get_contents("php://input");
$data = json_decode($input, true);
if(isset($data['items'])) {
    $conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    foreach ($data['items'] as $item) {
        if(isset($item['id']) && isset($item['count'])) {
            $id = intval($item['id']);
            $count = intval($item['count']);
            if(is_int($id) && is_int($count)) {
                $checkproduct = $conn->query("SELECT id FROM products WHERE id='$id'");
                if($checkproduct->num_rows > 0) {
                    $items[] = $item;
                } else {
                    echo json_encode([
                        'status' => 400,
                        'error' => 'product not found'
                    ]);
                    exit;
                }
            } else {
                echo json_encode([
                    'status' => 400,
                    'error' => 'id and count should be numberic'
                ]);
                exit;
            }
        } else {
            echo json_encode([
                'status' => 400,
                'error' => 'invalid item'
            ]);
            exit;
        }
    }
    $sql = "SELECT * FROM user WHERE email='".$token['user']."'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $result = $conn->query("INSERT INTO `orders` (`user_id`, `status_id`) VALUES (".$user['id'].", 1)");
        if($result === true) {
            $orderid = $conn->insert_id;
            foreach ($items as $item) {
                $conn->query("INSERT INTO `order_product` (`order_id`, `product_id`, `amount`) VALUES (".$orderid.", ".$item['id'].", ".$item['count'].")");
            }
            echo json_encode([
                'status' => 200,
                'order_id' => $orderid,
                'redirect' => 'localhost/checkout',
                'message' => 'success'
            ]);
        }
    }
} else {
    echo json_encode([
        'status' => 400,
        'error' => 'no items found'
    ]);
    exit;
}
?>