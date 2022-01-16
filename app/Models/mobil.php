<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobil extends Model
{
    use HasFactory;
    protected $table="mobil";
    protected $filleble=["codemobil","namamobil","warna","tahun","hargaperjam","hargaperhari","keterangan"];
}
