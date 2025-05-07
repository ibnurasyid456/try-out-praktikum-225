<?php

// halaman ini untuk mengkoneksikan php my admin dengan website

$host = "localhost";
$user = "root";
$pass = "";
$db = "tryout";

$conn = mysqli_connect($host, $user,$pass, $db);

if (!$conn) {
    die("koneksi gagal " . mysqli_connect_error());
}