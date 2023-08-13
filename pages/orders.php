<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="./../assets/styles/dashboard.css">
    <!-- <link rel="stylesheet" href="./assets/styles/dashboard.css"> -->
</head>

<body>
    <section class="dashboard-container" id="order-container">
        <?php
        require "./pages/sidebar.php";
        ?>
        <section class="container orders-container">
            <section class="list">
                
            </section>

            <section class="pagination">
                
            </section>
        </section>


        <section class="modal">
            <section class="background-dark"></section>
            <section class="modal-section">
                <section class="btn-close">
                    <section class="close">×</section>
                </section>
                <section class="information">
                    <section class="pay">
                        <p>وضعیت پرداخت:</p>
                        <p class="payment-status" id="pay">Payment Success</p>
                    </section>
                    <section class="total-price">
                        <p>مجموع قیمت:</p>
                        <p class="total-price" id="total-price">186.00</p>
                    </section>
                    <section class="product-count">
                        <p>تعداد محصولات:</p>
                        <p id="product-count">2</p>
                    </section>
                    <section class="product-list">
                        
                    </section>
                </section>
            </section>
        </section>
    </section>


    <script src="./../assets/scripts/orders.js"></script>
    <script src="./../assets/scripts/sidebar.js"></script>
</body>

</html>