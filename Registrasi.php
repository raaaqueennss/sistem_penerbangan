<?php
require 'koneksi.php';
// Fungsi untuk menghasilkan userID secara otomatis
function generateUserID($length = 8)
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $userID = 'TRA' . substr(str_shuffle($characters), 0, $length - 3);
    return $userID;
}
// Query untuk mendapatkan opsi dari kolom 'Sebagai'
$query = "SELECT DISTINCT Sebagai FROM registrasi_sittirohani222061";
// Eksekusi query
$result = $conn->query($query);
// Periksa apakah query berhasil dijalankan
if ($result) {
    // Periksa apakah ada data yang ditemukan
    if ($result->num_rows > 0) {
    } else {
    }
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate userID secara otomatis
    $userID = generateUserID();
    // Tangkap nilai-nilai dari form
    $username = $_POST["username"];
    $nama_depan = $_POST["nama_depan"];
    $email = $_POST["email"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $sebagai = $_POST["sebagai"];
    $management = $_POST["management"];
    $nomor_telepon = $_POST["nomor_telepon"];
    $password = $_POST["pass"];
    // Query SQL untuk insert data
    $sql = "INSERT INTO registrasi_sittirohani222061 (userID, username, nama_depan, email, jenis_kelamin, sebagai, Management, nomor_telepon, pass)
            VALUES ('$userID', '$username', '$nama_depan', '$email', '$jenis_kelamin', '$sebagai', '$management', '$nomor_telepon', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Formulir Registrasi penerbangan</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Domine:wght@400;500;600;700&display=swap');

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
            background-image: url('IMG/rani.jpeg');
            background-size: cover;
            background-position: center;
            z-index: -1;
            opacity: 0.5;
            filter: blur(3px);
            /* Add the blur effect with 3 pixels */
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #88AB8E;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        hr {
            border: 0;
            /* Hapus border default */
            height: 1px;
            /* Tentukan tinggi garis */
            background-color: #F2F1EB;
            /* Warna garis */
            margin: 20px 0;
            /* Atur margin di atas dan di bawah garis */
        }

        .form {
            max-width: 80%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .gender-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .radio-group {
            margin-right: 20px;
            display: flex;
            align-items: center;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="text"],
        input[type="email"],
        input[type="radio"],
        input[type="tel"],
        input[type="password"],
        input[type="submit"] {
            background-color: #AFC8AD;
        }

        input[type="submit"] {
            background: linear-gradient(45deg, #88AB8E, #AFC8AD);
            color: black;
            font-family: 'Domine', serif;
            border: none;
        }

        select#management,
        select#sebagai {
            background-color: #AFC8AD;
            padding: 5px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="radio"]:focus,
        input[type="tel"]:focus,
        input[type="password"]:focus {
            background-color: #85B085;
            outline: none;
            border: 2px solid #5A8B5A;
        }

        select#management:focus,
        select#sebagai:focus {
            background-color: #85B085;
            outline: none;
            border: 2px solid #5A8B5A;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }
    </style>
    </style>
</head>

<body>
    <div class="container">
        <div class="judul">
            <h2>Formulir Registrasi Penerbangan</h2>
        </div>
        <div class="desk">
            <p>Travel Sitti Rohani</p>
        </div>
        <hr>
        <div class="form">
            <form action="" method="post">
                <!-- Username -->
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required maxlength="50"><br>
                <!-- Nama Depan -->
                <label for="nama_depan">Nama Depan:</label>
                <input type="text" id="nama_depan" name="nama_depan" required maxlength="50"><br>
                <!-- Email -->
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required maxlength="100"><br>
                <!-- Jenis Kelamin -->
                <div class="gender-container">
                    <label>Jenis Kelamin:</label>
                    <div class="radio-group">
                        <input type="radio" id="pria" name="jenis_kelamin" value="Pria" required>
                        <label for="pria">Pria</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" id="wanita" name="jenis_kelamin" value="Wanita" required>
                        <label for="wanita">Wanita</label>
                    </div>
                </div>
                <!-- Sebagai -->
                <label for="sebagai">Sebagai:</label>
                <select id="sebagai" name="sebagai" required onchange="handleSebagaiChange()">
                    <option value="Management">Management</option>
                    <option value="Tamu">Tamu</option>
                </select><br>
                <!-- Jabatan Management -->
                <label for="management" id="managementLabel">Jabatan Management:</label>
                <select id="management" name="management">
                    <option value="Owner">Owner</option>
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                </select><br>
                <!-- Nomor Telepon -->
                <label for="nomor_telepon">Nomor Telepon:</label>
                <input type="tel" id="nomor_telepon" name="nomor_telepon" maxlength="15"><br>
                <!-- Password -->
                <label for="pass">Password:</label>
                <input type="password" id="pass" name="pass" required maxlength="50"><br>
                <!-- Tombol Submit -->
                <input type="submit" value="Daftar">
            </form>
        </div>
    </div>
    <script>
        function handleSebagaiChange() {
            var sebagaiDropdown = document.getElementById("sebagai");
            var managementDropdown = document.getElementById("management");
            if (sebagaiDropdown.value === "Tamu") {
                managementDropdown.style.display = "none";
                managementLabel.style.display = "none";
            } else {
                managementDropdown.style.display = "block";
            }
        }
    </script>
</body>

</html>