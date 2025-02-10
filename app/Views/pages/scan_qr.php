<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .scanner-container {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .scanner-frame {
            position: relative;
            width: 100%;
            padding-top: 100%; /* Membuat aspect ratio 1:1 */
            border: 4px solid #007bff;
            border-radius: 10px;
            margin-bottom: 10px;
            background: black;
        }
        .scanner-frame video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }
        .scanner-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="scanner-container">
        <div class="scanner-title">Scan untuk Absensi</div>
        <div class="scanner-frame">
            <video id="preview"></video>
        </div>
        <button class="btn btn-primary mt-3" onclick="window.location.href='<?= base_url('/pages/admin_login') ?>'">
            Login Admin
        </button>
    </div>
    
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

        scanner.addListener('scan', function (content) {
            alert("✅ QR Code Terbaca: " + content); // Notifikasi sukses scan

            $.post("<?= base_url('/qr/absen') ?>", { qr_data: content })
                .done(function(response) {
                    alert("✅ Absensi Berhasil!"); // Notifikasi sukses absen
                    console.log("Response dari server:", response);
                })
                .fail(function(xhr, status, error) {
                    alert("❌ Gagal Absen! Periksa koneksi atau coba lagi.");
                    console.error("Error:", error);
                });
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert("❌ Tidak ada kamera terdeteksi.");
            }
        }).catch(function (e) {
            console.error(e);
        });
    </script>

</body>
</html>