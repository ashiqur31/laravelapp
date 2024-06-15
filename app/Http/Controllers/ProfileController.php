<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function viewProfile() {
        $userProfile = Auth::user();
        
        return view("profile", compact("userProfile"));
    }
}
