<?php

require 'koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Inisialisasi variabel Model
$selected_Model = "";

// Periksa apakah formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $IdPesawat = isset($_POST['IdPesawat']) ? $_POST['IdPesawat'] : "";
    $NamaPenumpang = isset($_POST['NamaPenumpang']) ? $_POST['NamaPenumpang'] : "";
    $EmailPenumpang = isset($_POST['EmailPenumpang']) ? $_POST['EmailPenumpang'] : "";
    $NomorTelepon = isset($_POST['NomorTelepon']) ? $_POST['NomorTelepon'] : "";
    $JumlahPenumpang = isset($_POST['JumlahPenumpang']) ? $_POST['JumlahPenumpang'] : "";
    $TanggalPemesanan = isset($_POST['TanggalPemesanan']) ? $_POST['TanggalPemesanan'] : "";
    $TanggalKeberangkatan = isset($_POST['TanggalKeberangkatan']) ? $_POST['TanggalKeberangkatan'] : "";
    $Dari = isset($_POST['Dari']) ? $_POST['Dari'] : "";
    $Tujuan = isset($_POST['Tujuan']) ? $_POST['Tujuan'] : "";
    $TotalHarga = isset($_POST['TotalHarga']) ? $_POST['TotalHarga'] : "";

    // Ambil nilai Model berdasarkan pilihan pesawat
    if (isset($_POST['IdPesawat'])) {
        $selected_NamaPesawat = $_POST['IdPesawat'];
        $sql_model = "SELECT DISTINCT Model FROM InformasiPesawat WHERE NamaPesawat = '$selected_NamaPesawat'";
        $result_model = $conn->query($sql_model);

        // Periksa apakah hasil query mengandung data
        if ($result_model->num_rows > 0) {
            $row_model = $result_model->fetch_assoc();
            $selected_Model = $row_model['Model'];
        }
    }

    // Query untuk menyimpan data ke dalam tabel
    $sql = "INSERT INTO BookingPesawat (IdPesawat, Model, NamaPenumpang, EmailPenumpang, NomorTelepon, JumlahPenumpang, TanggalPemesanan, TanggalKeberangkatan, Dari, Tujuan, TotalHarga) 
            VALUES ('$IdPesawat', '$selected_Model', '$NamaPenumpang', '$EmailPenumpang', '$NomorTelepon', '$JumlahPenumpang', '$TanggalPemesanan', '$TanggalKeberangkatan', '$Dari', '$Tujuan', '$TotalHarga')";

    // Periksa apakah query berhasil dijalankan
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Query untuk mengambil data dari tabel InformasiPesawat
$sql_pesawat = "SELECT * FROM InformasiPesawat";
$result_pesawat = $conn->query($sql_pesawat);

// Tutup koneksi
$conn->close();

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
            background-color: black;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('IMG/walinfo000.jpg');
            background-size: cover;
            background-position: center;
            z-index: -1;
            opacity: 0.5;
            filter: blur(3px);
            /* Add the blur effect with 3 pixels */
        }

        .booking {
            max-width: 600px;
            margin: 20px auto;
            background-color: rgba(136, 171, 142, 0.5);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .judul {
            text-align: center;
            margin-bottom: 5px;
            /* Ubah margin-bottom sesuai kebutuhan */
        }

        h2 {
            color: #F2F1EB;
            margin: 0;
            /* Hilangkan margin atas dan bawah default untuk h2 */
            font-family: 'Domine', serif;
        }

        .desk {
            text-align: center;
            margin-bottom: 5px;
            /* Ubah margin-bottom sesuai kebutuhan */
        }

        p {
            color: #F2F1EB;
            margin: 0;
            /* Hilangkan margin atas dan bawah default untuk p */
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #555;
            color: #fff;
        }

        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #AFC8AD;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="tel"],
        form input[type="number"],
        form input[type="datetime-local"] {

            background-color: #AFC8AD;
            color: black;
        }

        form input[type="text"]:focus,
        form input[type="email"]:focus,
        form input[type="tel"]:focus,
        form input[type="number"]:focus,
        form input[type="datetime-local"]:focus,
        form textarea:focus {
            background-color: #85B085;
            /* Warna latar belakang ketika mendapatkan fokus */
            outline: none;
            /* Hapus garis bantu default */
            border: 2px solid #5A8B5A;
            /* Gaya border ketika mendapatkan fokus */
        }


        input[type="submit"] {
            background: linear-gradient(45deg, #88AB8E, #AFC8AD);
            color: black;
            border: none;
            font-family: 'Domine', serif;
            font-size: 20px;
            margin-top: 10px;
            /* Tambahkan margin ke atas */
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            cursor: pointer;
        }

        /* Optional: Add styles for form responsiveness */
        @media only screen and (max-width: 600px) {
            .booking {
                max-width: 90%;
            }
        }
    </style>
    <title>Formulir Pemesanan Pesawat</title>
</head>

<body>

    <div class="booking">
        <div class="judul">
            <h2>Formulir Pemesanan Pesawat</h2>
        </div>
        <div class="desk">
            <p>Travel Sitti Rohani</p>
        </div>
        <form action="" method="post">
            <!-- IdPesawat -->
            <label for="IdPesawat">Pilih Pesawat:</label>
            <select id="IdPesawat" name="IdPesawat" required>
                <?php
                // Tampilkan data pesawat ke dalam dropdown
                while ($row_pesawat = $result_pesawat->fetch_assoc()) {
                    echo "<option value='" . $row_pesawat['NamaPesawat'] . "'>" . $row_pesawat['NamaPesawat'] . "</option>";
                }
                ?>
            </select><br>

            <label for="Model">Pilih Model:</label>
            <select id="Model" name="Model" required>
                <!-- Tambahkan opsi model sesuai dengan kebutuhan -->
            </select><br>

            <!-- NamaPenumpang -->
            <label for="NamaPenumpang">Nama Penumpang:</label>
            <input type="text" id="NamaPenumpang" name="NamaPenumpang" required><br>

            <!-- EmailPenumpang -->
            <label for="EmailPenumpang">Email Penumpang:</label>
            <input type="email" id="EmailPenumpang" name="EmailPenumpang" required><br>

            <!-- NomorTelepon -->
            <label for="NomorTelepon">Nomor Telepon:</label>
            <input type="tel" id="NomorTelepon" name="NomorTelepon" required><br>

            <!-- JumlahPenumpang -->
            <label for="JumlahPenumpang">Jumlah Penumpang:</label>
            <input type="number" id="JumlahPenumpang" name="JumlahPenumpang" required><br>

            <!-- TanggalPemesanan -->
            <label for="TanggalPemesanan">Tanggal Pemesanan:</label>
            <input type="datetime-local" id="TanggalPemesanan" name="TanggalPemesanan" required><br>

            <!-- TanggalKeberangkatan -->
            <label for="TanggalKeberangkatan">Tanggal Keberangkatan:</label>
            <input type="datetime-local" id="TanggalKeberangkatan" name="TanggalKeberangkatan" required><br>

            <!-- Dari -->
            <label for="Dari">Dari:</label>
            <input type="text" id="Dari" name="Dari" required><br>

            <!-- Tujuan -->
            <label for="Tujuan">Tujuan:</label>
            <input type="text" id="Tujuan" name="Tujuan" required><br>

            <!-- TotalHarga -->
            <label for="TotalHarga">Total Harga:</label>
            <input type="text" id="TotalHarga" name="TotalHarga" required><br>

            <!-- Tombol Submit -->
            <input type="submit" value="Pesan">
        </form>
    </div>
</body>
</html>