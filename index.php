<?php
$msqlserver = "localhost";
$msqluser = "root";
$msqlpass = "";
$msqldb = 'test';
session_start();
$request = $_SERVER['REQUEST_URI'];
$request = explode('?', $request)[0];

/* With Session
if(!isset($_SESSION['id']) && isset($_COOKIE['token'])) {
    $token = explode(':', $_COOKIE['token']);
    if($token[0] == 'm.khoshdel81@gmail.com' && $token[1] == md5("$2y$10$9wTMSdtOhQYbxHrd71jgz.snf62xQjwEkTiHXv5sjuugpdwqK6SGu")) {
        $_SESSION['id'] = "1";
    }
} */

// with cookie

$token = [];

if (isset($_COOKIE['token'])) {

    $split = explode(':', $_COOKIE['token']);

    $token = [
        'user' => $split[0],
        'pass' => $split[1]
    ];
}

if ($request == '' || $request == '/') {

    require './pages/main.php';

} elseif ($request == '/cart' || $request == '/cart/') {

    require './pages/cart.html';

} elseif ($request == '/payment' || $request == '/payment/') {

    require './pages/PaymentGateway.php';

} elseif ($request == '/success' || $request == '/success/') {

    require './pages/success.php';

} elseif ($request == '/failed' || $request == '/failed/') {

    require './pages/failed.php';

} elseif ($request == '/login' || $request == '/login/') {
    if (isset($token['user'])) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/dashboard');
    }
    require './pages/login.php';
} elseif ($request == '/api/checkout' || $request == '/api/checkout/') {
    if (!isset($token['user'])) {
        echo json_encode([
            'status' => 403,
            'error' => 'unathorized'
        ]);
        exit;
    }

    require './api/checkout.php';

} elseif ($request == '/signup' || $request == '/signup/') {

    if (isset($token['user'])) {

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/dashboard');

    }

    require './pages/signup.php';

} elseif ($request == '/logout' || $request == '/logout/') {
    //session_destroy();

    setcookie("token", "", time() - 3600);

    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

} elseif (preg_match('/^\/dashboard/', $request)) {
    /* //with Session
    if(!isset($_SESSION['id'])) {
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/login');
    }
    */
    // With Cookie

    if (!isset($token['user'])) {

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

    } else {

        $conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT id, email, `password` FROM user WHERE email='" . $token['user'] . "'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();

            if ($token['pass'] == md5($row['password'])) {

                $token['id'] = $row['id'];

            } else {

                setcookie("token", "", time() - 3600);

                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

            }

        } else {

            setcookie("token", "", time() - 3600);

            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');

        }

        $conn->close();

    }

    $admin = false;
    $conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($token['user'])) {
        $sql = "SELECT * FROM user WHERE email='" . $token['user'] . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $admin = $user['is_admin'];

            if ($admin == 1) {
                $request = str_replace('/dashboard', '', $request);

                if ($request == "" || $request == "/") {

                    require './pages/dashboard.php';

                } elseif ($request == "/orders" || $request == "/orders/") {

                    require "./pages/orders.php";

                } elseif ($request == "/products") {

                    require "./pages/products.php";

                }
            } else {
                $request = str_replace('/dashboard', '', $request);

                if ($request == "" || $request == "/" || $request == "/orders" || $request == "/orders/") {

                    require './pages/orders.php';

                }
            }
        }
    }



} elseif (preg_match('/^\/products(\/)/', $request)) {

    $request = str_replace('/products', '', $request);

    if (preg_match('/^\/[0-9]+/', $request)) {

        $part = explode('/', $request);

        $productID = $part[1];

        if (preg_match('/^\/[0-9]+$/', $request)) {

            require './pages/details.php';

        } elseif (preg_match('/^\/[0-9]+\/update$/', $request)) {

            require './pages/Product/update.php';

        }

    } elseif (preg_match('/^\/create$/', $request)) {

        require './pages/Product/create.php';

    }

}elseif(preg_match('/^\/api\/admin\/$/', $request)){
    require "./api/isAdmin.php";
}
 elseif (preg_match('/^\/api\/product\/[0-9]+$/', $request)) {

    $request = str_replace('/api/product', '', $request);

    $part = explode('/', $request);

    $productID = $part[1];

    if (preg_match('/^\/[0-9]+$/', $request)) {

        require './api/product.php';

    }

} elseif (preg_match('/^\/api\/products(\/)/', $request)) {

    $request = str_replace('/api/products', '', $request);

    if (preg_match('/^\/[0-9]+/', $request)) {

        $part = explode('/', $request);

        $productID = $part[1];

        if (preg_match('/^\/[0-9]+$/', $request)) {

            require './api/product.php';

        }

    } elseif (preg_match('/^(\/)$/', $request)) {

        require './api/products.php';

    }

} elseif (preg_match('/^\/api\/stats/', $request)) {

    if (!isset($token['user'])) {

        echo json_encode([
            'status' => 403,
            'error' => 'unathorized'
        ]);

        exit;

    }

    require './api/stats.php';

} elseif (preg_match('/^\/api\/orders(\/)/', $request)) {

    $request = str_replace('/api/orders', '', $request);

    if (preg_match('/^\/[0-9]+/', $request)) {

        $part = explode('/', $request);

        $orderID = $part[1];

        if (preg_match('/^\/[0-9]+$/', $request)) {

            require './api/order.php';

        }

    } elseif (preg_match('/^(\/)$/', $request)) {

        require './api/orders.php';

    }

} elseif ($request == '/post') {

    require './post.php';

} elseif ($request == '/backup') {

    $conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);

    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);

    }

    $result = $conn->query("SELECT * FROM products 
    INTO OUTFILE 'e:/products.csv' 
    FIELDS TERMINATED BY ',' 
    ENCLOSED BY '\"' 
    LINES TERMINATED BY '\n';");

} elseif ($request == "/api/isadmin") {

    require "./api/isAdmin.php";

} else {

    echo "404";

}
?>