<!DOCTYPE html>
<html>
<head>
    <title>Preview Laporan Absensi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: auto; padding: 20px; }
        h2 { text-align: center; }
        form { margin-bottom: 20px; }
        label { display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        .buttons { margin-top: 20px; display: flex; justify-content: space-between; }
        .buttons button { padding: 10px 20px; cursor: pointer; }
        iframe { width: 100%; height: 600px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Preview Laporan Absensi</h2>

        <form method="post" action="<?= base_url('laporan/generatePDF') ?>" target="pdf_preview">
            <label for="orientation">Orientasi:</label>
            <select name="orientation" id="orientation">
                <option value="P">Potrait</option>
                <option value="L">Landscape</option>
            </select>

            <label for="font_size">Ukuran Font:</label>
            <input type="number" name="font_size" id="font_size" value="12" min="8" max="20">

            <label for="margin">Margin (mm):</label>
            <input type="number" name="margin" id="margin" value="15" min="5" max="50">

            <div class="buttons">
                <button type="submit">Generate Preview</button>
                <button type="button" onclick="window.location.href='<?= base_url('laporan/index') ?>'">Back</button>
            </div>
        </form>

        <iframe name="pdf_preview" title="PDF Preview"></iframe>
    </div>
</body>
</html>
