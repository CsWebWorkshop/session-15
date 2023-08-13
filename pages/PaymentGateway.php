<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment gateway</title>
    <link rel="stylesheet" href="./assets/styles/PaymentGateway.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
</head>
<body>
    <section class="container">
        <section class="btn" id="success">پرداخت</section>
        <a href="/failed?order_id=<?php echo $_GET['order_id']; ?>" class="btn" id="failed">انصراف</a>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
    <script src="./assets/scripts/payment.js?1"></script>
</body>
</html>