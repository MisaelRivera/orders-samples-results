<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;
    protected $table = "methods";

    public function parameter ()
    {
        return $this->belongsTo(Parameter::class);
    }
}
