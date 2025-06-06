<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Import the HasUuids trait
use Illuminate\Database\Eloquent\Factories\HasFactory; // Often useful for seeding

class Vehicle extends Model
{
    use HasFactory, HasUuids; // Use the HasFactory and HasUuids traits

    // Indicates if the IDs are auto-incrementing. Set to false for UUIDs.
    public $incrementing = false;

    // The "type" of the auto-incrementing ID. Set to 'string' for UUIDs.
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', // Include 'id' if you're manually providing it during creation (e.g., in seeders)
        'license_plate',
        'brand',
        'model',
        'year_production',
        'user_id',
    ];

    /**
     * Get the user that owns the vehicle.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the services for the vehicle.
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}