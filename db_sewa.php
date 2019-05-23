<?php session_start();
$koneksi = mysqli_connect("localhost","root","","sewa_mobil");
if (isset($_GET["id_mobil"])) {
  $id_mobil = $_GET["id_mobil"];
  $sql = "select * from mobil where id_mobil='$id_mobil'";
  $result = mysqli_query($koneksi,$sql);
  $hasil = mysqli_fetch_array($result);

  if (!in_array($hasil,$_SESSION["session_sewa"])) {
    array_push($_SESSION["session_sewa"],$hasil);
  }
  header("location:template_pelanggan.php?page=list_mobil");

}
if (isset($_GET["checkout"])) {
  $id_sewa = rand(1,10000).date("dmY");
  $id_pelanggan = $_SESSION["session_pelanggan"]["id_pelanggan"];
  $tgl_sewa = date("Y-m-d");
  $sql = "insert into sewa values('$id_sewa','$id_pelanggan','$tgl_sewa')";
  if (mysqli_query($koneksi,$sql)) {
    foreach ($_SESSION["session_sewa"] as $hasil){
      $id_mobil = $hasil["id_mobil"];
      $jumlah = $_POST["jumlah".$hasil["id_mobil"]];
      $harga_sewa = $hasil["harga"];
      $sql = "insert into detail_sewa
      values('$id_sewa','$id_mobil','$jumlah','$harga_sewa')";
      mysqli_query($koneksi,$sql);
    }
    $_SESSION["session_sewa"] = array();
      header("location:template_pelanggan.php?page=nota&id_sewa=$id_sewa");
  }else{
    echo mysqli_error($koneksi);
  }
}
if (isset($_GET["hapus"])) {
  $id_mobil = $_GET["id_mobil"];
  $index = array_search($id_mobil,array_column($_SESSION["session_sewa"],"id_mobil"));
  array_splice($_SESSION["session_sewa"], $index ,1);
  header("location:template_pelanggan.php?page=list_sewa");
}
 ?>
