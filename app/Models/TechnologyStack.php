<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnologyStack extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function pairingRequests()
    {
        return $this->belongsToMany(PairingRequest::class, 'pairing_request_technology_stack');
    }
}
