<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'control_no',
        'resident_id',
        'citizen_name',
        'contact_no',
        'email',
        'purok',
        'doc_type',
        'purpose',
        'ctc_no',
        'or_no',
        'amount_paid',
        'status',
        'issued_by',
        'issue_date',
        'expiry_date',
        'remarks',
    ];

    protected $casts = [
        'amount_paid' => 'decimal:2',
        'issue_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
