<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'gender',
        'birth_date',
        'civil_status',
        'purok',
        'address',
        'contact_no',
        'email',
        'occupation',
        'monthly_income',
        'voter_status',
        'voter_precinct',
        'is_senior',
        'is_pwd',
        'is_indigent',
        'is_4ps',
        'is_solo_parent',
        'id_type',
        'id_number',
        'id_photo',
        'proof_of_residency',
        'verification_status',
        'verification_remarks',
        'photo',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'monthly_income' => 'decimal:2',
        'is_senior' => 'boolean',
        'is_pwd' => 'boolean',
        'is_indigent' => 'boolean',
        'is_4ps' => 'boolean',
        'is_solo_parent' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        $middle = $this->middle_name ? ' ' . $this->middle_name : '';
        $suffix = $this->suffix ? ' ' . $this->suffix : '';
        return "{$this->first_name}{$middle} {$this->last_name}{$suffix}";
    }

    public function getAgeAttribute()
    {
        return $this->birth_date ? $this->birth_date->age : 0;
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function aidDistributions()
    {
        return $this->hasMany(AidDistribution::class);
    }
}
