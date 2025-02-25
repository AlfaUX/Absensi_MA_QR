<?php
namespace App\Controllers;

use App\Models\SiswaModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\RoundBlockSizeMode;
use CodeIgniter\Controller;

class QRCodeController extends Controller
{
    public function generate($id)
    {
        $model = new SiswaModel();
        $siswa = $model->find($id);

        if (!$siswa) {
            return redirect()->to('/siswa')->with('error', 'Siswa tidak ditemukan');
        }

        $writer = new PngWriter();

        // Buat QR Code menggunakan konstruktor baru
        $qrCode = new QrCode(
            data: $siswa['nisn'],
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            foregroundColor: new Color(13, 71, 21),
            backgroundColor: new Color(255, 255, 255)
        );

        // Ambil logo sekolah dari folder
        $logo = new Logo(
            path: FCPATH .'uploads/logo/logo_sekolah.png',
            resizeToWidth: 100
        );

        // Tambahkan label nama siswa
        $label = new Label(
            text: $siswa['nama_siswa'],
            textColor: new Color(13, 71, 21),
            font:new NotoSans (13)
        );

        // Tulis QR Code dengan logo dan label
        $result = $writer->write($qrCode, $logo, $label);

        // Simpan QR Code ke database
        $updateResult = $model->update($id, ['qr_code' => $siswa['nisn']]);

        if (!$updateResult) {
            return redirect()->to('/siswa')->with('error', 'Gagal menyimpan QR Code ke database');
        }

        // Simpan atau tampilkan QR Code
        $filename = $siswa['nama_siswa'] . '.png';
        return $this->response
            ->setHeader('Content-Type', 'image/png')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($result->getString());
    }
}
