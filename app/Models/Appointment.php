<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public $table = 'appointments';

    protected $fillable = [
        'appointmentDateTime',
        'method',
        'clientId',
        'counselorId',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\User', 'clientId');
    }

    public function counselor()
    {
        return $this->belongsTo('App\Models\User', 'counselorId');
    }

}
