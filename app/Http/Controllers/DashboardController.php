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
        $user = Auth::user();
        $user_id = $user->id;

        $total_users = 0;
        $total_reports = 0;
        $total_payments = 0;
        $ten_contact_messages = 0;
        $reports = 0;
        $total_payments_amount = 0;

        if ($user->isAdmin()){
            $approved_ads = Artwork::whereStatus('1')->count();
            $pending_ads = Artwork::whereStatus('0')->count();
            $blocked_ads = Artwork::whereStatus('2')->count();

            $total_users = User::count();
            $total_payments = Payment::whereStatus('success')->count();
            $total_payments_amount = Payment::whereStatus('success')->sum('amount');
            $ten_contact_messages = Contact_query::take(10)->orderBy('id', 'desc')->get();
        }else{
            $approved_ads = Artwork::whereStatus('1')->whereUserId($user_id)->count();
            $pending_ads = Artwork::whereStatus('0')->whereUserId($user_id)->count();
            $blocked_ads = Artwork::whereStatus('2')->whereUserId($user_id)->count();
        }

        return view('dashboard.user.dashboard', compact('user', 'approved_ads', 'pending_ads', 'blocked_ads', 'total_users', 'total_reports', 'total_payments', 'total_payments_amount', 'ten_contact_messages', 'reports'));
    }
}
