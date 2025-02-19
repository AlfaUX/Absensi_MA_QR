<?php
namespace App\Controllers;

use App\Models\SiswaModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
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

        $qrCode = QrCode::create($siswa['nisn'])
            ->setSize(300)
            ->setMargin(10);
        
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        $filename = 'QR_' . $siswa['nisn'] . '.png';
        return $this->response
            ->setHeader('Content-Type', 'image/png')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($result->getString());
    }
}
