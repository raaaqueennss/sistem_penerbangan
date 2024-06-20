<?php
require 'koneksi.php';


$query = "SELECT * FROM pemesananpesawat";
$result = $conn->query($query);

if ($result === FALSE) {
    die("Error in query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> 
    <title>Data Pemesanan Tiket Pesawat</title>
    <style>

             /* Navbar Styling */
    .navbar {
        background-color: rgba(136, 171, 142, 0.5) !important;
    }

    .navbar-brand {
        color: #007bff;
        /* Text color for brand/logo */
        font-weight: bold;
        /* Font weight for brand/logo */
    }

    .navbar-toggler {
        border-color: #007bff;
        /* Border color for the toggler button */
    }

    .nav-link {
        color: #000 !important;
        /* Text color for nav links */
    }

    .nav-link:hover {
        color: #AFC8AD;
        /* Text color for nav links on hover */
    }

    .navbar-nav {
        margin-left: auto;
        /* Align nav links to the right */
    }

    /* Optional: Add padding or other styles as needed */
    .navbar-nav a {
        margin-right: 15px;
        /* Adjust spacing between nav links */
    }

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

.container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    background-color: #88AB8E;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: auto; 
    margin-top: 30px;
}

.judul {
    text-align: center;
    margin-bottom: 20px;
    font-family: 'Domine', serif;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

th {
    background-color: #AFC8AD;
    font-weight: bold;
    color: #495057;
}

.bayar-btn {
    font-family: 'Domine', serif;
    background-color: #AFC8AD;
    color: black;
    padding: 10px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.bayar-btn:hover {
    background-color: #218838;
}


    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" styles="">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Rani Travel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-link" href="MenuUtama.php">Halaman Utama</a>
                    <a class="nav-link" href="Harga Tiket.php">Harga Tiket</a>
                    <a class="nav-link" href="Pesanan.php">Pemesanan</a>
                    <a class="nav-link" href="Pesanan Saya.php">Pesanan Saya</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="judul">
            <h2>Data Pemesanan Tiket Pesawat</h2>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Nama Pesawat</th>
                <th>Model</th>
                <th>Nama Penumpang</th>
                <th>Email Penumpang</th>
                <th>Nomor Telepon</th>
                <th>Nomor Kursi</th>
                <th>Tanggal Pemesanan</th>
                <th>Tanggal Keberangkatan</th>
                <th>Ket</th>
                <th>Dari</th>
                <th>Tujuan</th>
                <th>Total Harga</th>
                <th>Status Pembayaran</th>
                <th>Action</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . (isset($row['ID']) ? $row['ID'] : '') . "</td>";
                    echo "<td>" . $row['NamaPesawat'] . "</td>";
                    echo "<td>" . $row['Model'] . "</td>";
                    echo "<td>" . $row['NamaPenumpang'] . "</td>";
                    echo "<td>" . $row['EmailPenumpang'] . "</td>";
                    echo "<td>" . $row['NomorTelepon'] . "</td>";
                    echo "<td>" . $row['NomorKursi'] . "</td>";
                    echo "<td>" . $row['TanggalPemesanan'] . "</td>";
                    echo "<td>" . $row['TanggalKeberangkatan'] . "</td>";

                    $tanggalKeberangkatan = strtotime($row['TanggalKeberangkatan']);
                    $tanggalSekarang = strtotime(date('Y-m-d H:i:s'));
                    
                    
                    echo "<td>";
                    if ($tanggalSekarang < $tanggalKeberangkatan) {
                        echo "Pesawat Belum Sampai";
                    } elseif ($tanggalSekarang >= $tanggalKeberangkatan) {
                        echo "Pesawat telah tiba";
                    } else {
                        echo "Pesawat Sudah Berangkat";
                    }
                    echo "</td>";
                    

                    echo "<td>" . $row['Dari'] . "</td>";
                    echo "<td>" . $row['Tujuan'] . "</td>";
                    echo "<td>" . $row['TotalHarga'] . "</td>";
                    echo "<td>" . $row['StatusPembayaran'] . "</td>";
                    echo "<td><button class='bayar-btn' onclick='bayar(" . (isset($row['ID']) ? $row['ID'] : '') . ")'>Bayar</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='15'>Tidak ada data pemesanan</td></tr>";
            }
            ?>

        </table>
    </div>
    <script>
        function bayar(ID) {
            // Tambahkan logika untuk menangani pembayaran untuk ID yang diberikan
            alert("Pembayaran untuk ID Pesawat " + ID + " berhasil!");

            // Kirim permintaan AJAX untuk memperbarui status pembayaran
            $.ajax({
                type: "POST",
                url: "update_status.php",
                data: {
                    ID: ID
                },
                success: function(response) {
                    if (response === "success") {
                        alert("Pembayaran untuk ID Pesawat " + ID + " berhasil!");
                        // Muat ulang halaman setelah pembayaran berhasil (opsional)
                        location.reload();
                    } else {
                        alert("Pembayaran gagal!");
                    }
                },
                error: function() {
                    alert("Terjadi kesalahan saat memproses pembayaran.");
                }
            });
        }
    </script>

</body>

</html>