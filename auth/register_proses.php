<?php

session_start();

// masukkan file koneksi.php
require 'config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // ambil nilai input fullname
    $fullname = htmlspecialchars($_POST['fullname']);
      // ambil nilai input email
    $email = htmlspecialchars($_POST['email']);
      // ambil nilai input password
    $password = htmlspecialchars($_POST['password']);
      // ambil nilai input password_confirm
    $password_confirm = htmlspecialchars($_POST['password_confirm']);

    // Variabel peanampung error validasi
    $eror = [];

    // pengecekan input fullname tidak boleh kosong
    if (empty($fullname)) {
        $eror['fullname'] = "Fullname is required";
    }
     // pengecekan input email tidak boleh kosong
    if (empty($email)) {
        $eror['email'] = "email is required";
    }
     // pengecekan input password tidak boleh kosong
    if (empty($password)) {
        $eror['password'] = "password is required";
    }
     // pengecekan input password_confirm tidak boleh kosong
    if (empty($password_confirm)) {
        $eror['password_confirm'] = "password confirm is required";
    }

    // pengecekan input password dan password_confirm
    if ($password != $password_confirm) {
        $eror['password _confirm'] = "password and confirm password do not match";
    }

    // Apabila ada eror kirm pesan eror ke index.php
    if(!empty($eror)) {
        $_SESSION['eror'] = $eror;
        $_SESSION['old'] = [

          "fullname" => $fullname,
          "email" => $email,
          "password" => $password,
        
        ];
        echo "<meta http-equiv='refresh' content='3;url=index.php'>";
    }

    // jika tidak ada eror disetiap input simpan data register ke table user
    if (empty($eror)) {
      // mengubah password di inputkan menjadi karakter random 255z
      $hash_password = password_hash($password, PASSWORD_DEFAULT);
      $query = "INSERT INTO users( fullname, email, password) VALUES ('$fullname','$email','$hash_password')";
    }

    // simpan data dengan memproses query diatas
    if (mysqli_query($conn, $query)) {
      echo "<meta http-equiv='refresh' content='1;url=login.php'>";
    }else{
      echo "Error : " . mysqli_error($conn);
    }
}


?>