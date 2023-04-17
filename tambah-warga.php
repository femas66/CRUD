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
<h3>Tambah data</h3><hr><form action="" method="post" enctype="multipart/form-data">
<div class="mb-3">
  <label for="nama" class="form-label">Nama lengkap</label>
  <input type="text" name="nama" placeholder="Nama" class="form-control" required id="nama">
</div>
<div class="mb-3">
  <label for="foto" class="form-label">Foto</label>
  <input type="file" name="foto" id="foto" class="form-control" required>
</div>
<hr>
<div class="form-check">
  <label for="lbb">Sudah nikah</label>
  <input type="radio" name="nikah" id="lbb" value="Y" class="form-check-input">
</div>
<div class="form-check">
  <label for="pbb">Belum nikah</label>
  <input type="radio" name="nikah" id="pbb" value="N" class="form-check-input">
</div>
<hr>
<div class="form-check">
  <input class="form-check-input" type="radio" name="jk" id="flexRadioDefault1" value="L">
  <label class="form-check-label" for="flexRadioDefault1">
    Laki Laki
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="jk" id="flexRadioDefault2" value="P">
  <label class="form-check-label" for="flexRadioDefault2">
    Perempuan
  </label>
</div>
<hr>
<div class="mb-3">
  <label for="tanggal" class="form-label">Tanggal lahir</label>
  <input type="date" name="tanggal_lahir" class="form-control" required id="tanggal" data-date-format="DD MMMM YYYY">
</div>
<div class="mb-3">
  <button type="submit" name="submit" class="btn" style="background: #37306B; font-weight: bold; color:white; border-radius: 18px;"><i class="fa-solid fa-plus"></i> Tambah</button>
</div>
</form>
</div>
<?php

if (isset($_POST['submit'])) {
  //var_dump($_POST);
  include 'koneksi.php';
  $nama = $_POST['nama'];
  $nikah;
  if (isset($_POST['nikah'])) {
    $nikah = 'Y';
  } else {
    $nikah = 'N';
  }
  $jenis_kelamin = $_POST['jk'];
  $tanggal_lahir = date('d-m-Y', strtotime($_POST['tanggal_lahir']));
  $foto = $_FILES['foto']['name'];
  
  $folder_gambar = "gambar/";
  $pp = time() . $_FILES["foto"]["name"];
  $target_file = $folder_gambar . basename($pp);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    ?>
    <script>
      alert('Hanya jpg, png dan jpeg');
    </script>
    <?php
    return;
  }
  if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
    $a = $koneksi -> query("INSERT INTO warga (nama, foto, nikah, jenis_kelamin, tanggal_lahir) VALUES ('$nama', '$pp','$nikah', '$jenis_kelamin', '$tanggal_lahir')");
    if ($a) {
      ?>
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Berhasil menyimpan data',
          showConfirmButton: false,
          timer: 1500
        }).then(function () {
          window.location = 'index.php';
        })
        
      </script>
      <?php
    }
    
  } else {
    echo "Gagal mengunggah gambar.";
  }
}
?>
  </body>
</html>