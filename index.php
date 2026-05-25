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

