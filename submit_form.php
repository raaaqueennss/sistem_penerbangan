<?php
require 'koneksi.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Extract and sanitize form data
        $namaPesawat = $_POST['nama_pesawat'];
        $model = $_POST['mode'];
        $tanggalKeberangkatan = $_POST['tanggal_keberangkatan'];
        $namaPenumpang = $_POST['nama_penumpang'];
        $emailPenumpang = $_POST['email_penumpang'];
        $nomorTelepon = $_POST['nomor_telepon'];
        $nomorKursi = $_POST['nomor_kursi'];
        $tanggalPemesanan = $_POST['tanggal_pemesanan'];
        $dari = $_POST['dari'];
        $tujuan = $_POST['tujuan'];
        $totalHarga = $_POST['total_harga'];
        $statusPembayaran = $_POST['status_pembayaran'];

        // Insert data into the database
        $insertSql = "INSERT INTO pemesananpesawat (NamaPesawat, Model, TanggalKeberangkatan, NamaPenumpang, 
    EmailPenumpang, NomorTelepon, NomorKursi, TanggalPemesanan, Dari, Tujuan, 
    TotalHarga, StatusPembayaran) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param(
            'ssssssssssss',
            $namaPesawat,
            $model,
            $tanggalKeberangkatan,
            $namaPenumpang,
            $emailPenumpang,
            $nomorTelepon,
            $nomorKursi,
            $tanggalPemesanan,
            $dari,
            $tujuan,
            $totalHarga,
            $statusPembayaran
        );

        if ($stmt->execute()) {
        } else {
            $response['success'] = false; // Indicate failure in the response
            $response['error'] = 'Error: ' . $stmt->error; // Include the error message
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $response['success'] = false; // Indicate failure in the response
        $response['error'] = 'Error: ' . $e->getMessage(); // Include the error message
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .message-container {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .success-message {
            color: #4caf50;
        }

        .checkmark {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 4;
            stroke: #4caf50;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards, fill 0.6s ease-in-out 0.4s forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0 0 0 30px #4caf50;
            }
        }
    </style>
    <title>Form Submission Result</title>
</head>

<body>
    <div class="message-container success-message">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
            <path class="checkmark-check" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
        </svg>
        <?php echo 'Formulir berhasil dikirim dan data disimpan ke database!'; ?>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = 'Pesanan.php';
        }, 5000);

        // Handle the response from the PHP code
        var response = <?php echo json_encode($response); ?>;
        var messageContainer = document.querySelector('.message-container');

        if (response.success) {
            messageContainer.innerHTML = '<svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark-check" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>Formulir berhasil dikirim dan data disimpan ke database!';
            messageContainer.classList.add('success-message');
        } else {
            messageContainer.innerHTML = '<div class="error-message">' + response.error + '</div>';
            messageContainer.classList.add('error-message');
        }
    </script>


</body>

</html>