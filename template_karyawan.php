<?php session_start(); ?>
<?php if (isset($_SESSION["session_karyawan"])): ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-success navbar-dark sticky-top">
      <a href="#" class="text-white">
        <h3>RENTAL MOBIL</h3>
      </a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
        <span class="navbar navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="template_karyawan.php?page=pelanggan" class="nav-link">Pelanggan</a></li>
          <li class="nav-item"><a href="template_karyawan.php?page=mobil" class="nav-link">Mobil</a></li>
          <li class="nav-item"><a href="template_karyawan.php?page=laporan" class="nav-link">Laporan</a></li>
          <li class="nav-item"><a href="login_karyawan.php?logout=true" class="nav-link">Logout</a></li>
        </ul>
      </div>
    </nav>
    <div class="container my-2">
      <?php if (isset($_GET["page"])): ?>
      <?php if ((@include $_GET["page"].".php") === true): ?>
      <?php include $_GET["page"].".php"; ?>
      <?php endif; ?>
      <?php endif; ?>
    </div>
  </body>
</html>
<?php else: ?>
  <?php echo "Anda Belum Login!" ?>
  <br>
  <a href="login_karyawan.php">Login Disini</a>
<?php endif; ?>
