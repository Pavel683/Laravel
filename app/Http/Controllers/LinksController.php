<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::get();
        return view('links.list', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
        ];
        Link::create($data);
        return redirect(route('links.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        return view('links.detail', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
        ];
        Link::find($link->id)->update($data);
        return redirect(route('links.show', compact('link')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        //
    }
}
