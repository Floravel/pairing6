<?php

namespace App\Http\Controllers;

use App\Http\Resources\PairingRequestCollection;
use App\Models\User;
use Illuminate\Http\Request;

class UserPairingRequestController extends Controller
{
    public function index(User $user) {

        return new PairingRequestCollection($user->pairingRequests);
    }
}





