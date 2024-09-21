<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Zakat;

class Muzakki extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function zakat()
    {
        return $this->hasOne(Zakat::class);
    }
}
