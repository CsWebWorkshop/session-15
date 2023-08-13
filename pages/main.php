<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require './models/products.php';
    $database = new Products($msqlserver, $msqluser, $msqlpass, $msqldb);
    $products = $database->ProductList();

    $title = 'Online Shop';
    require './pages/head.php';
    ?>

    <link rel="stylesheet" href="./assets/styles/style.css">
</head>

<body>
    <section class="container">
        <?php require './pages/header.php'; ?>


        <header class="header">
            <h1 class="title">CS Online Shop</h1>
            <p class="desc">Don't be slow! Our prices are low</p>
        </header>

        <main class="main">

            <?php foreach ($products as $product) { ?>
                <section class="card-container">

                    <div class="image-container">
                        <img src="./assets/images/cards/daniel-korpai-2FGPidtk00E-unsplash.jpg" alt="image" class="image">
                    </div>

                    <div class="title-box">
                        <h2 class="card-title"><a href="/products/<?php echo $product['id']; ?>"><?php echo $product['title']; ?></a></h2>
                        <div class="rate-box">
                            <i class="fi fi-sr-star star"></i>
                            <h3 class="rate">
                                <?php echo $product['rating']; ?>
                            </h3>
                            <div class="number">(
                                <?php echo $product['ratingCount']; ?>)
                            </div>
                        </div>
                    </div>

                    <section class="location-box">
                        <i class="fi fi-rs-marker"></i>
                        <p class="location">
                            <?php echo $product['location']; ?>
                        </p>
                    </section>

                    <div class="price-box">
                        <div class="price">$
                            <?php echo $product['price']; ?>
                        </div>
                        <div class="off">
                            <?php echo $product['Discount']; ?>%
                        </div>
                        <div class="pervious-price">$
                            <?php echo $product['previousPrice']; ?>
                        </div>
                    </div>

                    <div class="btn-box" onclick="addToCart(<?php echo $product['id']; ?>)">
                        <button class="btn-purchase">
                            <i class="fi fi-rr-shopping-bag"></i>
                            <p>Purchase</p>
                        </button>
                    </div>

                </section>
            <?php } ?>

        </main>

        <?php require './pages/footer.php'; ?>
    </section>

    <script src="./assets/scripts/app.js?1"></script>
</body>

</html>