<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Place;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dump('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $place_id = null;
        if ($request->query('place')){
            $place_id = $request->query('place');
        }
        $places = Place::with('type')->get();
        return view('photos_add', compact('places', 'place_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $id = $request->place_id;
        if ($file) {
            $url = $file->store($id, 'public');  // Сохранить файл (Какой, Куда(диск))
            $data = [
                'place_id' => $id,
                'url' => 'public/'.$url,
            ];
            Document::create($data);
        }
        session()->flash('success', 'Файл добавлен!');  // Добавить временные поля в сессию до следующего обновления/действия
        return redirect(route('place_detail', $id));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        dump('show');
        dump($document);
//        return response()->json($document);  // Вернуть просто в json
//        return redirect()->away('https://www.google.com'); // Редирект на внешнюю ссылку
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Document $document)
    {
        dump('edit');
        return view('document_form', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        dump('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Document $document)
    {
        $connections = $document->ratings;
        if ($connections){
            foreach ($connections as $connection){
                $connection->delete();
            }
            $document->ratings()->detach();  // Удаление записей в связующих таблицах
        }
        $document->delete();
        session()->flash('destroy', 'Файл удален!'); // Добавить временные поля в сессию до следующего обновления/действия
        return redirect()->back();
    }

    public function download(Document $document){
        dump('download');
        dump($document);
    }
}
