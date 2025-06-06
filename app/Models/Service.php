<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Import the HasUuids trait
use Illuminate\Database\Eloquent\Factories\HasFactory; // Good practice for factories

class Service extends Model
{
    use HasFactory, HasUuids; // Use HasFactory and HasUuids

    // Indicate that the primary key is not auto-incrementing
    public $incrementing = false;

    // Specify the type of the primary key as 'string' for UUIDs
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', // Include 'id' if you're setting it manually (e.g., in seeders)
        'description',
        'status',
        'start_date',
        'end_date',
        'total_cost',
        'vehicle_id', // Make sure vehicle_id is fillable
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