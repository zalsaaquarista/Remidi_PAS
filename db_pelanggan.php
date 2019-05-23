<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "sewa_mobil");

if (isset($_POST["action"])){
    $id_pelanggan = $_POST["id_pelanggan"];
    $nama_pelanggan = $_POST["nama_pelanggan"];
    $alamat_pelanggan = $_POST["alamat_pelanggan"];
    $kontak = $_POST["kontak"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($_POST["action"] == "insert"){
        $path = pathinfo($_FILES["image"]["name"]);
        $ekstensi = $path["extension"];
        $filename = $id_pelanggan."-".rand(1,1000).".".$ekstensi;

        $sql = "insert into pelanggan values ('$id_pelanggan','$nama_pelanggan', '$alamat_pelanggan', '$kontak', '$username', '$password', '$filename')";
        if(mysqli_query($koneksi,$sql)){
            move_uploaded_file($_FILES["image"]["tmp_name"],"image_pelanggan/".$filename);
            $_SESSION["message"] = array(
                "type" => "success",
                "message" => "Insert data has been success"
            );
        }else{
            $_SESSION["message"] = array(
                "type" => "danger",
                "message" => mysqli_error($koneksi)
            );
        }
        header("location:template_karyawan.php?page=pelanggan");
    }elseif ($_POST["action"] == "update") {
        if (!empty($_FILES["image"]["name"])) {
            $sql = "select * from pelanggan where id_pelanggan='$id_pelanggan'";
            $result = mysqli_query($koneksi,$sql);
            $hasil = mysqli_fetch_array($result);
            if (file_exists("image_pelanggan/".$hasil["image"])){
                unlink("image_pelanggan/".$hasil["image"]);
            }

            $path = pathinfo($_FILES["image"]["name"]);
            $ekstensi = $path["extension"];
            $filename = $id_pelanggan."-".rand(1,1000).".".$ekstensi;
            $sql = "update pelanggan set nama_pelanggan='$nama_pelanggan', alamat_pelanggan='$alamat_pelanggan', kontak='$kontak', username='$username', password='$password', image='$filename' where id_pelanggan='$id_pelanggan'";
            if (mysqli_query($koneksi, $sql)) {
                move_uploaded_file($_FILES["image"]["tmp_name"],"image_pelanggan/".$filename);
                $_SESSION["message"] = array(
                    "type" => "success",
                    "message" => "Update data has been success"
                );
            }else{
                $_SESSION["message"] = array(
                    "type" => "danger",
                    "message" => mysqli_error($koneksi)
                );
            }
        }else{
            $sql = "update pelanggan set nama_pelanggan='$nama_pelanggan', alamat_pelanggan='$alamat_pelanggan', kontak='$kontak', username='$username', password='$password' where id_pelanggan='$id_pelanggan'";
            if (mysqli_query($koneksi, $sql)) {
                $_SESSION["message"] = array(
                    "type" => "success",
                    "message" => "Update data has been success"
                );
            }else{
                $_SESSION["message"] = array(
                    "type" => "danger",
                    "message" => mysqli_error($koneksi)
                );
            }
        }
        header("location:template_karyawan.php?page=pelanggan");
    }
}

if(isset($_GET["hapus"])){
    $id_pelanggan =$_GET["id_pelanggan"];
    $sql = "select * from pelanggan where id_pelanggan='$id_pelanggan'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    if(file_exists("image_pelanggan/".$hasil["image"])){
        unlink("image_pelanggan/".$hasil["image"]);
    }
    $sql = "delete from pelanggan where id_pelanggan='$id_pelanggan'";
    if (mysqli_query($koneksi,$sql)) {
        $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Data has been deleted"
        );
    }else{
        $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
    );
}
header("location:template_karyawan.php?page=pelanggan");
}
?>
