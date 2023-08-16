<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type_id',
        'stock',
        'features',
        'price',
        'photos'
    ];

    protected $casts = [
        'photos' => 'array'
    ];

    public function getThumbnailAttribute()
    {
        if ($this->photos) {
            return Storage::url(json_decode($this->photos)[0]);
        }

        return asset('images/default.png');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
