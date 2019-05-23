<?php session_start();

if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $koneksi = mysqli_connect("localhost","root","","sewa_mobil");
    $sql = "select * from karyawan where username='$username' and password='$password'";
    $result = mysqli_query($koneksi,$sql);
    $jumlah = mysqli_num_rows($result);
    if ($jumlah == 0) {
        $_SESSION["message"] = array(
        "type" => "danger",
        "message" => "Username/Password Salah"
        );
        header("location:login_karyawan.php");
    } else {
        $_SESSION["session_karyawan"]=mysqli_fetch_array($result);
        header("location:template_karyawan.php");
    }
    if (isset($_GET["logout"])) {
        session_destroy();
        header("location:template_karyawan.php");
    }
}
?>
