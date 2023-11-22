<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class EmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'max:255'],
        ]);

        $data = [
            'email' => $request->email,
            'text' => $request->message
        ];
        Email::create($data);
//        dd($data);
        session()->flash('success', 'Мы свяжемся с вами в ближайшее время');  // Добавить временные поля в сессию до следующего обновления/действия
        return redirect(route('forms'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Email $email)
    {
        //
    }
}
