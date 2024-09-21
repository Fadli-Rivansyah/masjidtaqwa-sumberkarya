<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Qurban;

class ShohibulQurban extends Model
{
    use HasFactory;
    protected $guarded= ['id'];

    public function qurban()
    {
        return $this->belongsTo(Qurban::class);
    }
}
