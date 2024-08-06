<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parameter extends Model
{
    use HasFactory;
    protected $table = "parameters";
    protected $primaryKey = 'parameter_id';
    protected $fillable = ['name'];

    public function units(): HasMany 
    {
        return $this->hasMany(Unit::class, 'units_parameters', 'parameter_id', 'unit_id');
    }

    public function methods(): HasMany 
    {
        return $this->hasMany(Method::class, 'methods_parameters', 'parameter_id', 'method_id');
    }

    public function lcps(): BelongsToMany 
    {
        return $this->belongsToMany(Lcp::class, 'lcps_parameters', 'parameter_id', 'lcp_id');
    }
}
