<?php
// update_status.php

require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID'])) {
    $id_pesawat = $_POST['ID'];

    // Lakukan update status pembayaran menjadi "Lunas" dengan menggunakan prepared statement
    $updateQuery = "UPDATE pemesananpesawat SET StatusPembayaran = 'Lunas' WHERE ID = ?";

    // Persiapkan statement
    $stmt = $conn->prepare($updateQuery);

    // Periksa apakah persiapan statement berhasil
    if ($stmt === false) {
        echo "error";
        die("Preparation failed: " . $conn->error);
    }

    // Ikat parameter ke statement
    $stmt->bind_param("i", $id_pesawat);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
        // Tampilkan pesan kesalahan SQL jika diperlukan
        // echo "Error: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "error";
}
?>
