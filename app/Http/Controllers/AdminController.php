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

        return view('admin.tests');
    }

    public function unit_tests_services(Request $request){
        $value = 0;
        if ($request->price){
            $value = $request->price;
        }
        $formatter_serves = new FormatterServes($value); // Обращаемся к своему классу
        $formatted = $formatter_serves->formatted();   // Вызываем его метод
        return view('admin.tests', compact('formatted'));
    }

    public function user_list_admin(){
        $users = User::all();
        return view('admin.user_list', compact('users'));
    }



}
