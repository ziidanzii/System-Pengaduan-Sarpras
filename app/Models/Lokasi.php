<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasis';        // nama tabel sesuai DB
    protected $primaryKey = 'id_lokasi'; // primary key sesuai DB

    protected $fillable = ['nama_lokasi'];

    public $timestamps = false; // jika tabel tidak punya created_at / updated_at

   public function items()
{
    return $this->belongsToMany(
        Item::class,
        'list_lokasi',  // tabel pivot YANG BENAR
        'id_lokasi',    // foreign key untuk Lokasi
        'id_item'       // foreign key untuk Item
    );
}

}
