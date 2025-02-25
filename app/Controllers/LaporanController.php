<?php
namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\ProfilSekolahModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanController extends BaseController
{
    protected $absensiModel;

    public function __construct()
    {
        $this->absensiModel = new AbsensiModel();
    }

    public function index()
    {
        $data['absensi'] = $this->absensiModel->getAll();
        return view('laporan/index', $data);
    }

    public function exportPdf()
    {
        // Load model ProfilSekolahModel
        $profilModel = new ProfilSekolahModel();
        $profil = $profilModel->first(); // Ambil data kop

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($options);

        // Path logo
        $logoPath = FCPATH . $profil['logo'];

        if (file_exists($logoPath)) {
            $logoData = file_get_contents($logoPath);
            $base64Logo = 'data:image/png;base64,' . base64_encode($logoData);
        } else {
            $base64Logo = ''; // Jika file tidak ditemukan
        }
        
        // Kop surat
        $kop = '<div style="text-align: center;">
                    <img src="<?= $base64Logo ?>" width="80" style="display: block; margin: 0 auto;">
                    <h3>' . $profil['nama_sekolah'] . '</h3>
                    <p>' . $profil['alamat'] . '</p>
                    <p>Tahun Pelajaran: ' . $profil['tahun_pelajaran'] . '</p>
                </div>
                <hr><br>';

        // Judul Laporan
        $html = '<h3 style="text-align: center;">Laporan Absensi</h3>';
        
        // Tabel Absensi
        $html .= '<table border="1" cellspacing="0" cellpadding="5" width="100%">
                    <tr><th>NISN</th><th>Nama</th><th>Keterangan</th><th>Tanggal</th><th>Jam Masuk</th><th>Jam Pulang</th></tr>';
        
        foreach ($this->absensiModel->getAll() as $row) {
            $html .= "<tr>
                        <td>{$row['nisn']}</td>
                        <td>{$row['nama_siswa']}</td>
                        <td>{$row['keterangan']}</td>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['jam_masuk']}</td>
                        <td>{$row['jam_pulang']}</td>
                    </tr>";
        }
        $html .= '</table>';

        // Gabungkan HTML
        $dompdf->loadHtml($kop . $html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output PDF
        $dompdf->stream('Laporan_Absensi.pdf', ['Attachment' => false]);
    }
    
    public function exportExcel()
    {
        $profilModel = new ProfilSekolahModel();
        $profil = $profilModel->first(); // Ambil data kop surat
    
        $data = $this->absensiModel->getAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Kop Surat
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', $profil['nama_sekolah']);
        $sheet->mergeCells('A2:E2');
        $sheet->setCellValue('A2', $profil['alamat']);
        $sheet->mergeCells('A3:E3');
        $sheet->setCellValue('A3', 'Tahun Pelajaran: ' . $profil['tahun_pelajaran']);
        $sheet->mergeCells('A4:E4');
        $sheet->setCellValue('A4', 'LAPORAN ABSENSI');
        $sheet->getStyle('A1:A4')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A4')->getFont()->setSize(16)->setUnderline(true);
    
        // Header Tabel
        $sheet->setCellValue('A6', 'NISN');
        $sheet->setCellValue('B6', 'Nama');
        $sheet->setCellValue('C6', 'Keterangan');
        $sheet->setCellValue('D6', 'Tanggal');
        $sheet->setCellValue('E6', 'Jam Masuk'); 
        $sheet->setCellValue('F6', 'Jam Pulang'); 
        $sheet->getStyle('A6:E6')->getFont()->setBold(true);
    
        // Isi Data
        $row = 7;
        foreach ($data as $absen) {
            $tanggal = date('d-m-Y', strtotime($absen['tanggal']));
            $waktu = date('H:i:s', strtotime($absen['jam_masuk']));
    
            $sheet->setCellValue('A' . $row, $absen['nisn']);
            $sheet->setCellValue('B' . $row, $absen['nama_siswa']);
            $sheet->setCellValue('C' . $row, $absen['keterangan']);
            $sheet->setCellValue('D' . $row, $tanggal);
            $sheet->setCellValue('E' . $row, $waktu); 
            $sheet->setCellValue('F' . $row, $waktu); 
            $row++;
        }
    
        // Auto-size kolom
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    
        // Output Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Absensi';
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
        exit();
    }
}
