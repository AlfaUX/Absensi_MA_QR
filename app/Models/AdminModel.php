<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'tb_admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = ['nama', 'username', 'password', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
