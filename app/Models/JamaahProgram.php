<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamaahProgram extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    
}
