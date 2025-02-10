<?php

namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin'; // sesuaikan nama tabel
    protected $allowedFields = ['username', 'password'];
    // ...
}
