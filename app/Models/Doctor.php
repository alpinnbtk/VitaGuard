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
        'email',
        'phone_number',
        'gender',
        'address',
        'experience_years',
        'price',
        'rating',
        'photo',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
