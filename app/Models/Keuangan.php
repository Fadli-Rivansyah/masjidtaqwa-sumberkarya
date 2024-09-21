<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pengeluaran;
use App\Models\Pemasukan;

class Keuangan extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    public function user() {
        return $this->belongsTo(User::class);   
    }
}
