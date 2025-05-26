<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_sparepart')
                    ->withPivot('quantity', 'unit_price')
                    ->withTimestamps();
    }
}
