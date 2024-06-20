<?php

require 'koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Query untuk mengambil data dari tabel InformasiPesawat
$sql = "SELECT * FROM InformasiPesawat";
$result = $conn->query($sql);

// Periksa apakah formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $IdRegistrasi = isset($_POST['IdRegistrasi']) ? $_POST['IdRegistrasi'] : "";
    $Gambar = isset($_POST['Gambar']) ? $_POST['Gambar'] : "";
    $NamaPesawat = isset($_POST['NamaPesawat']) ? $_POST['NamaPesawat'] : "";
    $Model = isset($_POST['Model']) ? $_POST['Model'] : "";
    $Kapasitas = isset($_POST['Kapasitas']) ? $_POST['Kapasitas'] : "";
    $Fasilitas = isset($_POST['Fasilitas']) ? $_POST['Fasilitas'] : "";
    $Kedatangan = isset($_POST['Kedatangan']) ? $_POST['Kedatangan'] : "";
    $Keberangkatan = isset($_POST['Keberangkatan']) ? $_POST['Keberangkatan'] : "";
    $Dari = isset($_POST['Dari']) ? $_POST['Dari'] : "";
    $Tujuan = isset($_POST['Tujuan']) ? $_POST['Tujuan'] : "";
    $Harga = isset($_POST['Harga']) ? $_POST['Harga'] : "";

    // Handle upload gambar
    $targetDir = "Uploads"; // Folder tempat menyimpan gambar
    $targetFile = $targetDir . basename($_FILES["Gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Periksa apakah file yang diunggah adalah gambar asli
    $check = getimagesize($_FILES["Gambar"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Periksa apakah file sudah ada
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Periksa ukuran file
    if ($_FILES["Gambar"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Izinkan hanya beberapa format file tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Periksa apakah $uploadOk diatur ke 0 karena ada kesalahan
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // Jika semuanya baik-baik saja, coba unggah file
    } else {
        if (move_uploaded_file($_FILES["Gambar"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["Gambar"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Periksa apakah data dengan IdRegistrasi tertentu sudah ada
    $checkExisting = "SELECT * FROM InformasiPesawat WHERE IdRegistrasi = '$IdRegistrasi'";
    $resultCheck = $conn->query($checkExisting);

    if ($resultCheck->num_rows > 0) {
        echo "Data dengan ID Registrasi $IdRegistrasi sudah ada dalam database.";
    } else {
        // Query untuk menyimpan data ke dalam tabel
        $sql = "INSERT INTO InformasiPesawat (IdRegistrasi, Gambar, NamaPesawat, Model, Kapasitas, Fasilitas, Kedatangan, Keberangkatan, Dari, Tujuan, Harga) 
                VALUES ('$IdRegistrasi', '$targetFile', '$NamaPesawat', '$Model', '$Kapasitas', '$Fasilitas', '$Kedatangan', '$Keberangkatan', '$Dari', '$Tujuan', '$Harga')";

        // Periksa apakah query berhasil dijalankan
        if ($conn->query($sql) === TRUE) {
            echo "Data berhasil disimpan!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Tutup koneksi
$conn->close();

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pesawat</title>
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
    background-image: url('IMG/wallinfo4.jpeg');
    background-size: cover;
    background-position: center;
    z-index: -1;
    opacity: 0.5;
    filter: blur(3px);
    /* Tambahkan efek blur dengan 3 piksel */
}

.form-container {
    margin: 20px;
    padding: 20px;
    background-color: rgba(136, 171, 142, 0.5);
    /* Warna hijau transparan sebagian */
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(5px);
    border: 1px solid rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease-in-out;
    width: 880px;
    margin: 0 auto;
}

h2 {
    color: #F2F1EB;
    margin: 20px 0; /* Tambahkan margin ke atas dan bawah */
    /* Hilangkan margin atas dan bawah default untuk h2 */
    font-family: 'Domine', serif;
    text-align: center;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 10px; /* Tingkatkan margin bawah untuk label */
}

input,
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

/* Terapkan gaya fokus */
input[type="text"]:focus,
input[type="number"]:focus,
input[type="datetime-local"]:focus,
input[type="file"]:focus,
textarea:focus {
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
    margin-top: 10px; /* Tambahkan margin ke atas */
}

input[type="submit"]:hover {
    background-color: #45a049;
    cursor: pointer;
}

.data-container {
    margin: 20px;
    padding: 20px;
    background-color: rgba(136, 171, 142, 0.5);
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th,
td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

td {
    color: #F2F1EB;
}

th {
    background-color: #f2f2f2;
}

.edit-btn,
.hapus-btn {
    display: inline-block;
    padding: 8px 12px;
    margin: 10px 4px; /* Tambahkan margin di semua sisi */
    text-decoration: none;
    color: #fff;
    background: linear-gradient(45deg, #88AB8E, #AFC8AD);
    border-radius: 4px;
    transition: background-color 0.3s;
}

.edit-btn:hover,
.hapus-btn:hover {
    background-color: #2980b9;
}
    </style>

</head>

<body>
    <div class="form-container">
        <h2>Formulir Informasi Pesawat</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- IdRegistrasi -->
            <label for="IdRegistrasi">ID Registrasi:</label>
            <input type="text" id="IdRegistrasi" name="IdRegistrasi" required><br>

            <!-- Gambar -->
            <label for="Gambar">Gambar:</label>
            <input type="file" id="Gambar" name="Gambar" accept="image/*" required><br>

            <!-- NamaPesawat -->
            <label for="NamaPesawat">Nama Pesawat:</label>
            <input type="text" id="NamaPesawat" name="NamaPesawat" required><br>

            <!-- Model -->
            <label for="Model">Model:</label>
            <input type="text" id="Model" name="Model"><br>

            <!-- Kapasitas -->
            <label for="Kapasitas">Kapasitas:</label>
            <input type="number" id="Kapasitas" name="Kapasitas" required><br>

            <!-- Fasilitas -->
            <label for="Fasilitas">Fasilitas:</label>
            <textarea id="Fasilitas" name="Fasilitas"></textarea><br>

            <!-- Kedatangan -->
            <label for="Kedatangan">Kedatangan:</label>
            <input type="datetime-local" id="Kedatangan" name="Kedatangan" required><br>

            <!-- Keberangkatan -->
            <label for="Keberangkatan">Keberangkatan:</label>
            <input type="datetime-local" id="Keberangkatan" name="Keberangkatan" required><br>

            <!-- Dari -->
            <label for="Dari">Dari:</label>
            <input type="text" id="Dari" name="Dari" required><br>

            <!-- Tujuan -->
            <label for="Tujuan">Tujuan:</label>
            <input type="text" id="Tujuan" name="Tujuan" required><br>

            <!-- Harga -->
            <label for="Harga">Harga:</label>
            <input type="text" id="Harga" name="Harga" required><br>

            <!-- Tombol Submit -->
            <input type="submit" value="Simpan">
        </form>
        <div class="data-container">
            <h2>Data Informasi Pesawat</h2>
            <table>
                <tr>
                    <th>ID Registrasi</th>
                    <th>Gambar</th>
                    <th>Nama Pesawat</th>
                    <th>Model</th>
                    <th>Kapasitas</th>
                    <th>Fasilitas</th>
                    <th>Kedatangan</th>
                    <th>Keberangkatan</th>
                    <th>Dari</th>
                    <th>Tujuan</th>
                    <th>Harga</th>
                    <th>Action</th> <!-- New column for buttons -->
                </tr>
                <?php
            // Tampilkan data ke dalam tabel HTML
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['IdRegistrasi'] . "</td>";
                echo "<td><img src='" . $row['Gambar'] . "' alt='Gambar Pesawat' style='width:50px;height:50px;'></td>";
                echo "<td>" . $row['NamaPesawat'] . "</td>";
                echo "<td>" . $row['Model'] . "</td>";
                echo "<td>" . $row['Kapasitas'] . "</td>";
                echo "<td>" . $row['Fasilitas'] . "</td>";
                echo "<td>" . $row['Kedatangan'] . "</td>";
                echo "<td>" . $row['Keberangkatan'] . "</td>";
                echo "<td>" . $row['Dari'] . "</td>";
                echo "<td>" . $row['Tujuan'] . "</td>";
                echo "<td>" . $row['Harga'] . "</td>";
                
                // Buttons for Edit and Hapus
                echo "<td>";
                echo "<a class='edit-btn' href='edit.php?id=" . $row['IdRegistrasi'] . "'>Edit</a>";
                echo "<a class='hapus-btn' href='hapus.php?id=" . $row['IdRegistrasi'] . "'>Hapus</a>";
                echo "</td>";            
                echo "</td>";

                echo "</tr>";
            }
        ?>
            </table>
        </div>
    </div>


</body>

</html>