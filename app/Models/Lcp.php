<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lcp extends Model
{
    use HasFactory;
    protected $table = "lcps";
    protected $primaryKey = 'lcp_id';

    public function parameter ()
    {
        return $this->belongsTo(Parameter::class);
    }
}
