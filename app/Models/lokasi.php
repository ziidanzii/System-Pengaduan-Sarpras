<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    // adjust table/primaryKey if your DB uses different names
    protected $table = 'lokasis';
    // protected $primaryKey = 'id_lokasi';

    // allow mass assignment for nama_lokasi (add others if needed)
    protected $fillable = ['nama_lokasi'];

    // if your table doesn't have timestamps, uncomment:
    // public $timestamps = false;

    // example relation (optional) — adjust relation name and pivot/table if different
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_lokasi', 'id_lokasi', 'id_item');
    }
}
