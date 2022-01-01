<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    
    protected $table = 'stocks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'status',
        'jumlah',
        'tgl_order',
        'barang_id'
        
    ];
    
    public function barangs()
    {
        return $this->belongsTo(Barang::class);
    }
}
