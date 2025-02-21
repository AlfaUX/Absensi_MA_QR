<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code - Absensi</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #reader {
            border: 5px solid #0d6efd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        .col-md-6 {
            border: 3px solid #fd650d;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        .col-md-4, .col-md-2 {
            border: 3px solid #198754;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            padding: 15px;
        }
        .tips-box, .rules-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .absensi-result {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
        }
    </style>
</head>
<body class="container py-4">
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-primary" onclick="window.location.href='<?= base_url('/pages/admin_login') ?>'">
            Login Admin
        </button>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="tips-box">
                <h5>Tips Presensi</h5>
                <ul>
                    <li>Pastikan QR Code terlihat jelas.</li>
                    <li>Gunakan pencahayaan yang cukup saat scan.</li>
                    <li>Jaga lensa kamera tetap bersih.</li>
                    <li>Hindari pantulan cahaya di QR Code.</li>
                    <li>Gunakan jaringan internet yang stabil.</li>
                </ul>
            </div>
            <div class="rules-box">
                <h5>Peraturan Presensi</h5>
                <ul>
                    <li>Absensi datang maksimal pukul 07:00.</li>
                    <li>Absensi pulang dilakukan setelah jam belajar selesai.</li>
                    <li>Jangan meminjamkan QR Code pribadi.</li>
                    <li>QR Code yang rusak harus segera diganti.</li>
                    <li>Setiap keterlambatan dicatat dalam sistem.</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6 text-center">
            <select class="form-select w-auto d-inline-block" id="absensi-type">
                <option value="datang">Datang</option>
                <option value="pulang">Pulang</option>
            </select>
            <h2 class="mb-3" >Scan QR Code untuk Absensi</h2>
            <div id="reader" style="width: 300px; margin: auto;"></div>
            <p id="scan-result" class="mt-3">Arahkan kamera ke QR Code</p>
        </div>

        <div class="col-md-2" id="scan-result-container">
            <div class="absensi-result">
                <h5>Hasil Absensi</h5>
                <p><strong>Nama:</strong> <span id="result-nama">-</span></p>
                <p><strong>NISN:</strong> <span id="result-nisn">-</span></p>
                <p><strong>Kelas:</strong> <span id="result-kelas">-</span></p>
                <p><strong>Keterangan:</strong> <span id="result-keterangan">-</span></p>
            </div>
        </div>
    </div>

    <audio id="success-audio" src="<?= base_url('audio/absensi_berhasil.mp3') ?>"></audio>
    <audio id="error-audio" src="<?= base_url('audio/sudah_absen.wav') ?>"></audio>


    <script>
        function onScanSuccess(decodedText, decodedResult) {
            console.log("Scanned QR: ", decodedText);  // Debug QR code hasil scan

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
                console.log(data);  // Debug respon server

                const resultContainer = document.getElementById('scan-result-container');

                if (data.keterangan === 'success') {
                    resultContainer.innerHTML = `
                        <h4>Data Absensi</h4>
                        <p><strong>Nama:</strong> ${data.siswa.nama_siswa}</p>
                        <p><strong>NISN:</strong> ${data.siswa.nisn}</p>
                        <p><strong>Kelas:</strong> ${data.siswa.id_kelas}</p>
                        <p><strong>Keterangan:</strong> ${data.message}</p>
                    `;
                    document.getElementById('success-audio').play();
                } else {
                    resultContainer.innerHTML = `<p class="text-danger">${data.message}</p>`;
                    document.getElementById('error-audio').play();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('scan-result-container').innerHTML = `<p class="text-danger">Gagal memproses scan.</p>`;
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