<?php
require 'koneksi.php';

// Tentukan jumlah item per halaman
$itemsPerHalaman = 2;

// Tentukan halaman saat ini
$halaman = isset($_GET['page']) ? $_GET['page'] : 1;

// Hitung offset untuk query
$offset = ($halaman - 1) * $itemsPerHalaman;

$query = "SELECT NamaPesawat, Gambar, Harga, Model, Fasilitas FROM informasipesawat LIMIT $offset, $itemsPerHalaman";
$result = mysqli_query($conn, $query);

$dataPesawat = array();

// Cek apakah ada data
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dataPesawat[] = $row;
    }
}

// Hitung total halaman
$totalHalaman = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM informasipesawat")) / $itemsPerHalaman);

// Tutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
    <title>Data Pesawat</title>
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
    }

    /* Navbar Styling */
    .navbar {
        background-color: rgba(136, 171, 142, 0.5) !important;
    }

    .navbar-brand {
        color: #007bff;
        font-weight: bold;
        font-family: 'Domine', serif;
    }

    .navbar-toggler {
        border-color: #007bff;
    }

    .nav-link {
        color: #000 !important;
        font-family: 'Domine', serif;
    }

    .nav-link:hover {
        color: #AFC8AD !important;
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

    .container {
        width: 70%;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: rgba(136, 171, 142, 0.5);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-top: 30px;
        padding: 20px;
    }

    /* Gaya untuk card */
    .card {
        border: 1px solid #ccc;
        border-radius: 10px;
        margin: 20px;
        padding: 20px;
        background-color: rgba(136, 171, 142, 0.5);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 40%;
        margin-bottom: 20px;
    }

    /* Gaya untuk judul di dalam card */
    .card .judul h2 {
        color: white;
        text-align: center;
    }

    /* Gaya untuk card body */
    .card .card-body {
        text-align: center;
    }

    /* Gaya untuk gambar di dalam card body */
    .card .card-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 15px;
        object-fit: cover;
        /* Mengisi area gambar tanpa merubah aspek ratio */
        transition: transform 0.3s ease-in-out;
        /* Efek transisi untuk hover */
    }

    /* Efek hover untuk gambar */
    .card .card-body img:hover {
        transform: scale(1.1);
        /* Memperbesar gambar saat dihover */
        opacity: 0.8;
        /* Mengurangi kecerahan saat dihover */
    }

    /* Gaya untuk paragraf di dalam card body */
    .card .card-body p {
        color: white;
        margin: 10px 0;
        font-size: 12px;
    }

    /* Gaya untuk paragraf harga dengan warna berbeda */
    .card .card-body p:first-child {
        color: #e44d26;
        font-weight: bold;
    }

    .custom-list {
  list-style-type: disc;
  padding-left: 20px;
  text-align: left;
}

.custom-list li {
  margin-bottom: 10px;
}

    .pagination {
        text-align: center;
        margin: 20px auto 0;
        margin-left: 42%;
    }

    .pagination a {
        display: inline-block;
        text-align: center;
        padding: 5px 10px;
        margin-right: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        vertical-align: middle;
        background-color: rgba(136, 171, 142, 0.5);
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
        <?php foreach ($dataPesawat as $pesawat) : ?>
        <div class="card">
            <div class="judul">
                <h2><?= $pesawat['NamaPesawat'] ?></h2>
            </div>
            <div class="card-body">
                <img src="<?= $pesawat['Gambar'] ?>" alt="<?= $pesawat['NamaPesawat'] ?>">
                <p>Harga tiket mulai: <?= $pesawat['Harga'] ?></p>
                <p>Model: <?= $pesawat['Model'] ?></p>
                <ul class="custom-list">
  <?php
    $fasilitasArray = explode(',', $pesawat['Fasilitas']);
    foreach ($fasilitasArray as $fasilitas) {
      echo "<li>Fasilitas: $fasilitas</li>";
    }
  ?>
</ul>


            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Tambahkan navigasi halaman -->
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalHalaman; $i++) : ?>
        <a href="?page=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>

</body>

</html>