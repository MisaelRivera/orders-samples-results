<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Sample;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = ['folio', 'numero_muestras', 'fecha_recepcion', 'hora_recepcion'];
    public function samples (): HasMany
    {
        return $this->hasMany(Sample::class, 'order_id', 'id');
    }
}
