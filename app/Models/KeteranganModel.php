<?php
namespace App\Models;

use CodeIgniter\Model;

class KeteranganModel extends Model
{
    protected $table = 'tb_keterangan';
    protected $primaryKey = 'id_keterangan';
    protected $allowedFields = ['keterangan']; // Sesuaikan dengan kolom di database
}
