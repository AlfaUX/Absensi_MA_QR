<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code - Absensi</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            background: white;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        #reader {
            width: 100%;
            max-width: 400px;
            margin: auto;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(13, 110, 253, 0.2);
        }

        .scanner-section {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }

        .scanner-header {
            position: relative;
            margin-bottom: 2rem;
        }

        .scan-type-select {
            position: absolute;
            top: 0;
            right: 0;
        }

        .info-card {
            padding: 1.5rem;
            height: 100%;
            margin-bottom: 1rem;
        }

        .info-card h5 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }

        .info-card ul {
            padding-left: 1.2rem;
        }

        .info-card li {
            margin-bottom: 0.8rem;
            color: #34495e;
        }

        .result-card {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 15px;
            text-align: center;
        }

        .result-card h5 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
        }

        .result-info {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 0.8rem;
        }

        .admin-btn {
            background: #3498db;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .admin-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .form-select {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 0.5rem 1rem;
        }

        #scan-result {
            color: #666;
            font-size: 0.9rem;
        }

        /* Animated scanner border */
        @keyframes scan {
            0% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4); }
            100% { box-shadow: 0 0 0 20px rgba(13, 110, 253, 0); }
        }

        #reader {
            animation: scan 1.5s infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-end mb-4">
            <button class="btn admin-btn text-white" onclick="window.location.href='<?= base_url('/pages/admin_login') ?>'">
                <i class="fas fa-user-shield me-2"></i>Login Admin
            </button>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card info-card">
                    <h5><i class="fas fa-lightbulb me-2"></i>Tips Presensi</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check-circle text-success me-2"></i>Pastikan QR Code terlihat jelas</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Gunakan pencahayaan yang cukup</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Jaga lensa kamera tetap bersih</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Hindari pantulan cahaya</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i>Gunakan jaringan internet stabil</li>
                    </ul>
                    <h5><i class="fas fa-clipboard-list me-2"></i>Peraturan Presensi</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-exclamation-circle text-warning me-2"></i>Maksimal datang pukul 07:00</li>
                        <li><i class="fas fa-exclamation-circle text-warning me-2"></i>Absen pulang setelah jam belajar</li>
                        <li><i class="fas fa-exclamation-circle text-warning me-2"></i>Dilarang meminjamkan QR Code</li>
                        <li><i class="fas fa-exclamation-circle text-warning me-2"></i>Ganti QR Code yang rusak</li>
                        <li><i class="fas fa-exclamation-circle text-warning me-2"></i>Keterlambatan dicatat sistem</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card scanner-section">
                    <div class="scanner-header">
                        <div class="scan-type-select">
                            <select class="form-select" id="absensi-type">
                                <option value="datang">Datang</option>
                                <option value="pulang">Pulang</option>
                            </select>
                        </div>
                        <h2 class="text-center mb-4">
                            <i class="fas fa-qrcode me-2"></i>Scan QR Code
                        </h2>
                    </div>
                    <div id="reader"></div>
                    <p id="scan-result" class="text-center mt-3">
                        <i class="fas fa-camera me-2"></i>Arahkan kamera ke QR Code
                    </p>
                </div>
            </div>

            <div class="col-md-2">
                <div class="card result-card">
                    <h5><i class="fas fa-clipboard-check me-2"></i>Hasil Absensi</h5>
                    <div class="result-info">
                        <p class="mb-2"><strong>Nama:</strong><br><span id="result-nama">-</span></p>
                        <p class="mb-2"><strong>NISN:</strong><br><span id="result-nisn">-</span></p>
                        <p class="mb-2"><strong>Kelas:</strong><br><span id="result-kelas">-</span></p>
                        <p class="mb-0"><strong>Keterangan:</strong><br><span id="result-keterangan">-</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <audio id="success-audio" src="<?= base_url('audio/absensi_berhasil.mp3') ?>"></audio>
    <audio id="error-audio" src="<?= base_url('audio/sudah_absen.wav') ?>"></audio>

    <script>
        // Add this at the top of your script
        let scannerActive = true;

        function onScanSuccess(decodedText, decodedResult) {
            if (!scannerActive) return; // Prevent multiple scans
            
            console.log("Scanned QR: ", decodedText);
            
            // Disable scanner temporarily
            scannerActive = false;
            document.getElementById('scan-result').innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';

            const absensiType = document.getElementById('absensi-type').value;

            fetch('<?= base_url("absensi/prosesScan") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'qr_code=' + encodeURIComponent(decodedText) + '&type=' + encodeURIComponent(absensiType)
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);

                if (data.keterangan === 'success') {
                    document.getElementById('result-nama').textContent = data.siswa.nama_siswa;
                    document.getElementById('result-nisn').textContent = data.siswa.nisn;
                    document.getElementById('result-kelas').textContent = data.siswa.id_kelas;
                    document.getElementById('result-keterangan').textContent = data.message;
                    document.getElementById('success-audio').play();
                    
                    // Re-enable scanner after 5 seconds
                    setTimeout(() => {
                        scannerActive = true;
                        document.getElementById('scan-result').innerHTML = '<i class="fas fa-camera me-2"></i>Arahkan kamera ke QR Code';
                    }, 5000);
                } else {
                    document.getElementById('result-keterangan').textContent = data.message;
                    document.getElementById('error-audio').play();
                    
                    // Re-enable scanner after 3 seconds
                    setTimeout(() => {
                        scannerActive = true;
                        document.getElementById('scan-result').innerHTML = '<i class="fas fa-camera me-2"></i>Arahkan kamera ke QR Code';
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('result-keterangan').textContent = 'Gagal memproses scan.';
                
                // Re-enable scanner
                scannerActive = true;
                document.getElementById('scan-result').innerHTML = '<i class="fas fa-camera me-2"></i>Arahkan kamera ke QR Code';
            });
        }

        let html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            { facingMode: "environment" },
            { fps: 10, qrbox: 250 },
            onScanSuccess
        );
    </script>
</body>
</html>