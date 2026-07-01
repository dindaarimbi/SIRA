<?php

namespace App\Models;

use CodeIgniter\Model;

class IndikatorModel extends Model
{
    protected $table = 'indikator';
    protected $primaryKey = 'id_indikator';
    protected $allowedFields = [
        'id_kriteria',
        'kode_indikator',
        'nama_indikator'
    ];
}