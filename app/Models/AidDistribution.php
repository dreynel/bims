<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AidDistribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_name',
        'distribution_date',
        'resident_id',
        'beneficiary_name',
        'purok',
        'assistance_type',
        'amount_or_quantity',
        'status',
        'distributor_name',
    ];

    protected $casts = [
        'distribution_date' => 'date',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
