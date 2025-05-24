<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable = ['nama_kelas'];

    public function santri() { return $this->hasMany(santri::class, 'id_kelas'); }

    public function getRouteKeyName()
    {
        return 'id_kelas';
    }

    
}
