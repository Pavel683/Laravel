<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function setAdmin(Request $request){
        $user_id = $request->query('user');
        User::find($user_id)->setAdmin();
        return redirect()->back();
    }
    public function delAdmin(Request $request){
        $user_id = $request->query('user');
        User::find($user_id)->delAdmin();
        return redirect()->back();
    }
    public function setActive(Request $request){
        $user_id = $request->query('user');
        User::find($user_id)->setActive();
        return redirect()->back();
    }
    public function delActive(Request $request){
        $user_id = $request->query('user');
        User::find($user_id)->delActive();
        return redirect()->back();
    }


}
