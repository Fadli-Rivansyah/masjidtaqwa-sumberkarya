<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\User;
use App\models\JamaahProgram;

class Program extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jamaah()
    {
        return $this->hasMany(JamaahProgram::class);
    }
}
