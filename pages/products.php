<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="./../assets/styles/dashboard.css">
</head>

<body>
    <section class="dashboard-container">
        <?php
        require "./pages/sidebar.php";
        ?>
        <section class="container products-container">
            <section class="top-container">
                <nav>
                    <section class="btn-primary" id="create-product">Create Product</section>
                </nav>
                <section class="list">

                </section>
            </section>

            <section class="pagination">

            </section>
        </section>

        <script src="./../assets/scripts/products.js"></script>
    </section>
</body>

</html>