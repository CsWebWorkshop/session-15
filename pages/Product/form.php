<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../../assets/styles/dashboard.css">
    <link rel="stylesheet" href="./assets/styles/dashboard.css">
</head>

<body>
    <section class="dashboard-container">
        <?php
        require "./pages/sidebar.php";
        ?>
        <section id="form-container">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form">
                <section>
                    <label for="title">عنوان:</label>
                    <input type="text" id="title" name="title" value="<?php if (isset($product['title']))
                        echo $product['title']; ?>">
                </section>
                <section>
                    <label for="creatpr">سازنده:</label>
                    <input type="text" id="creator" name="creator" value="<?php if (isset($product['creator']))
                        echo $product['creator']; ?>">
                </section>
                <section>
                    <label for="Size">سایز:</label>
                    <input type="text" id="Size" name="Size" value="<?php if (isset($product['Size']))
                        echo $product['Size']; ?>">
                </section>
                <section>
                    <label for="Material">مواد سازنده:</label>
                    <input type="text" id="Material" name="Material" value="<?php if (isset($product['Material']))
                        echo $product['Material']; ?>">
                </section>
                <section>
                    <label for="description">توضیحات:</label>
                    <input type="text" id="description" name="description" value="<?php if (isset($product['description']))
                        echo $product['description']; ?>">
                </section>
                <section>
                    <label for="rating">امتیاز:</label>
                    <input type="text" id="rating" name="rating" value="<?php if (isset($product['rating']))
                        echo $product['rating']; ?>">
                </section>
                <section>
                    <label for="ratingCount">تعداد امتیاز:</label>
                    <input type="number" id="ratingCount" name="ratingCount" value="<?php if (isset($product['ratingCount']))
                        echo $product['ratingCount']; ?>">
                </section>
                <section>
                    <label for="location">موقعیت:</label>
                    <input type="text" id="location" name="location" value="<?php if (isset($product['location']))
                        echo $product['location']; ?>">
                </section>
                <section>
                    <label for="price">قیمت:</label>
                    <input type="text" id="price" name="price" value="<?php if (isset($product['price']))
                        echo $product['price']; ?>">
                </section>
                <section>
                    <label for="Discount">تخفیف:</label>
                    <input type="number" id="Discount" name="Discount" value="<?php if (isset($product['Discount']))
                        echo $product['Discount']; ?>">
                </section>
                <section>
                    <label for="previousPrice">قیمت قبل از تخفیف:</label>
                    <input type="text" id="previousPrice" name="previousPrice" value="<?php if (isset($product['previousPrice']))
                        echo $product['previousPrice']; ?>">
                </section>
                <section>
                    <label for="photo">تصویر:</label>
                    <input type="file" id="photo" name="photo">
                </section>
                <section>
                    <label for="parent_id">آی دی والد:</label>
                    <input type="number" id="parent_id" name="parent_id" value="<?php if (isset($product['parent_id']))
                        echo $product['parent_id']; ?>">
                </section>
                <section id="btn-submit">
                    <input type="submit" value="Submit" name="submit">
                </section>
            </form>
        </section>

        <section class="modal">
            <section class="background-dark"></section>
            <section class="modal-section">
                <section class="btn-close">
                    <section class="close">×</section>
                </section>
                <section class="information" id="search-box">
                    <section class="search-box">
                        <i class="fi fi-rr-search"></i>
                        <input type="text" id="search-product">
                    </section>
                    <section class="result-container">
                        <section>
                            <section class="result">
                                <section class="result-item">
                                    <section>
                                        <p>ID</p>
                                    </section>
                                    <section>
                                        <p>Title</p>
                                    </section>
                                    <section>
                                        <p>Price</p>
                                    </section>
                                </section>
                            </section>
                            <section class="result" id="show-res">
                                
                            </section>
                        </section>
                        <section class="pagination">

                        </section>
                    </section>
                </section>
            </section>
        </section>
    </section>

    <script src="./../../assets/scripts/form.js"></script>

</body>

</html>