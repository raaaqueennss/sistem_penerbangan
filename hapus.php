<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $idRegistrasi = $_GET['id'];

    // Query untuk menghapus data pesawat berdasarkan ID Registrasi
    $sql = "DELETE FROM InformasiPesawat WHERE IdRegistrasi = '$idRegistrasi'";

    // Periksa apakah query berhasil dijalankan
    if ($conn->query($sql) === TRUE) {
        $pesanSukses = "Data berhasil dihapus!";
        echo "<script>
                alert('$pesanSukses');
                window.location.href='form info pesawat.php';
              </script>";
    } else {
        $pesanError = "Error: " . $sql . "<br>" . $conn->error;
        echo "<script>
                alert('$pesanError');
                window.location.href='form info pesawat.php';
              </script>";
    }
} else {
    // Jika ID Registrasi tidak ditemukan, set pesan error
    $pesanError = "ID Registrasi tidak ditemukan!";
    echo "<script>
            alert('$pesanError');
            window.location.href='form info pesawat.php';
          </script>";
}

// Tutup koneksi
$conn->close();
?>
