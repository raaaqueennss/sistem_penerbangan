<?php
require 'koneksi.php';
// Define a variable to store the login result
$loginResultMessage = "";
// Periksa apakah formulir login telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    // Gunakan prepared statement untuk mencegah SQL injection
    $sql = "SELECT * FROM registrasi_sittirohani222061 WHERE username = ? AND pass = ?";
    $stmt = $conn->prepare($sql);
    // Bind parameter
    $stmt->bind_param("ss", $username, $password);
    // Eksekusi query
    $stmt->execute();
    // Ambil hasil query
    $result = $stmt->get_result();
    // Periksa apakah ada baris yang sesuai
    if ($result->num_rows > 0) {
        $loginResultMessage = "Login berhasil!";
        // Redirect ke halaman dashboard setelah login berhasil
        header("Location: Dasboard Admin.php");
        exit();
    } else {
        $loginResultMessage = "Login gagal. Periksa kembali username dan password Anda.";
    }
    // Tutup statement
    $stmt->close();
}
// Tutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background-image: url('IMG/waloginn.jpg');
            background-size: cover;
            background-position: center;
            z-index: -1;
            opacity: 0.5;
            filter: blur(3px);
            /* Add the blur effect with 3 pixels */
        }

        .login-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #88AB8E;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 700px;
            /* Adjust the width as per your requirement */
            margin-top: 22%;
            /* Move this property inside the .login-container block */
        }

        h2 {
            color: #F2F1EB;
            margin: 0;
            /* Hilangkan margin atas dan bawah default untuk h2 */
            font-family: 'Domine', serif;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="text"],
        input[type="password"] {
            background-color: #AFC8AD;
            border: none;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            background-color: #85B085;
            /* Warna latar belakang ketika mendapatkan fokus */
            outline: none;
            /* Hapus outline default */
            /* Gaya border ketika mendapatkan fokus */
        }

        input[type="submit"] {
            background: linear-gradient(45deg, #88AB8E, #AFC8AD);
            color: black;
            border: none;
            font-family: 'Domine', serif;
            font-size: 20px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
            cursor: pointer;
        }

        .success-message {
            color: #4caf50;
        }

        .error-message {
            color: #ff0000;
        }
    </style>
    <title>Formulir Login Admin</title>
</head>

<body>
    <div class="login-container">
        <h2>Formulir Login Admin</h2>
        <form action="" method="post">
            <!-- Username -->
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required maxlength="50"><br>
            <!-- Password -->
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required maxlength="50"><br>
            <!-- Tombol Submit -->
            <input type="submit" value="Login">
        </form>
        <?php
        // Tampilkan pesan hasil login
        echo "<p class='result-message'>$loginResultMessage</p>";
        ?>
    </div>
</body>

</html>