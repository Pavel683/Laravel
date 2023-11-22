<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function admin_menu(){
        return view('admin.admin_menu');
    }

    public function emails_list(){
        $emails = Email::all();
        return view('admin.emails', compact('emails'));
    }

}
