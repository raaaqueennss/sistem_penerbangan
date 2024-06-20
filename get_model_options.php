<?php
// Sambungkan ke database
include "koneksi.php"; // Sesuaikan dengan nama file koneksi Anda

// Ambil nilai pesawat dari permintaan GET
$selectedPesawat = $_GET['pesawat'];

// Query untuk mendapatkan model sesuai dengan pesawat yang dipilih
$sql = "SELECT Model FROM informasipesawat WHERE NamaPesawat = '$selectedPesawat'";
$result = $conn->query($sql);

if ($result === FALSE) {
    die("Error in query: " . $conn->error);
}

// Simpan model dalam array
$models = array();
while ($row = $result->fetch_assoc()) {
    $models[] = $row['Model'];
}

// Kembalikan daftar model dalam format JSON
echo json_encode($models);
?>
