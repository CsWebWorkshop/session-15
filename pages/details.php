<!DOCTYPE html>
<html lang="en">
<?php
require './models/products.php';
$database = new Products($msqlserver, $msqluser, $msqlpass, $msqldb);
$product = $database->getProduct($productID);

$title = 'Details';
require './pages/head.php';
?>
<link rel="stylesheet" href="./assets/styles/details.css">
<body>
<section class="container">
    <?php
    require './pages/header.php';
    ?>

<section class="details-container">

<section class="about-container">
    <section class="image-container">
        <div class="main-image">
            <img src="./assets/images/cards/paul-hanaoka-JUJ5osLgXpQ-unsplash.jpg" alt="image" class="image">
        </div>
        <div class="album">
            <img class="album-item" src="./assets/images/cards/filip-baotic-FF8Kqb86V38-unsplash.jpg" alt="image">
            <img class="album-item" src="./assets/images/cards/luis-felipe-lins-J2-wAQDckus-unsplash.jpg" alt="image">
            <img class="album-item" src="./assets/images/cards/malik-shibly-Yx-egSamtKQ-unsplash.jpg" alt="image">
        </div>
    </section>
    <section class="about">
        <h2 class="about-title"><?php echo $product['title'];?></h2>
        <p class="about-desc"><?php echo $product['description'];?></p>
        <div class="input-container">
            <input type="number" min="0" class="input" placeholder="1">
        </div>
        <div class="btn-box">
            <button class="btn-purchase">
                <i class="fi fi-rr-shopping-bag"></i>
                <p>Purchase</p>
            </button>
        </div>  
    </section>
</section>

</section>

<section class="details">
<h2 class="details-title">مشخصات</h2>
<section class="table">
    <section class="th">
        <div class="list-item">سازنده</div>
        <div class="list-item">ابعاد</div>
        <div class="list-item">جنس صفحه</div>
    </section>
    <section class="td">
        <div class="list-item"><?php echo $product['creator'];?></div>
        <div class="list-item"><?php echo $product['Size'];?></div>
        <div class="list-item"><?php echo $product['Material'];?></div>
    </section>
</section>
</section>

    <?php
    require './pages/footer.php';
    ?>
</section>
</body>
</html>