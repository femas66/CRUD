<html>
  <head>
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/83685fdc33.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/x-icon" href="img/logo.ico">
  </head>
  <body>

  <?php
include 'koneksi.php';
session_start();
if (!isset($_SESSION['id'])) {
  header("location: login.php");
}

?>
<div class="container">
<h3>Tambah data</h3><hr>
<form action="" method="post">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama lengkap</label>
      <input type="text" name="nama" placeholder="Nama lengkap" class="form-control" required id="nama">
    </div>
    <div class="mb-3">
      <label for="jb" class="form-label">Usia</label>
      <input type="number" name="usia" placeholder="Usia" class="form-control" required id="jb">
    </div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="floatingInput" placeholder="Hobi" name="hobi">
      <label for="floatingInput">Hobi</label>
    </div>
    <hr>
    <div class="mb-3">
    <button type="submit" name="submit" class="btn" style="background: #37306B; font-weight: bold; color:white; border-radius: 18px;"><i class="fa-solid fa-plus"></i> Tambah</button>
    </div>
  </form>
</div>
  </body>
</html>
<?php
if (isset($_POST['kembali'])) {
  header("location: halaman-hobi.php");
}
if (isset($_POST['submit'])) {
  $nama = $_POST['nama'];
  $usia = $_POST['usia'];
  $hobi = $_POST['hobi'];

  include 'koneksi.php';
  $a = $koneksi->query("INSERT INTO hobi (nama, usia, hobi) VALUES ('$nama', '$usia', '$hobi')");
  ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil menambah data',
        showConfirmButton: false,
        timer: 1000
      }).then(function () {
        window.location = "halaman-hobi.php";
      })
  </script>
  <?php

}