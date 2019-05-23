<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","sewa_mobil");

if (isset($_POST["action"])) {
  $id_mobil = $_POST["id_mobil"];
  $nomor_mobil = $_POST["nomor_mobil"];
  $merk = $_POST["merk"];
  $jenis = $_POST["jenis"];
  $warna = $_POST["warna"];
  $tahun_pembuatan = $_POST["tahun_pembuatan"];
  $biaya_sewa_per_hari = $_POST["biaya_sewa_per_hari"];

  if ($_POST["action"] == "insert") {
    $path = pathinfo($_FILES["image"]["name"]);
    $ekstensi = $path["extension"];
    $filename = $id_mobil."-".rand(1,1000).".".$ekstensi;

    $sql = "insert into mobil values ('$id_mobil', '$nomor_mobil', '$merk', '$jenis', '$warna', '$tahun_pembuatan', '$biaya_sewa_per_hari', '$filename')";
    if (mysqli_query($koneksi,$sql)) {
      move_uploaded_file($_FILES["image"]["tmp_name"],"image_mobil/".$filename);
      $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Insert data has been success"
      );
    }
    header("location:template_karyawan.php?page=mobil");
  }elseif ($_POST["action"] == "update") {
    if (!empty($_FILES["image"]["name"])) {
      $sql = "select * from mobil where id_mobil='$id_mobil'";
      $result = mysqli_query($koneksi,$sql);
      $hasil = mysqli_fetch_array($result);

      if (file_exists("image_mobil/".$hasil["image"])) {
          unlink("image_mobil/".$hasil["image"]);
      }

      $path = pathinfo($_FILES["image"]["name"]);
      $ekstensi = $path["extension"];
      $filename = $id_mobil."-".rand(1,1000).".".$ekstensi;
      $sql = "update mobil set nomor_mobil='$nomor_mobil', merk='$merk', jenis='$jenis', warna='$warna', tahun_pembuatan='$tahun_pembuatan', biaya_sewa_per_hari='$biaya_sewa_per_hari', image='$filename' where id_mobil='$id_mobil'";
      if (mysqli_query($koneksi,$sql)) {
        move_uploaded_file($_FILES["image"]["tmp_name"],"image_mobil/".$filename);
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "update data has been success"
        );
      }else{
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }
    }else{
      $sql = "update mobil set nomor_mobil='$nomor_mobil', merk='$merk', jenis='$jenis', warna='$warna', tahun_pembuatan='$tahun_pembuatan', biaya_sewa_per_hari='$biaya_sewa_per_hari' where id_mobil='$id_mobil'";
      if (mysqli_query($koneksi,$sql)) {
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
    header("location:template_karyawan.php?page=mobil");
  }
}




if (isset($_GET["hapus"])) {
  $id_mobil = $_GET["id_mobil"];
  $sql = "select * from mobil where id_mobil='$id_mobil'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($reslut);
  if (file_exists("image_mobil/".$hasil["image"])) {
    unlink("image_mobil/".$hasil["image"]);
  }

  $sql = "delete from mobil where id_mobil='$id_mobil'";
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
  header("location:template_karyawan.php?page=mobil");
}
?>
