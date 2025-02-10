<?php
namespace App\Controllers;

use App\Models\GuruModel;
use CodeIgniter\Controller;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class Data_guru extends Controller
{
    public function index()
    {
        $model = new GuruModel();
        $data['guru'] = $model->findAll();
        return view('pages/data_guru', $data);
    }

    public function tambah()
    {
        return view('pages/tambah_guru');
    }

    public function simpan()
    {
        $model = new GuruModel();
        $model->save([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'nuptk' => $this->request->getPost('nuptk'), // perbaikan nama field
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to(base_url('guru'))->with('success', 'Guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new GuruModel();
        $data['guru'] = $model->find($id);

        return view('pages/edit_guru', $data);
    }

    public function update()
    {
        $model = new GuruModel();
        $id = $this->request->getPost('id');

        $model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'nuptk' => $this->request->getPost('nuptk'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to(base_url('guru'))->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new GuruModel();
        $model->delete($id);
        return redirect()->to(base_url('guru'))->with('success', 'Data berhasil dihapus.');
    }

    public function download_template()
    {   
        $filename = "template_guru.csv";
        $csvData = "Nama,Email,NUPTK\n";
        return $this->response
            ->setHeader('Content-Type', 'text/csv')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($csvData);
    }

    public function import_csv()
    {
        $model = new GuruModel();
        $file = $this->request->getFile('csv_file');

        if ($file->isValid() && !$file->hasMoved()) {
            $filePath = $file->getTempName();
            $file = fopen($filePath, "r");

            fgetcsv($file); // Lewati header

            while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
                if (count($data) < 3) {
                    continue;
                }

                $guruData = [
                    'nama' => $data[0],   
                    'email' => $data[1],
                    'nuptk' => $data[2],
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $model->insert($guruData);
            }

            fclose($file);
            return redirect()->to(base_url('guru'))->with('success', 'Data berhasil diimpor.');
        }

        return redirect()->to(base_url('guru'))->with('error', 'Gagal mengimpor file.');
    }

    public function generateQR($id)
    {
        $model = new GuruModel();
        $guru = $model->find($id);

        if (!$guru) {
            return redirect()->to(base_url('guru'))->with('error', 'Data guru tidak ditemukan.');
        }

        $qrData = $guru['nuptk'];

        $qrCode = QrCode::create($qrData)->setSize(300)->setMargin(10);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        return $this->response->setHeader('Content-Type', $result->getMimeType())
                              ->setBody($result->getString());
    }

    public function downloadQR($id)
    {
        $model = new GuruModel();
        $guru = $model->find($id);

        if (!$guru) {
            return redirect()->to(base_url('guru'))->with('error', 'Data guru tidak ditemukan.');
        }

        $qrData = $guru['nuptk'];

        $qrCode = QrCode::create($qrData)->setSize(300)->setMargin(10);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        $fileName = 'QR_' . $guru['nuptk'] . '.png';

        return $this->response
            ->setHeader('Content-Type', $result->getMimeType())
            ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
            ->setBody($result->getString());
    }
}
