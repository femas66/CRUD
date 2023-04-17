<html>
  <head>
    <title>CRUd</title>
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

$q = $koneksi->query("SELECT * FROM vaksin WHERE id_vaksin = '$_GET[id]'");
$data = $q->fetch_assoc();
?>
<div class="container">
<h3>Edit data</h3><hr>
<form action="" method="post">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama lengkap</label>
      <input type="text" name="nama" placeholder="Nama lengkap" class="form-control" required id="nama" value="<?= $data['nama'] ?>">
    </div>
    <div class="mb-3">
      <label for="jb" class="form-label">NIK</label>
      <input type="number" name="nik" placeholder="Nik" class="form-control" required id="jb" value="<?= $data['nik'] ?>">
    </div>
    <div class="mb-3">
      <label for="jb" class="form-label">Usia</label>
      <input type="number" name="usia" placeholder="Usia" class="form-control" required id="jb" value="<?= $data['usia'] ?>">
    </div>
    <hr>
    <div class="form-check">
      <label for="l">Sudah vaksin</label>
      <input type="radio" name="vaksin" id="l" value="Y" class="form-check-input" <?= ($data['vaksin'] == 'Y') ? "checked" : "" ?>>
    </div>
    <div class="form-check">
      <label for="p">Belum vaksin</label>
      <input type="radio" name="vaksin" id="p" value="N" class="form-check-input" <?= ($data['vaksin'] == 'N') ? "checked" : "" ?>>
    </div>
    <hr>
    <div class="mb-3">
      <button type="submit" name="submit" class="btn" style="background: #37306B; font-weight: bold; color:white; border-radius: 18px;"><i class="fa-solid fa-floppy-disk"></i>  Simpan</button>
    </div>
  </form>
</div>
  </body>
</html>
<?php
if (isset($_POST['submit'])) {
  include 'koneksi.php';
  $nama = $_POST['nama'];
  $nik = $_POST['nik'];
  $usia = $_POST['usia'];
  $vaksin = $_POST['vaksin'];
  try {
    $a = $koneksi->query("UPDATE `vaksin` SET `nama`='$nama',`nik`='$nik',`usia`='$usia',`vaksin`='$vaksin' WHERE `id_vaksin`='$_GET[id]'");
    ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil menyimpan',
        showConfirmButton: false,
        timer: 1000
      }).then(() => {
        window.location = 'halaman-vaksin.php';
      })
    </script>
    <?php
  } catch (Exception $e) {
    ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'NIK sudah digunakan',
        showConfirmButton: false,
        timer: 1000
      })
    </script>
    <?php
    return;
  }
}
?>