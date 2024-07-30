<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parameter extends Model
{
    use HasFactory;
    protected $table = "parameters";

    public function units(): HasMany 
    {
        return $this->hasMany(Unit::class);
    }

    public function methods(): HasMany 
    {
        return $this->hasMany(Method::class);
    }

    public function lcps(): HasMany 
    {
        return $this->hasMany(Lcp::class);
    }
}
