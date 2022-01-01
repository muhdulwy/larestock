<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama'
    ];
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
