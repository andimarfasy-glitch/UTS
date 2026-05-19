<?php
include 'koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// TAMBAH DATA
if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    mysqli_query($conn,
    "INSERT INTO user
    (nama, username, email, password)

    VALUES(
    '$nama',
    '$username',
    '$email',
    '$password'
    )");

    header("Location:index.php");
    exit;
}

// HAPUS DATA
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($conn,
    "DELETE FROM user
    WHERE id='$id'");

    header("Location:index.php");
    exit;
}

// EDIT DATA
$dataEdit = null;

if(isset($_GET['edit'])){

    $id = $_GET['edit'];

    $query = mysqli_query($conn,
    "SELECT * FROM user
    WHERE id='$id'");

    $dataEdit = mysqli_fetch_assoc($query);
}

// UPDATE DATA
if(isset($_POST['update'])){

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    mysqli_query($conn,
    "UPDATE user SET

    nama='$nama',
    username='$username',
    email='$email',
    password='$password'

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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>MyStore E-Commerce</title>

<style>

html{
    scroll-behavior:smooth;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;
}

body{
    background:#f4f6f9;
}

/* NAVBAR */

nav{
    background:#6c63ff;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 8%;
    position:sticky;
    top:0;
    z-index:1000;
}

.logo{
    color:white;
    font-size:30px;
    font-weight:bold;
}

.menu a{
    text-decoration:none;
    color:white;
    margin-left:25px;
    font-size:18px;
    transition:.3s;
}

.menu a:hover{
    color:#ffd700;
}

/* HERO */

.hero{
    background:
    linear-gradient(
    rgba(0,0,0,.5),
    rgba(0,0,0,.5)
    ),

    url('https://images.unsplash.com/photo-1556740749-887f6717d7e4?auto=format&fit=crop&w=1400&q=80');

    background-size:cover;
    background-position:center;

    height:400px;

    display:flex;
    justify-content:center;
    align-items:center;
    text-align:center;

    color:white;
}

.hero h1{
    font-size:55px;
}

.hero p{
    margin-top:15px;
    font-size:20px;
}

/* CONTAINER */

.container{
    width:90%;
    margin:50px auto;
}

/* CARD */

.card{
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:
    0 10px 20px
    rgba(0,0,0,.1);

    margin-bottom:40px;
}

.card h2{
    margin-bottom:25px;
    color:#333;
}

/* FORM */

input{
    width:100%;
    padding:15px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:10px;
    font-size:16px;
}

input:focus{
    outline:none;
    border-color:#6c63ff;
}

button{
    border:none;
    padding:15px 25px;
    border-radius:10px;
    color:white;
    cursor:pointer;
    font-size:16px;
}

.btn-save{
    background:#28a745;
}

.btn-update{
    background:#ff9800;
}

/* TABLE */

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#6c63ff;
    color:white;
    padding:15px;
}

table td{
    padding:15px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f8f8f8;
}

.btn-edit{
    background:#ffc107;
    color:black;
    padding:8px 15px;
    border-radius:8px;
    text-decoration:none;
}

.btn-delete{
    background:#dc3545;
    color:white;
    padding:8px 15px;
    border-radius:8px;
    text-decoration:none;
}

.btn-edit:hover,
.btn-delete:hover{
    opacity:.8;
}

/* FOOTER */

footer{
    background:#222;
    color:white;
    text-align:center;
    padding:20px;
}

/* RESPONSIVE */

@media(max-width:768px){

nav{
    flex-direction:column;
}

.menu{
    margin-top:15px;
}

.menu a{
    display:block;
    margin:10px 0;
}

.hero h1{
    font-size:35px;
}

table{
    font-size:14px;
}

}

</style>
</head>

<body>

<!-- NAVBAR -->

<nav>

<div class="logo">
MyStore
</div>

<div class="menu">
<a href="#home">Home</a>
<a href="#produk">Produk</a>
<a href="#pelanggan">Pelanggan</a>
</div>

</nav>

<!-- HOME -->

<section class="hero" id="home">

<div>
<h1>
Selamat Datang di MyStore
</h1>

<p>
Website E-Commerce Sederhana
Dengan CRUD PHP & MySQL
</p>
</div>

</section>

<div class="container">

<!-- PRODUK / FORM -->

<div class="card" id="produk">

<h2>
<?= isset($dataEdit)
? "✏️ Edit Pelanggan"
: "➕ Tambah Pelanggan"; ?>
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
name="nama"
placeholder="Masukkan Nama"

value="<?=
isset($dataEdit)
? $dataEdit['nama']
: '';
?>"

required>

<input
type="text"
name="username"
placeholder="Masukkan Username"

value="<?=
isset($dataEdit)
? $dataEdit['username']
: '';
?>"

required>

<input
type="email"
name="email"
placeholder="Masukkan Email"

value="<?=
isset($dataEdit)
? $dataEdit['email']
: '';
?>"

required>

<input
type="password"
name="password"
placeholder="Masukkan Password"

value="<?=
isset($dataEdit)
? $dataEdit['password']
: '';
?>"

required>

<?php if(isset($dataEdit)){ ?>

<button
type="submit"
name="update"
class="btn-update">

Update Data
</button>

<?php } else { ?>

<button
type="submit"
name="simpan"
class="btn-save">

Simpan Data
</button>

<?php } ?>

</form>

</div>

<!-- PELANGGAN -->

<div class="card" id="pelanggan">

<h2>
📋 Data Pelanggan
</h2>

<table>

<tr>
<th>ID</th>
<th>Nama</th>
<th>Username</th>
<th>Email</th>
<th>Password</th>
<th>Aksi</th>
</tr>

<?php
$query =
mysqli_query(
$conn,
"SELECT * FROM user"
);

while(
$row =
mysqli_fetch_assoc($query)
){
?>

<tr>

<td><?= $row['id']; ?></td>
<td><?= $row['nama']; ?></td>
<td><?= $row['username']; ?></td>
<td><?= $row['email']; ?></td>
<td><?= $row['password']; ?></td>

<td>

<a
class="btn-edit"

href="index.php?edit=
<?= $row['id']; ?>#produk">

Edit
</a>

<a
class="btn-delete"

href="index.php?hapus=
<?= $row['id']; ?>"

onclick=
"return confirm(
'Yakin ingin hapus data?')">

Hapus
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<footer>
© 2026 MyStore E-Commerce
</footer>

</body>
</html>