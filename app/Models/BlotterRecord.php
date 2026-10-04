<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlotterRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_no',
        'complainant_name',
        'complainant_address',
        'complainant_contact',
        'respondent_name',
        'respondent_address',
        'incident_type',
        'incident_location',
        'incident_date',
        'narrative',
        'status',
        'presiding_officer',
        'hearing_date',
        'resolution_details',
    ];

    protected $casts = [
        'incident_date' => 'datetime',
        'hearing_date' => 'datetime',
    ];
}
