<?php
require 'koneksi.php';
$loginResultMessage = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title></title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F2D7D9;
        }

        header {
            background-color: #F2D7D9;
            color: #748DA6;
            padding: 10px;
            text-align: center;
        }

        nav {
            background-color: #D3CEDF;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        a {
            color: #748DA6;
            text-decoration: none;
            padding: 10px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            color: #fff;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
            justify-content: center;
            /* Menyusun elemen di tengah secara horizontal */
        }

        .card {
            margin-right: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            margin: 0 auto;
            width: 400px;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-header {
            background-color: #748DA6;
            color: black;
            padding: 10px;
            text-align: center;
        }

        .card-body {
            padding: 20px;
            background-color: #D3CEDF;
        }

        .profile-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .hapus-btn {
            background-color: #F2D7D9;
            color: black;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .hapus-btn:hover {
            background-color: #c82333;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 10px;
            margin: 0 5px;
            background-color: #748DA6;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: #28a745;
            margin-top: 20px;
            text-align: center;
            /* Menyusun teks di tengah secara horizontal */
        }

        .error-message {
            color: #dc3545;
            margin-top: 20px;
            text-align: center;
            /* Menyusun teks di tengah secara horizontal */
        }
    </style>
    <title>User Profile</title>
</head>

<body>
    <header>
        <h1>Travel Rani Admin Dashboard</h1>
    </header>
    <nav>
        <a href="Dasboard Admin.php">Beranda</a> |
        <a href="form info pesawat.php">Pengelolahan Travel</a> |
        <a href="user.php">Pengguna</a>
    </nav>
    <?php
    // Fungsi untuk mendapatkan URL gambar profil acak
    function getRandomProfileImage()
    {
        $width = 150; // Lebar gambar
        $height = 150; // Tinggi gambar
        $randomNumber = rand(1, 1000); // Nomor acak untuk variasi gambar
        return "https://picsum.photos/{$width}/{$height}?random={$randomNumber}";
    }
    // Ambil nilai halaman dari parameter URL atau atur ke halaman pertama jika tidak ada
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    // Tentukan jumlah item per halaman
    $itemsPerPage = 1;
    // Hitung offset berdasarkan halaman saat ini
    $offset = ($currentPage - 1) * $itemsPerPage;
    // Modifikasi query untuk membatasi hasil berdasarkan halaman dan jumlah item per halaman
    $result = mysqli_query($conn, "SELECT id, userID, username, nama_depan, email, jenis_kelamin, Sebagai, Management, nomor_telepon, pass, lastupdate FROM registrasi_sittirohani222061 LIMIT $offset, $itemsPerPage");
    // Buat container di luar loop
    echo '<div class="container">';
    if ($result) {
        $counter = 0; // Counter untuk menghitung setiap 3 kartu
        // Mulai pembacaan data dari baris pertama
        while ($data = mysqli_fetch_assoc($result)) {
            // Dapatkan URL gambar profil acak
            $randomImage = getRandomProfileImage();
            // Buka baris baru setiap 3 kartu
            if ($counter % 3 == 0) {
                echo '<div class="row">';
            }
            // Buat card profil untuk setiap record
            echo '<form method="post" action="" style="margin-top: 10px;">';
            echo '<input type="hidden" name="hapus_user_id" value="' . $data['userID'] . '">';
            echo '<div class="card">';
            echo '<div class="card-header">Profil</div>';
            echo '<div class="card-body">';
            echo '<img src="' . getRandomProfileImage() . '" alt="Profile Image" class="profile-image">';
            echo '<p>User ID: ' . $data['userID'] . '</p>';
            echo '<p>Username: ' . $data['username'] . '</p>';
            echo '<p>Nama Depan: ' . $data['nama_depan'] . '</p>';
            echo '<p>Email: ' . $data['email'] . '</p>';
            echo '<p>Jenis Kelamin: ' . $data['jenis_kelamin'] . '</p>';
            echo '<p>Sebagai: ' . $data['Sebagai'] . '</p>';
            echo '<p>Management: ' . $data['Management'] . '</p>';
            echo '<p>Nomor Telepon: ' . $data['nomor_telepon'] . '</p>';
            echo '<p>Password: ' . $data['pass'] . '</p>';
            echo '<button class="hapus-btn" data-user-id="' . $data['userID'] . '">Hapus Profil</button>';
            echo '</div>';
            echo '</div>';
            // Tutup baris setiap 3 kartu
            if ($counter % 3 == 2) {
                echo '</div>';
            }
            $counter++;
        }
        // Tutup baris terakhir jika jumlah kartu tidak habis dibagi 3
        if ($counter % 3 != 0) {
            echo '</div>';
        }
        // Tutup container setelah loop
        echo '</div>';
        // Hitung jumlah total data
        $totalItems = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM registrasi_sittirohani222061"));
        // Hitung jumlah halaman
        $totalPages = ceil($totalItems / $itemsPerPage);
        // Tampilkan tombol navigasi halaman
        echo '<div class="pagination">';
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
        echo '</div>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    // Menangani penghapusan profil jika ada data yang dikirimkan
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["hapus_user_id"])) {
        $userIdToDelete = $_POST["hapus_user_id"];
        // Lakukan query penghapusan data berdasarkan user ID
        $deleteQuery = "DELETE FROM registrasi_sittirohani222061 WHERE userID = '$userIdToDelete'";
        $deleteResult = mysqli_query($conn, $deleteQuery);
        if ($deleteResult) {
            echo '<div class="success-message">Profil dengan User ID ' . $userIdToDelete . ' berhasil dihapus.</div>';
        } else {
            echo '<div class="error-message">Error: ' . mysqli_error($conn) . '</div>';
        }
    }
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menangani klik tombol hapus
            document.querySelectorAll('.hapus-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var userId = button.getAttribute('data-user-id');
                    var konfirmasi = confirm('Apakah Anda yakin ingin menghapus profil?');
                    if (konfirmasi) {
                        // Membuat formulir tersembunyi untuk mengirimkan data penghapusan
                        var form = document.createElement('form');
                        form.method = 'post';
                        form.action = '';
                        var input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'hapus_user_id';
                        input.value = userId;
                        form.appendChild(input);
                        // Menambahkan formulir ke halaman dan mengirimkannya
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>