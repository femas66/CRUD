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
require_once 'koneksi.php';
session_start();
if (!isset($_SESSION['id'])) {
  header("location: login.php");
}
$q = $koneksi->query("SELECT * FROM agama WHERE id_agama = '$_GET[id]'");
$data = $q->fetch_array();
?>
  <div class="container">
    <h3>Edit data</h3><hr>
    <form action="" method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama lengkap</label>
        <input type="text" name="nama" placeholder="Nama lengkap" class="form-control" required id="nama" value="<?= $data['nama'] ?>">
      </div>
      <hr>
      <div class="form-check">
        <label for="l">Laki laki</label>
        <input type="radio" name="jk" id="l" value="L" class="form-check-input" <?= ($data['jenis_kelamin'] == 'L') ? "checked" : "" ?>>
      </div>
      <div class="form-check">
        <label for="p">Perempuan</label>
        <input type="radio" name="jk" id="p" value="P" class="form-check-input" <?= ($data['jenis_kelamin'] == 'P') ? "checked" : "" ?>>
      </div>
      <label for="a" class="form-label">Agama sekarang</label>
      <select class="form-select" aria-label="Default select example" id="a" name="agama">
        <option value="Islam" <?= ($data['agama'] == 'Islam') ? "selected" : "" ?>>Islam</option>
        <option value="Kristen" <?= ($data['agama'] == 'Kristen') ? "selected" : "" ?>>Kristen</option>
        <option value="Hindu" <?= ($data['agama'] == 'Hindu') ? "selected" : "" ?>>Hindu</option>
        <option value="Budha" <?= ($data['agama'] == 'Budha') ? "selected" : "" ?>>Budha</option>
        <option value="Konghucu" <?= ($data['agama'] == 'Konghucu') ? "selected" : "" ?>>Konghucu</option>
      </select>
      <label for="a" class="form-label">Agama sebelumnya</label>
      <select class="form-select" aria-label="Default select example" id="a" name="agama sebelumnya">
        <option value="Islam" <?= ($data['agama_sebelumnya'] == 'Islam') ? "selected" : "" ?>>Islam</option>
        <option value="Kristen" <?= ($data['agama_sebelumnya'] == 'Kristen') ? "selected" : "" ?>>Kristen</option>
        <option value="Hindu" <?= ($data['agama_sebelumnya'] == 'Hindu') ? "selected" : "" ?>>Hindu</option>
        <option value="Budha" <?= ($data['agama_sebelumnya'] == 'Budha') ? "selected" : "" ?>>Budha</option>
        <option value="Konghucu" <?= ($data['agama_sebelumnya'] == 'Konghucu') ? "selected" : "" ?>>Konghucu</option>
      </select>
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
  $nama = $_POST['nama'];
  $jk = $_POST['jk'];
  $agama = $_POST['agama'];
  $agama_sebelumnya = $_POST['agama_sebelumnya'];
  include 'koneksi.php';
  $a = $koneksi->query("UPDATE `agama` SET `nama`='$nama',`jenis_kelamin`='$jk',`agama`='$agama',`agama_sebelumnya`='$agama_sebelumnya' WHERE id_agama = '$_GET[id]'");
  ?>
  <script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil menyimpan',
        showConfirmButton: false,
        timer: 1000
      }).then(() => {
        window.location = 'halaman-agama.php';
      })
  </script>
  <?php
}