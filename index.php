<?php
include 'koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// TAMBAH DATA
if(isset($_POST['simpan'])){

    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $gambar = $_POST['gambar'];

    mysqli_query($conn,
    "INSERT INTO produk
    (nama_produk,harga,kategori,gambar)

    VALUES(
    '$nama_produk',
    '$harga',
    '$kategori',
    '$gambar'
    )");

    header("Location:index.php");
    exit;
}

// HAPUS DATA
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($conn,
    "DELETE FROM produk
    WHERE id='$id'");

    header("Location:index.php");
    exit;
}

// EDIT
$dataEdit = null;

if(isset($_GET['edit'])){

    $id = $_GET['edit'];

    $query =
    mysqli_query($conn,
    "SELECT * FROM produk
    WHERE id='$id'");

    $dataEdit =
    mysqli_fetch_assoc($query);
}

// UPDATE
if(isset($_POST['update'])){

    $id = $_POST['id'];

    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];
    $gambar = $_POST['gambar'];

    mysqli_query($conn,
    "UPDATE produk SET

    nama_produk='$nama_produk',
    harga='$harga',
    kategori='$kategori',
    gambar='$gambar'

    WHERE id='$id'
    ");

    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Cafe Store</title>

<link rel="stylesheet"
href="cafe.css">

</head>

<body>

<!-- NAVBAR -->

<nav>

<div class="logo">
☕ CafeStore
</div>

<div class="menu">
<a href="#home">Home</a>
<a href="#menu">Menu</a>
<a href="#data">Data</a>
</div>

</nav>

<!-- HERO -->

<section class="hero" id="home">

<div class="hero-text">

<h1>
Cafe & Food Store
</h1>

<p>
Website E-Commerce Cafe
Dengan CRUD PHP & MySQL
</p>

</div>

</section>

<div class="container">

<!-- FORM -->

<div class="card" id="menu">

<h2>
<?= isset($dataEdit)
? "✏️ Edit Menu"
: "➕ Tambah Menu"; ?>
</h2>

<form method="POST">

<input
type="hidden"
name="id"

value="<?=
isset($dataEdit)
? $dataEdit['id']
: '';
?>">

<input
type="text"
name="nama_produk"
placeholder="Nama Menu"

value="<?=
isset($dataEdit)
? $dataEdit['nama_produk']
: '';
?>"

required>

<input
type="text"
name="harga"
placeholder="Harga"

value="<?=
isset($dataEdit)
? $dataEdit['harga']
: '';
?>"

required>

<input
type="text"
name="kategori"
placeholder="Kategori"

value="<?=
isset($dataEdit)
? $dataEdit['kategori']
: '';
?>"

required>

<input
type="text"
name="gambar"
placeholder="Link Gambar"

value="<?=
isset($dataEdit)
? $dataEdit['gambar']
: '';
?>"

required>

<?php if(isset($dataEdit)){ ?>

<button
type="submit"
name="update"
class="btn-update">

Update Menu
</button>

<?php } else { ?>

<button
type="submit"
name="simpan"
class="btn-save">

Tambah Menu
</button>

<?php } ?>

</form>

</div>

<!-- PRODUK -->

<div class="produk-grid">

<?php

$query =
mysqli_query(
$conn,
"SELECT * FROM produk"
);

while(
$row =
mysqli_fetch_assoc($query)
){

?>

<div class="produk-card">

<img src="<?= $row['gambar']; ?>">

<h3>
<?= $row['nama_produk']; ?>
</h3>

<p>
<?= $row['kategori']; ?>
</p>

<h4>
Rp <?= $row['harga']; ?>
</h4>

<div class="aksi">

<a
href="index.php?edit=
<?= $row['id']; ?>#menu"

class="btn-edit">

Edit
</a>

<a
href="index.php?hapus=
<?= $row['id']; ?>"

class="btn-delete"

onclick=
"return confirm(
'Hapus data ini?')">

Hapus
</a>

</div>

</div>

<?php } ?>

</div>

<!-- TABLE -->

<div class="card" id="data">

<h2>
📋 Data Menu Cafe
</h2>

<table>

<tr>
<th>ID</th>
<th>Nama</th>
<th>Harga</th>
<th>Kategori</th>
</tr>

<?php

$query2 =
mysqli_query(
$conn,
"SELECT * FROM produk"
);

while(
$data =
mysqli_fetch_assoc($query2)
){

?>

<tr>

<td><?= $data['id']; ?></td>
<td><?= $data['nama_produk']; ?></td>
<td><?= $data['harga']; ?></td>
<td><?= $data['kategori']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

<footer>
© 2026 CafeStore
</footer>

</body>
</html>