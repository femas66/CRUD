<html>
  <head>
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/83685fdc33.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      <label for="jb" class="form-label">Pekerjaan</label>
      <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="form-control" required id="jb">
    </div>
    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
    </div>
    
    <label for="a" class="form-label">Gaji perbulan</label>
    <select class="form-select" aria-label="Default select example" id="a" name="gaji">
      <option selected value="< 3.000.000">< 3.000.000</option>
      <option value="3.000.000 - 5.000.000">3.000.000 - 5.000.000</option>
      <option value="6.000.000 - 10.000.000">6.000.000 - 10.000.000</option>
      <option value="> 10.000.000">> 10.000.000</option>
    </select>
    <hr>
    <div class="mb-3">
      <button type="submit" name="submit" class="btn" style="background: #37306B; font-weight: bold; color:white; border-radius: 18px;"><i class="fa-solid fa-plus"></i> Tambah</button>
    </div>
  </form>
</div>
  </body>
</html>
<?php
if (isset($_POST['submit'])) {
  include 'koneksi.php';
  $nama = $_POST['nama'];
  $pekerjaan = $_POST['pekerjaan'];
  $alamat = $_POST['alamat'];
  $gaji = $_POST['gaji'];

  $a = $koneksi ->query("INSERT INTO `pekerjaan`(`nama`, `pekerjaan`, `alamat`, `gaji`) VALUES ('$nama', '$pekerjaan', '$alamat', '$gaji')");
  if ($a) {
    ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil menambah data',
        showConfirmButton: false,
        timer: 1000
      }).then(function () {
        window.location = "halaman-pekerjaan.php";
      })
    </script>
    <?php
  } else {
    ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal menambah data',
        showConfirmButton: false,
        timer: 1000
      }).then(function () {
        window.location = "halaman-pekerjaan.php";
      })
    </script>
    <?php
  }
}