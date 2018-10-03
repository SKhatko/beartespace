<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Contact_query;
use App\Payment;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        $user = auth()->user();


        return view('dashboard.user.dashboard', compact('user'));
    }
}
