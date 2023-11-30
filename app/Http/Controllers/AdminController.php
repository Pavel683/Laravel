<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use App\Services\FormatterServes;
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

    public function unit_tests(){

        $val = '1000000';
        $formatter_serves = new FormatterServes($val);
        $formatted = $formatter_serves->formatted();
        return view('admin.tests', compact('formatted'));
    }

}
