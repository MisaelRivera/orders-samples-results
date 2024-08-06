<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;
    protected $table = "methods";
    protected $primaryKey = 'method_id';
    protected $guarded = [];

    public function parameter ()
    {
        return $this->belongsTo(Parameter::class, 'methods_parameters', 'method_id', 'parameter_id');
    }
}
