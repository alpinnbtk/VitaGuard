<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'specialization',
        'gender',
        'experience_years',
        'bio',
        'price',
        'rating',
        'email',
        'phone_number',
        'address',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor_schedules()
    {
        return $this->hasMany(DoctorSchedules::class, 'doctor_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'doctor_id');
    }

    public function consultations()
    {
        return $this->hasManyThrough(
            Consultation::class,
            Booking::class,
            'doctor_id',
            'booking_id',
            'id',
            'id'
        );
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getImageUrlAttribute()
    {
        if (! $this->image) {
            return asset('images/doctors/default-article.jpg');
        }

        if (Str::startsWith($this->image, 'images/doctors/') && file_exists(public_path($this->image))) {
            return asset($this->image);
        }

        return asset('storage/'.$this->image);
    }
}
