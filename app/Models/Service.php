<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function spareparts()
    {
        return $this->belongsToMany(Sparepart::class, 'service_sparepart')
                    ->withPivot('quantity', 'unit_price')
                    ->withTimestamps();
    }
}
