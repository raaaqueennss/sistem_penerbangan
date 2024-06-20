<?php
require 'koneksi.php'; // Sesuaikan dengan file koneksi Anda

// Membuat folder uploads jika belum ada
$uploadsFolder = "Upload";

if (!file_exists($uploadsFolder)) {
    mkdir($uploadsFolder, 0777, true);
}

// Periksa apakah form telah dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $IdRegistrasi = $_POST['IdRegistrasi'];
    $Gambar = ""; // Jangan lupa menangani upload gambar jika diperlukan
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
    if ($_FILES['Gambar']['error'] == 0) {
        $targetDir = $uploadsFolder . '/';
        $targetFile = $targetDir . basename($_FILES["Gambar"]["name"]);
        move_uploaded_file($_FILES["Gambar"]["tmp_name"], $targetFile);
        $Gambar = $targetFile;
    }

    // Query untuk melakukan pembaruan data
    $sql = "UPDATE InformasiPesawat SET 
            Gambar = '$Gambar', 
            NamaPesawat = '$NamaPesawat', 
            Model = '$Model', 
            Kapasitas = '$Kapasitas', 
            Fasilitas = '$Fasilitas', 
            Kedatangan = '$Kedatangan', 
            Keberangkatan = '$Keberangkatan', 
            Dari = '$Dari', 
            Tujuan = '$Tujuan', 
            Harga = '$Harga' 
            WHERE IdRegistrasi = '$IdRegistrasi'";

    // Periksa apakah query berhasil dijalankan
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui!";
        // Mengarahkan kembali ke halaman sebelumnya
        header("Location: form info pesawat.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Periksa apakah ID Registrasi telah dikirimkan melalui URL
if (isset($_GET['id'])) {
    $idRegistrasi = $_GET['id'];

    // Query untuk mengambil data pesawat berdasarkan ID Registrasi
    $sql = "SELECT * FROM InformasiPesawat WHERE IdRegistrasi = '$idRegistrasi'";
    $result = $conn->query($sql);

    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Ambil data dari hasil query
        $IdRegistrasi = $row['IdRegistrasi'];
        $Gambar = $row['Gambar'];
        $NamaPesawat = $row['NamaPesawat'];
        $Model = $row['Model'];
        $Kapasitas = $row['Kapasitas'];
        $Fasilitas = $row['Fasilitas'];
        $Kedatangan = $row['Kedatangan'];
        $Keberangkatan = $row['Keberangkatan'];
        $Dari = $row['Dari'];
        $Tujuan = $row['Tujuan'];
        $Harga = $row['Harga'];
    } else {
        // Redirect jika data tidak ditemukan
        header("Location: form_info_pesawat.php");
        exit();
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
    <title>Edit Informasi Pesawat</title>
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            margin: 0;
        }

        /* Container Styles */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        /* Form Styles */
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"],
        input[type="datetime-local"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-top: 8px;
        }

        /* Image Styles */
        img {
            max-width: 100%;
            height: auto;
        }

        /* Button Styles */
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        /* Responsive Styles */
        @media (max-width: 600px) {
            form {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="container">


        <h2>Edit Informasi Pesawat</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Gunakan hidden input untuk menyimpan ID Registrasi -->
            <input type="hidden" name="IdRegistrasi" value="<?php echo $IdRegistrasi; ?>">

            <!-- Gunakan input biasa untuk menampilkan data yang dapat diubah -->
            <label for="Gambar">Gambar:</label>
            <img src="<?php echo $Gambar; ?>" alt="Gambar Pesawat" style="width:50px;height:50px;">
            <input type="file" id="Gambar" name="Gambar" accept="image/*"><br>

            <label for="NamaPesawat">Nama Pesawat:</label>
            <input type="text" id="NamaPesawat" name="NamaPesawat" value="<?php echo $NamaPesawat; ?>" required><br>

            <label for="Model">Model:</label>
            <input type="text" id="Model" name="Model" value="<?php echo $Model; ?>"><br>

            <label for="Kapasitas">Kapasitas:</label>
            <input type="number" id="Kapasitas" name="Kapasitas" value="<?php echo $Kapasitas; ?>" required><br>

            <label for="Fasilitas">Fasilitas:</label>
            <textarea id="Fasilitas" name="Fasilitas"><?php echo $Fasilitas; ?></textarea><br>

            <label for="Kedatangan">Kedatangan:</label>
            <input type="datetime-local" id="Kedatangan" name="Kedatangan" value="<?php echo $Kedatangan; ?>" required><br>

            <label for="Keberangkatan">Keberangkatan:</label>
            <input type="datetime-local" id="Keberangkatan" name="Keberangkatan" value="<?php echo $Keberangkatan; ?>" required><br>

            <label for="Dari">Dari:</label>
            <input type="text" id="Dari" name="Dari" value="<?php echo $Dari; ?>" required><br>

            <label for="Tujuan">Tujuan:</label>
            <input type="text" id="Tujuan" name="Tujuan" value="<?php echo $Tujuan; ?>" required><br>

            <label for="Harga">Harga:</label>
            <input type="text" id="Harga" name="Harga" value="<?php echo $Harga; ?>" required><br>

            <!-- Tombol Submit untuk mengirimkan form ke update.php -->
            <input type="submit" value="Update">
        </form>
    </div>
</body>

</html>