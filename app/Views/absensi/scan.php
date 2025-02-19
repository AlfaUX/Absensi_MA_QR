<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code - Absensi</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js"></script>
</head>
<body>
    <h2>Scan QR Code untuk Absensi</h2>
    
    <div id="reader" style="width: 300px;"></div>
    <p id="scan-result">Arahkan kamera ke QR Code</p>

    <button class="btn btn-primary mt-3" onclick="window.location.href='<?= base_url('/pages/admin_login') ?>'">
        Login Admin
    </button>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('scan-result').innerText = "QR Code: " + decodedText;

            // Kirim NISN ke server
            fetch('<?= base_url("absensi/prosesScan") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'qr_code=' + encodeURIComponent(decodedText)
            })
            .then(response => response.json())
            .then(data => {
                if (data.keterangan === 'success') {
                    alert('Absensi Berhasil: ' + data.siswa.nama);
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
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
