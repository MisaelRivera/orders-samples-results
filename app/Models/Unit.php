<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = "units";
    protected $primaryKey = 'unit_id';
    protected $guarded = [];

    public function parameter ()
    {
        return $this->belongsTo(Parameter::class, 'units_parameters', 'unit_id', 'parameter_id');
    }
}
