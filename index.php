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
<section class="hero" id="home">

<div class="hero-text">

<h1>
Cafe & Food Store
</h1>

<p>
Best Cafe!!
</p>

</div>

</section>
<section class="menu-section" id="menu">

<h2 class="title">
🔥 Best Seller Menu
</h2>

<div class="product-container">

    <div class="product-card">
        <img src="uts1.jpg">

        <h3>Cappuccino Coffee</h3>

        <p class="price">
            Rp 25.000
        </p>

        <button onclick="pesan('Cappuccino Coffee')">
            Order Now
        </button>
    </div>

    <div class="product-card">
        <img src="uts5.jpg">

        <h3>Cheese Burger</h3>

        <p class="price">
            Rp 35.000
        </p>

        <button onclick="pesan('Cheese Burger')">
            Order Now
        </button>
    </div>

    <div class="product-card">
        <img src="uts4.jpg">

        <h3>Chocolate Cake</h3>

        <p class="price">
            Rp 40.000
        </p>

        <button onclick="pesan('Chocolate Cake')">
            Order Now
        </button>
    </div>

    <div class="product-card">
        <img src="uts2.jpg">

        <h3>Mini Pizza</h3>

        <p class="price">
            Rp 45.000
        </p>

        <button onclick="pesan('Mini Pizza')">
            Order Now
        </button>
    </div>

</div>

</section>

<div class="container">

<!-- FORM -->

<div class="card" id="crud">

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

<h2 class="title">
☕ Menu Cafe Kami
</h2>

<div class="produk-grid">

<?php

$query = mysqli_query(
$conn,
"SELECT * FROM produk"
);

while($row = mysqli_fetch_assoc($query)){

?>

<div class="produk-card">

    <img
    src="<?= $row['gambar']; ?>"
    alt="<?= $row['nama_produk']; ?>">

    <h3>
    <?= $row['nama_produk']; ?>
    </h3>

    <p>
    <?= $row['kategori']; ?>
    </p>

    <h4>
    Rp <?= number_format($row['harga'],0,',','.'); ?>
    </h4>

    <button
    type="button"
    onclick="pesan('<?= $row['nama_produk']; ?>')">
    Order Now
    </button>

    <div class="aksi">

        <a
        href="index.php?edit=<?= $row['id']; ?>#crud"
        class="btn-edit">
        Edit
        </a>

        <a
        href="index.php?hapus=<?= $row['id']; ?>"
        class="btn-delete"
        onclick="return confirm('Hapus data ini?')">
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
<script>

function pesan(namaProduk){
    alert("Pesanan berhasil ditambahkan ☕\nMenu: " + namaProduk);
}

</script>
</body>
</html>