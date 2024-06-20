<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs to prevent SQL injection
    $nama_pesawat = mysqli_real_escape_string($conn, $_POST['nama_pesawat']);
    $mode = mysqli_real_escape_string($conn, $_POST['mode']);
    $nama_penumpang = mysqli_real_escape_string($conn, $_POST['nama_penumpang']);
    $email_penumpang = mysqli_real_escape_string($conn, $_POST['email_penumpang']);
    $nomor_telepon = mysqli_real_escape_string($conn, $_POST['nomor_telepon']);
    $nomor_kursi = mysqli_real_escape_string($conn, $_POST['nomor_kursi']);
    $tanggal_pemesanan = mysqli_real_escape_string($conn, $_POST['tanggal_pemesanan']);
    $tanggal_keberangkatan = mysqli_real_escape_string($conn, $_POST['tanggal_keberangkatan']);
    $dari = mysqli_real_escape_string($conn, $_POST['dari']);
    $tujuan = mysqli_real_escape_string($conn, $_POST['tujuan']);
    $total_harga = mysqli_real_escape_string($conn, $_POST['total_harga']);
    $status_pembayaran = mysqli_real_escape_string($conn, $_POST['status_pembayaran']);

    // Query SQL using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO pemesananpesawat (NamaPesawat, Model, NamaPenumpang, EmailPenumpang, NomorTelepon, NomorKursi, TanggalPemesanan, TanggalKeberangkatan, Dari, Tujuan, TotalHarga, StatusPembayaran) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $nama_pesawat, $mode, $nama_penumpang, $email_penumpang, $nomor_telepon, $nomor_kursi, $tanggal_pemesanan, $tanggal_keberangkatan, $dari, $tujuan, $total_harga, $status_pembayaran);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
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
    <title>Form Pemesanan Tiket Pesawat</title>
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
            max-width: 600px;
            margin: 20px auto;
            background-color: #88AB8E;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .judul {
            text-align: center;
            margin-bottom: 20px;
            font-family: 'Domine', serif;
        }

        form {
            display: grid;
            gap: 16px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 4px;
            /* Mengurangi jarak bottom antara label dan input */
            color: #333;
        }

        select,
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 12px;
            background-color: #AFC8AD;
        }

        input[type="text"],
        input[type="email"],
        input[type="radio"],
        input[type="tel"],
        input[type="datetime-local"] {
            background-color: #AFC8AD;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="radio"]:focus,
        input[type="tel"]:focus,
        input[type="datetime-local"]:focus {
            background-color: #85B085;
            /* Warna latar belakang ketika mendapatkan fokus */
            outline: none;
            /* Hapus outline default */
            border: 2px solid #5A8B5A;
            /* Gaya border ketika mendapatkan fokus */
        }


        button {
            background: linear-gradient(45deg, #88AB8E, #AFC8AD);
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 12px;
            font-family: 'Domine', serif;
        }
    </style>


    <title>Form Pemesanan Tiket Pesawat</title>
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
            <h2>Pemesanan Tiket Pesawat</h2>
        </div>
        <form action="submit_form.php" method="post">

            <input type="hidden" id="id_pesawat" name="id_pesawat">
            <!-- Tambahkan atribut onchange pada dropdown "Nama Pesawat" -->
            <label for="nama_pesawat">Nama Pesawat:</label>
            <select id="nama_pesawat" name="nama_pesawat" required onchange="updateModelOptions()">
                <option value="" disabled selected>[Pilih Pesawat]</option>
                <?php
                $sql = "SELECT NamaPesawat FROM informasipesawat";
                $result = $conn->query($sql);

                if ($result === FALSE) {
                    die("Error in query: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $selected = (isset($_POST['nama_pesawat']) && $_POST['nama_pesawat'] == $row["NamaPesawat"]) ? "selected" : "";
                        echo '<option value="' . $row["NamaPesawat"] . '" ' . $selected . '>' . $row["NamaPesawat"] . '</option>';
                    }
                } else {
                    echo '<option value="" disabled>Tidak ada pesawat tersedia</option>';
                }
                ?>
            </select>

            <!-- Tambahkan placeholder untuk dropdown "Model" -->
                <label for="mode">Model:</label>
                <select id="mode" name="mode" required onchange="updateModelDetails()">
                    <!-- Opsi akan diisi secara dinamis berdasarkan Nama Pesawat yang dipilih -->
                </select>


            <label for="nama_penumpang">Nama Penumpang:</label>
            <input type="text" id="nama_penumpang" name="nama_penumpang" required>

            <label for="email_penumpang">Email Penumpang:</label>
            <input type="email" id="email_penumpang" name="email_penumpang" required>

            <label for="nomor_telepon">Nomor Telepon:</label>
            <input type="tel" id="nomor_telepon" name="nomor_telepon" required>

            <label for="nomor_kursi">Nomor Kursi:</label>
            <input type="text" id="nomor_kursi" name="nomor_kursi" required>

            <label for="tanggal_pemesanan">Tanggal Pemesanan:</label>
<input type="datetime-local" id="tanggal_pemesanan" name="tanggal_pemesanan" required>

            <label for="tanggal_keberangkatan">Tanggal Keberangkatan:</label>
            <input type="datetime-local" id="tanggal_keberangkatan" name="tanggal_keberangkatan" required>

            <label for="dari">Dari:</label>
            <input type="text" id="dari" name="dari" required>

            <label for="tujuan">Tujuan:</label>
            <input type="text" id="tujuan" name="tujuan" required>

            <label for="total_harga">Total Harga:</label>
            <input type="text" id="total_harga" name="total_harga" required>


            <label for="status_pembayaran">Status Pembayaran:</label>
            <select id="status_pembayaran" name="status_pembayaran">
                <option value="Belum Dibayar" <?php if (isset($_POST['status_pembayaran']) && $_POST['status_pembayaran'] == 'Belum Dibayar') echo 'selected'; ?>>Belum Dibayar</option>
                <option value="Sudah Dibayar" <?php if (isset($_POST['status_pembayaran']) && $_POST['status_pembayaran'] == 'Sudah Dibayar') echo 'selected'; ?>>Sudah Dibayar</option>
            </select>

            <button type="submit">Pesan Tiket</button>
        </form>
    </div>

    <script>
    function updateModelOptions() {
        var selectedPesawat = document.getElementById("nama_pesawat").value;
        var modelDropdown = document.getElementById("mode");

        // Reset opsi model
        modelDropdown.innerHTML = '<option value="" disabled selected>[Pilih Model]</option>';

        // Kirim permintaan AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Berhasil menerima respons dari server
                try {
                    var models = JSON.parse(xhr.responseText);

                    // Tambahkan opsi model ke dropdown
                    models.forEach(function (model) {
                        var option = new Option(model, model);
                        modelDropdown.add(option);
                    });
                } catch (error) {
                    console.error("Error parsing JSON: " + error);
                }
            }
        };

        // Handle kesalahan dan kegagalan permintaan
        xhr.onerror = function () {
            console.error("Request failed");
        };

        // Konfigurasi permintaan
        xhr.open("GET", "get_model_options.php?pesawat=" + encodeURIComponent(selectedPesawat), true);
        xhr.send();
    }

    function updateModelDetails() {
        var selectedModel = document.getElementById("mode").value;

        // Kirim permintaan AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // Berhasil menerima respons dari server
                    try {
                        var modelDetails = JSON.parse(xhr.responseText);

                        // Isi kolom "Dari", "Tujuan", dan "Total Harga"
                        document.getElementById("dari").value = modelDetails.Dari || '';
                        document.getElementById("tujuan").value = modelDetails.Tujuan || '';
                        document.getElementById("total_harga").value = modelDetails.Harga || '';
                    } catch (error) {
                        console.error("Error parsing JSON: " + error);
                    }
                } else {
                    console.error("HTTP request failed with status: " + xhr.status);
                }
            }
        };

        // Handle kesalahan dan kegagalan permintaan
        xhr.onerror = function () {
            console.error("Request failed");
        };

        // Konfigurasi permintaan
        xhr.open("GET", "get_model_details.php?model=" + encodeURIComponent(selectedModel), true);
        xhr.send();
    }

    // Ambil elemen input tanggal pemesanan
    var tanggalPemesananInput = document.getElementById("tanggal_pemesanan");

    // Buat objek Date untuk mendapatkan tanggal saat ini
    var tanggalSaatIni = new Date();

    // Format tanggal untuk input datetime-local
    var tanggalFormat =
        tanggalSaatIni.getFullYear() + "-" +
        pad(tanggalSaatIni.getMonth() + 1) + "-" +
        pad(tanggalSaatIni.getDate()) + "T" +
        pad(tanggalSaatIni.getHours()) + ":" +
        pad(tanggalSaatIni.getMinutes());

    // Set nilai input tanggal pemesanan
    tanggalPemesananInput.value = tanggalFormat;

    // Fungsi untuk menambahkan leading zero jika nilai kurang dari 10
    function pad(number) {
        return (number < 10 ? '0' : '') + number;
    }
</script>



</body>

</html>