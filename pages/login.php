<?php
    $errors = [];
    if($_SERVER["REQUEST_METHOD"] == 'POST') {
        if(isset($_POST['email']) && isset($_POST['pass'])) {
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Invalid Email';
            } elseif (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $_POST['pass'])) {
                $errors[] = 'Invalid Password';
            } else {
                $conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $result = $sql = "SELECT id, email, `password` FROM user WHERE email='".$_POST['email']."'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if (password_verify($_POST['pass'], $row['password'])) {
                        /* //with Session
                        $_SESSION['id'] = "1";
                        if ($_POST['remember'] == 'on') {
                            setcookie('token', $_POST['email'].":".md5("$2y$10$9wTMSdtOhQYbxHrd71jgz.snf62xQjwEkTiHXv5sjuugpdwqK6SGu"), time() + (86400 * 2));
                        } */
    
                        //without Session
                        $time = time() + 3600;
                        if ($_POST['remember'] == 'on') {
                            $time += (86400 * 2);
                        }
                        setcookie('token', $_POST['email'].":".md5($row['password']), $time);
                        header('Location: http://'.$_SERVER['HTTP_HOST'].'/dashboard');
                    } else {
                        $errors[] = 'Wrong Password';
                    }
                } else {
                    $errors[] = 'Email not found!';
                }
                $conn->close();
            }
        } else {
            $errors[] = 'Missing Field';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/styles/form.css?2">
</head>
<body>
    <section class="container">
        <section class="form-container">

            <h1 class="form-title">Login</h1>

            <form action="./login" method="post" class="form">

                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
                
                <label for="password">Password:</label>
                <input type="password" name="pass" id="password">

                <div class="checkbox-container">
                    <input type="checkbox" name="remember" id="checkbox">
                    <label for="checkbox">Remember Me</label>
                </div>

                <input type="submit" name="submit" class="submit-btn" value="Login">
                <div class="link">Not Registered? <a href="/signup">Sign up</a></div>

            </form>
            <?php foreach ($errors as $error) { ?>
                <div class="error"><?php echo $error;?></div>
            <?php }?>
        </section>
    </section>
</body>
</html>