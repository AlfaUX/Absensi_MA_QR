<?php
namespace App\Controllers;

use App\Models\AbsensiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use TCPDF;

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
        $data = $this->absensiModel->getAll();
        $pdf = new TCPDF();
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
        
        $html = '<h2>Laporan Absensi</h2><table border="1" cellpadding="5">
                <tr><th>NISN</th><th>Nama</th><th>Keterangan</th><th>Tanggal</th><th>Waktu</th></tr>';
        foreach ($data as $row) {
            $tanggal = date('d-m-Y', strtotime($row['tanggal']));
            $waktu = date('H:i:s', strtotime($row['waktu_absensi']));
            $html .= "<tr>
                        <td>{$row['nisn']}</td>
                        <td>{$row['nama_siswa']}</td>
                        <td>{$row['keterangan']}</td>
                        <td>{$tanggal}</td>
                        <td>{$waktu}</td>
                      </tr>";
        }
        $html .= '</table>';
        
        $pdf->writeHTML($html);
        $pdf->Output('Laporan_Absensi.pdf', 'D');

        
    }

    public function exportExcel()
    {
        $data = $this->absensiModel->getAll();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', 'NISN');
        $sheet->setCellValue('B1', 'Nama Siswa');
        $sheet->setCellValue('C1', 'Keterangan');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Waktu');
        
        $rowNum = 2;
        foreach ($data as $row) {
            $tanggal = date('d-m-Y', strtotime($row['tanggal']));
            $waktu = date('H:i:s', strtotime($row['waktu_absensi']));
            $sheet->setCellValue("A$rowNum", $row['nisn']);
            $sheet->setCellValue("B$rowNum", $row['nama_siswa']);
            $sheet->setCellValue("C$rowNum", $row['keterangan']);
            $sheet->setCellValue("D$rowNum", $tanggal);
            $sheet->setCellValue("E$rowNum", $waktu);
            $rowNum++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan_Absensi.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $writer->save('php://output');
    }
}
