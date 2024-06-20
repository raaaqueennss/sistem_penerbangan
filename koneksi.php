<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "sistempenerbangan_sittirohani222061";

    // Membuat koneksi
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Memeriksa koneksi
    if (!$conn) {   
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Fungsi untuk menghindari SQL injection
    function escapeString($conn, $value) {
        return mysqli_real_escape_string($conn, $value);
    }

 ?>