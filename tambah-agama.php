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
    <hr>
    <div class="form-check">
      <label for="l">Laki laki</label>
      <input type="radio" name="jk" id="l" value="L" class="form-check-input">
    </div>
    <div class="form-check">
      <label for="p">Perempuan</label>
      <input type="radio" name="jk" id="p" value="P" class="form-check-input">
    </div>
    <label for="a" class="form-label">Agama sekarang</label>
    <select class="form-select" aria-label="Default select example" id="a" name="agama">
      <option selected value="Islam">Islam</option>
      <option value="Kristen">Kristen</option>
      <option value="Hindu">Hindu</option>
      <option value="Budha">Budha</option>
      <option value="Konghucu">Konghucu</option>
    </select>
    <label for="a" class="form-label">Agama sebelumnya</label>
    <select class="form-select" aria-label="Default select example" id="a" name="agama sebelumnya">
      <option selected value="Islam">Islam</option>
      <option value="Kristen">Kristen</option>
      <option value="Hindu">Hindu</option>
      <option value="Budha">Budha</option>
      <option value="Konghucu">Konghucu</option>
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
$nama = $_POST['nama'];
  $jk = $_POST['jk'];
  $agama = $_POST['agama'];
  $agama_sebelumnya = $_POST['agama_sebelumnya'];
  include 'koneksi.php';
  $a = $koneksi->query("INSERT INTO agama (nama, jenis_kelamin, agama, agama_sebelumnya) VALUES ('$nama', '$jk', '$agama', '$agama_sebelumnya')");
  ?>
  <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil menambah data',
        showConfirmButton: false,
        timer: 1000
      }).then(function () {
        window.location = "halaman-agama.php";
      })
    </script>
  <?php
}