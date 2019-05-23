<?php session_start(); ?>

<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Penyewaan Mobil</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <body>
            <nav class="navbar navbar-expand-md bg-info navbar-dark sticky-top">

                <a href="http://localhost/sewa_mobil/template_pelanggan.php?page=list_mobil" class="text-white">
                    <h3>Penyewaan Mobil</h3>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
                    <span class="navbar navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="menu">
                     <ul class="navbar-nav">
                        <li class="nav-item"><a href="template_pelanggan.php?page=list_mobil" class="nav-link">Daftar Mobil</a></li>
                        <li class="nav-item"><a href="login_pelanggan.php?logout=true" class="nav-link">Logout</a></li>
                    </ul>
                </div>

                <a href="template_pelanggan.php?page=list_sewa">
                <b class="text-white"><span class="fas fa-shopping-cart"></span> Disewa: <?php echo count($_SESSION["session_sewa"]); ?></b>
                </a>

            </nav>
            <div class="container my-2">
                <?php if (isset($_GET["page"])): ?>

                <?php if ((@include $_GET["page"].".php") === true): ?>

                <?php include $_GET["page"].".php"; ?>

                <?php endif; ?>

                <?php endif; ?>

            </div>
        </body>
    </head>
</html>
