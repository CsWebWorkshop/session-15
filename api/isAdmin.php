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
        echo json_encode(intval($admin));
    }
}



?>