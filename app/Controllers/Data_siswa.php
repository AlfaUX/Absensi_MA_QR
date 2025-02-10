<?php
namespace App\Controllers;

use App\Models\SiswaModel;
use CodeIgniter\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Data_siswa extends Controller
{
    public function index()
    {
        $model = new SiswaModel();
        $data['siswa'] = $model->findAll(); // Ambil semua data siswa
        return view('pages/data_siswa', $data);
    }

    public function tambah()
    {
        return view('pages/tambah_siswa');
    }

    public function simpan()
    {
        $model = new SiswaModel();
        $model->save([
            'nama' => $this->request->getPost('nama'),
            'kelas' => $this->request->getPost('kelas'),
            'email' => $this->request->getPost('email'),
            'nisn' => $this->request->getPost('nisn'),
            'nis' => $this->request->getPost('nis'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to(base_url('siswa'));
    }

    // 🔹 FORM EDIT
    public function edit($id)
    {
        $model = new SiswaModel();
        $data['siswa'] = $model->find($id);

        return view('pages/edit_siswa', $data);
    }

    // 🔹 PROSES UPDATE
    public function update()
    {
        $model = new SiswaModel();
        $id = $this->request->getPost('id');

        $model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'kelas' => $this->request->getPost('kelas'),
            'email' => $this->request->getPost('email'),
            'nisn' => $this->request->getPost('nisn'),
            'nis' => $this->request->getPost('nis'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    
        return redirect()->to(base_url('siswa'))->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new SiswaModel();
        $model->delete($id);
        return redirect()->to('/siswa')->with('success', 'Data berhasil dihapus.');
    }

    // 🔹 UNDUH TEMPLATE CSV
    public function download_template()
    {   
        $filename = "template_siswa.csv";
        $csvData = "Nama,Kelas,Email,NISN,NIS\n"; // Header CSV
        return $this->response
            ->setHeader('Content-Type', 'text/csv')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($csvData);
    }
    
    public function import_csv()
    {
        $model = new SiswaModel();
        $file = $this->request->getFile('csv_file');
    
        if ($file->isValid() && !$file->hasMoved()) {
            $filePath = $file->getTempName();
            $file = fopen($filePath, "r");
    
            // Lewati baris pertama (header CSV)
            fgetcsv($file, 1000, "\t");
    
            while (($data = fgetcsv($file, 1000, "\t")) !== FALSE) {
                // Pastikan jumlah kolom sesuai
                if (count($data) < 3) {
                    continue; // Lewati baris yang tidak sesuai
                }
    
                $siswaData = [
                    'nama'       => $data[0],   
                    'kelas'      => $data[1], // Email opsional
                    'nisn'       => $data[2],
                    'nis'        => $data[3],
                    'email'      => null, // Email opsional
                    'created_at' => date('Y-m-d H:i:s')
                ];
    
                $model->insert($siswaData);
            }
    
            fclose($file);
            return redirect()->to(base_url('siswa'))->with('success', 'Data berhasil diimpor.');
        }
    
        return redirect()->to(base_url('siswa'))->with('error', 'Gagal mengimpor file.');
    }
    
    public function generateQR($id)
    {
        $model = new SiswaModel();
        $siswa = $model->find($id);
    
        if (!$siswa) {
            return redirect()->to(base_url('siswa'))->with('error', 'Data siswa tidak ditemukan.');
        }
    
        // Data QR hanya berisi NISN (bukan Nama)
        $qrData = $siswa['nisn'];
    
        // Buat QR Code
        $qrCode = QrCode::create($qrData)->setSize(300)->setMargin(10);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
    
        // Pastikan browser menampilkan gambar QR Code
        return $this->response->setHeader('Content-Type', $result->getMimeType())
                              ->setBody($result->getString());
    }
    
    
    public function downloadQR($id)
    {
        $model = new SiswaModel();
        $siswa = $model->find($id);
    
        if (!$siswa) {
            return redirect()->to(base_url('siswa'))->with('error', 'Data siswa tidak ditemukan.');
        }
    
        // Data QR hanya berisi NISN
        $qrData = $siswa['nisn'];
    
        // Buat QR Code
        $qrCode = QrCode::create($qrData)->setSize(300)->setMargin(10);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
    
        // Nama file QR Code
        $fileName = 'QR_' . $siswa['nisn'] . '.png';
    
        // Pastikan browser mendownload file QR Code
        return $this->response
            ->setHeader('Content-Type', $result->getMimeType())
            ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
            ->setBody($result->getString());
    }
    

}
