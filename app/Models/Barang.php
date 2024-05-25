<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    public function Merk()
    {
        return $this->belongsTo(Merk::class);
    }
}

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['nama_barang', 'stok', 'merk_id', 'image'];
    protected $visible = ['nama_barang', 'stok', 'merk_id', 'image'];
}


