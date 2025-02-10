<?php

namespace App\Models;
use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'nuptk'];

    protected $useTimestamps = true; // Otomatis isi created_at & updated_at
}
