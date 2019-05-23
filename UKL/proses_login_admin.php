<?php
session_start();
$username = $_POST["username"];
$password = $_POST["password"];

//koneksi Database
$koneksi = mysqli_connect("localhost","root","","sewa_mobil");
$sql = "SELECT*FROM karyawan where username='$username' and password='$password'";
$result = mysqli_query($koneksi,$sql);
$jumlah = mysqli_num_rows($result);

if ($jumlah == 0) {
  $_SESSION["message"] = array(
    "type" => "danger",
    "message" => "Username/Password Salah"
  );
  // jika jumlah datanya = 0 maka username / password salah
  header("location:login_admin.php");
} else {
  //buat variabel session
  $_SESSION["session_karyawan"] = mysqli_fetch_array($result);
  header("location:template.php");
}

if (isset($_GET["logout"])) {
  // hapus sessionnya
  session_destroy();
  header("location:login_admin.php");
}

 ?>
