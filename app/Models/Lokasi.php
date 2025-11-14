<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    // Sesuai migration `create_lokasi_table` nama tabel adalah `lokasi`
    protected $table = 'lokasi';
    protected $primaryKey = 'id_lokasi';

    protected $fillable = ['nama_lokasi'];

    // migration menambahkan timestamps()
    public $timestamps = true;

    public function items()
    {
        return $this->belongsToMany(
            \App\Models\Item::class,
            'list_lokasi',  // nama tabel pivot
            'id_lokasi',    // foreign key untuk Lokasi pada pivot
            'id_item'       // foreign key untuk Item pada pivot
        );
    }
}
