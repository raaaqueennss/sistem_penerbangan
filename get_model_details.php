<?php
// Sambungkan ke database
include "koneksi.php";

// Ambil nilai model dari permintaan GET
$selectedModel = $_GET['model'];

// Query untuk mendapatkan informasi terkait model
$sql = "SELECT Dari, Tujuan, Harga FROM informasipesawat WHERE Model = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $selectedModel);
$stmt->execute();
$result = $stmt->get_result();

if ($result === FALSE) {
    die("Error in query: " . $conn->error);
}

// Ambil data dan kembalikan dalam format JSON
if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode(array()); // Kembalikan array kosong jika data tidak ditemukan
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>
