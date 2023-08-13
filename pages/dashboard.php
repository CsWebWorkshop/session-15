<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./../assets/styles/dashboard.css">
</head>

<body>
    <section class="dashboard-container">
        <?php
        require "./pages/sidebar.php";
        ?>
        <section class="container" id="chart-container">

            <section>
                <select name="" id="selectElem">
                    <option value="day">روزانه</option>
                    <option value="month">ماهانه</option>
                    <option value="year">سالانه</option>
                </select>
            </section>

            <section class="chart">

            </section>

        </section>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./../assets/scripts/chart.js"></script>
</body>

</html>