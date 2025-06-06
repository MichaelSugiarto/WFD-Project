<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Import the HasUuids trait
use Illuminate\Database\Eloquent\Factories\HasFactory; // Good practice for seeding

class Sparepart extends Model
{
    use HasFactory, HasUuids; // Use HasFactory and HasUuids

    // Indicates if the IDs are auto-incrementing. Set to false for UUIDs.
    public $incrementing = false;

    // The "type" of the primary key. Set to 'string' for UUIDs.
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', // Include 'id' if you're manually providing it in seeders
        'name',
        'stock',
    ];

    /**
     * The services that use this sparepart.
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_sparepart')
                    ->withPivot('quantity', 'unit_price')
                    ->withTimestamps();
    }
}