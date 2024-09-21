<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ShohibulQurban;

class Qurban extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function pesertaQurban()
    {
        return $this->hasMany(ShohibulQurban::class);
    }
}
