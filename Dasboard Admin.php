<?php
require 'koneksi.php';
$loginResultMessage = "";
// Query untuk mengambil data pesawat dari tabel
$sql = "SELECT NamaPesawat FROM informasipesawat";
$result = $conn->query($sql);
// Menghitung jumlah pesawat
$jumlahPesawat = $result->num_rows;
// Query untuk mengambil data model dari tabel
$sql = "SELECT DISTINCT Model FROM informasipesawat";
$result = $conn->query($sql);
// Menghitung jumlah model
$jumlahModel = $result->num_rows;
// Query untuk mengambil data pesawat berdasarkan harga (diurutkan dari yang termahal)
$sql = "SELECT NamaPesawat, Harga FROM informasipesawat ORDER BY Harga DESC LIMIT 1";
$result = $conn->query($sql);
// Mengambil data pesawat termahal
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $namaPesawatTermahal = $row["NamaPesawat"];
    $hargaPesawatTermahal = $row["Harga"];
} else {
    $namaPesawatTermahal = "Tidak ada data";
    $hargaPesawatTermahal = "N/A";
}
// Query untuk mengambil nama pesawat yang paling sering dipesan
$sql = "SELECT NamaPesawat, COUNT(*) as JumlahPesanan FROM pemesananpesawat GROUP BY NamaPesawat ORDER BY JumlahPesanan DESC LIMIT 1";
$result = $conn->query($sql);
// Mengambil data pesawat terlaris
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $namaPesawatTerlaris = $row["NamaPesawat"];
} else {
    $namaPesawatTerlaris = "Tidak ada data";
}
// Query untuk mengambil model pesawat yang paling sering dipesan
$sql = "SELECT Model, COUNT(*) as JumlahPesanan FROM pemesananpesawat GROUP BY Model ORDER BY JumlahPesanan DESC LIMIT 1";
$result = $conn->query($sql);
// Mengambil data model pesawat terlaris
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $modelPesawatTerlaris = $row["Model"];
} else {
    $modelPesawatTerlaris = "Tidak ada data";
}
// Query untuk mengambil tujuan penerbangan yang paling sering dikunjungi
$sql = "SELECT Tujuan, COUNT(*) as JumlahPesanan FROM pemesananpesawat GROUP BY Tujuan ORDER BY JumlahPesanan DESC LIMIT 1";
$result = $conn->query($sql);
// Mengambil data tujuan penerbangan terlaris
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tujuanTerlaris = $row["Tujuan"];
} else {
    $tujuanTerlaris = "Tidak ada data";
}
// Query untuk mengambil total pengguna yang melakukan registrasi
$sql = "SELECT COUNT(DISTINCT username) as TotalRegistrasi FROM registrasi_sittirohani222061";
$result = $conn->query($sql);
// Mengambil total pengguna registrasi
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalRegistrasi = $row["TotalRegistrasi"];
} else {
    $totalRegistrasi = 0;
}
// Query untuk mengambil total pengguna yang terdaftar sebagai tamu
$sql = "SELECT COUNT(*) as TotalTamu FROM registrasi_sittirohani222061 WHERE Sebagai = 'Tamu'";
$result = $conn->query($sql);
// Mengambil total pengguna tamu
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalTamu = $row["TotalTamu"];
} else {
    $totalTamu = 0;
}
// Query untuk mengambil total pengguna yang terdaftar sebagai tamu
$sql = "SELECT COUNT(*) as TotalManagement FROM registrasi_sittirohani222061 WHERE Sebagai = 'Management'";
$result = $conn->query($sql);
// Mengambil total pengguna tamu
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalmanagement = $row["TotalManagement"];
} else {
    $totalmanagement = 0;
}
// Query untuk mengambil total pendapatan dari tabel pemesananpesawat
$sql = "SELECT SUM(TotalHarga) as TotalPendapatan FROM pemesananpesawat";
$result = $conn->query($sql);
// Mengambil total pendapatan
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalPendapatan = $row["TotalPendapatan"];
} else {
    $totalPendapatan = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Dashboard Admin Pengembangan</title>
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

        section {
            padding: 20px;
        }

        .card-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin: 20px;
            /* Add margin for better spacing */
        }

        .card {
            flex: 0 1 25%;
            max-width: 300px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            text-align: center;
            background-color: #D3CEDF;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-bottom: 2px solid #748DA6;
            /* Garis pembatas bawah */
        }

        .card i {
            font-size: 48px;
            color: #3498db;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        table {
            width: 95%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #D3CEDF;
        }

        td {
            background-color: #9CB4CC;
        }
    </style>
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
    <section>
        <div class="card-container">
            <div class="card">
                <i class="fas fa-plane"></i>
                <h3>Jumlah Pesawat</h3>
                <p id="flightInfo">Jumlah pesawat : <?php echo $jumlahPesawat; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-plane"></i>
                <h3>Model Pesawat</h3>
                <p id="hotelInfo">Jumlah model : <?php echo $jumlahModel; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-plane"></i>
                <h3>Pesawat Termahal</h3>
                <p>Nama Pesawat: <?php echo $namaPesawatTermahal; ?></p>
                <p>Harga: <?php echo $hargaPesawatTermahal; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-plane"></i>
                <h3>Pesawat Populer</h3>
                <p>Nama Pesawat: <?php echo $namaPesawatTerlaris; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-plane"></i>
                <h3>Model Populer</h3>
                <p>Model Pesawat: <?php echo $modelPesawatTerlaris; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-plane"></i>
                <h3>Kota Yang Sering Dikunjungi</h3>
                <p>Kota Yang Sering Dikunjungi: <?php echo $tujuanTerlaris; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-user"></i>
                <h3>User</h3>
                <p>Total Pengguna: <?php echo $totalRegistrasi; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-user"></i>
                <h3>Tamu</h3>
                <p>Total Tamu: <?php echo $totalTamu; ?></p>
            </div>
            <div class="card">
                <i class="fas fa-user"></i>
                <h3>Management</h3>
                <p>Management: <?php echo  $totalmanagement; ?></p>
            </div>
            <table>
                <tr>
                    <th>Total Pendapatan</th>
                </tr>
                <tr>
                    <td>Rp. <?php echo $totalPendapatan; ?></td>
                </tr>
            </table>
        </div>
    </section>
</body>

</html>