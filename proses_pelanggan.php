<?php session_start();

if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $koneksi = mysqli_connect("localhost","root","","sewa_mobil");
    $sql = "select * from pelanggan where username='$username' and password='$password'";
    $result = mysqli_query($koneksi,$sql);
    $jumlah = mysqli_num_rows($result);
    if ($jumlah == 0) {
        $_SESSION["message"] = array(
        "type" => "danger",
        "message" => "Username/Password Salah"
        );
        header("location:login_pelanggan.php");
    } else {
        $_SESSION["session_pelanggan"]=mysqli_fetch_array($result);
        $_SESSION["session_sewa"] = array();

        header("location:template_pelanggan.php?page=list_mobil");
    }
    if (isset($_GET["logout"])) {
        session_destroy();
        header("location:template_pelanggan.php");
    }
}
?>
