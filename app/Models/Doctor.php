<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            'doctor_id',         // FK di tabel bookings → merujuk ke doctors.id
            'booking_id',        // FK di tabel consultations → merujuk ke bookings.id
            'id',                // PK di tabel doctors
            'id'                 // PK di tabel bookings
        );
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
