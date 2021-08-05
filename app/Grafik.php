<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grafik extends Model
{
    protected $fillable = ['tahun','kategori','siswa','siswa_lulus'];
}
