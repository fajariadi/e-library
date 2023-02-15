<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'author', 'genre', 'gambar', 'harga', 'jumlah_halaman', 'jumlah_buku'];
}
