<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'description',
        'status',
        'start_date',
        'end_date',
        'total_cost',
        'vehicle_id',
        'appointment_date', 
        'notes',           
    ];

    /**
     * Get the vehicle that the service belongs to.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * The spareparts that are used for this service.
     */
    public function spareparts()
    {
        return $this->belongsToMany(Sparepart::class, 'service_sparepart')
                    ->withPivot('quantity', 'unit_price')
                    ->withTimestamps();
    }
}