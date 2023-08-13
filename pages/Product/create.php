<?php
$action = './create';
if(isset($_POST['title']) && isset($_POST['creator']) && isset($_POST['Size']) && isset($_POST['Material'])
    && isset($_POST['description']) && isset($_POST['rating']) && isset($_POST['ratingCount']) && isset($_POST['location'])
    && isset($_POST['price']) && isset($_POST['Discount']) && isset($_POST['previousPrice'])) {
    if($_POST['Discount'] < 100 && $_POST['rating'] < 10) {
        $parentid = 'NULL';
        $photoid = 'NULL';
        if($_POST['parent_id'] != "") {
            $parentid = "'".$_POST['parent_id']."'";
        }
        $conn = new mysqli($msqlserver, $msqluser, $msqlpass, $msqldb);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        if(isset($_FILES["photo"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["photo"]["size"] > 5000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                $photoid = "'".$target_file."'";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            }
        }
        $result = $conn->query("INSERT INTO `products` (`title`, `creator`, `Size`, `Material`, `description`, `rating`, `ratingCount`, `location`, `price`, `Discount`, `previousPrice`, `photo`, `parent_id`) VALUES ('".$_POST['title']."', '".$_POST['creator']."', '".$_POST['Size']."', '".$_POST['Material']."', '".$_POST['description']."', '".$_POST['rating']."', '".$_POST['ratingCount']."', '".$_POST['location']."', '".$_POST['price']."', '".$_POST['Discount']."', '".$_POST['previousPrice']."', $photoid, $parentid)");
        if ($result == true) {
            require_once './pages/Product/form.php';
        }
    }
} else {
    require_once './pages/Product/form.php';
}
?>