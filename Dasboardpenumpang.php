<?php
session_start();
require 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <title>Halaman Utama - Travel Rani</title>
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
            width: 80%;
            margin: auto;
            overflow: hidden;
            background-color: rgba(136, 171, 142, 0.5);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }

        .judul {
            text-align: center;
            padding: 20px 0;
            background-color: #88AB8E;
            color: #fff;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-family: 'Domine', serif;
        }

        .judul h3 {
            margin: 0;
        }

        .desk {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .desk img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .desk h3 {
            color: #fff;
            margin-bottom: 10px;
        }

        .desk p {
            text-align: justify;
            line-height: 1.6;
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" styles="">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Rani Travel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
            <h3>Selamat Datang Travel Rani</h3>
        </div>
        <div class="desk">
            <img src="IMG/admin2.jpg" alt="">
            <h3>Dekripsi Travel</h3>
            <p>Travel Rani adalah destinasi perjalanan yang mengajak Anda merasakan keindahan dan kekayaan budaya yang
                tersembunyi. Dengan tagline "Menemukan Keajaiban di Setiap Langkah," Travel Rani mempersembahkan
                pengalaman wisata yang tak terlupakan melalui perjalanan yang penuh petualangan dan kejutan.
                Dengan paket-paket eksklusifnya, Travel Rani mengajak Anda menjelajahi destinasi yang jarang terjamah
                oleh turis, memperkenalkan Anda pada keindahan alam yang memukau, dan menyajikan pengalaman kuliner
                autentik yang akan memanjakan lidah Anda. Tim pemandu wisata ahli dari Travel Rani akan membimbing Anda
                melalui tempat-tempat istimewa, merinci sejarah, cerita lokal, dan rahasia tersembunyi yang membuat
                setiap perjalanan menjadi lebih berarti.
                Travel Rani juga menawarkan program perjalanan khusus, seperti tur ke festival budaya lokal, workshop
                kerajinan tangan tradisional, dan kegiatan ekowisata yang mendukung pelestarian lingkungan. Dengan
                komitmen pada keberlanjutan, Travel Rani berusaha memberikan dampak positif bagi masyarakat setempat dan
                alam sekitar.
                Jadi, bersiaplah untuk merasakan keajaiban dunia melalui mata dan hati yang baru dengan Travel Rani.
                Selamatkan momen-momen indah dalam perjalanan seumur hidup dan biarkan Travel Rani menjadi mitra setia
                Anda dalam menjelajahi keindahan dunia ini.</p>
        </div>
    </div>
</body>

</html>