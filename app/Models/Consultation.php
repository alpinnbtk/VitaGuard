<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'started_at',
        'ended_at',
        'status',
        'summary',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function consultation_messages()
    {
        return $this->hasMany(ConsultationMessages::class, 'consultation_id');
    }
}
