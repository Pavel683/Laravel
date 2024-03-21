<?php

namespace App\Http\Controllers;

use App\Models\CategoryNote;
use App\Models\Note;
use App\Models\StatusNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::get();
        $categories = CategoryNote::get();
        $statuses = StatusNote::get();
        $notes_in_categories = array();
        foreach ($categories as $category){
            $notes_in_categories[$category->id] = $category->notes;
        }
        return view('notes.list', compact('categories', 'statuses', 'notes_in_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryNote::get();
        $statuses = StatusNote::get();
        return view('notes.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'dop_note' => $request->dop_note,
        ];
        $note = Note::create($data);

        $documents = $request->file('documents');
        if ($documents){
            foreach ($documents as $document){
                $file_name = $document->getClientOriginalName();
                $path = $document->store('StorageDocument', 'public');
                $doc = [
                    'url' => $path,
                    'file_name' => $file_name,
                ];
                $note->storage_documents()->create($doc);
            }
        }

        return redirect(route('notes.index', 'no_hidden='.$request->category_id));
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        $categories = CategoryNote::get();
        $statuses = StatusNote::get();
        $documents = $note->storage_documents;
        return view('notes.detail', compact('note', 'categories', 'statuses', 'documents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $data = [
            'title' => $request->title,
            'category_id' => $request->category_id,
            'status_id' => $request->status_id,
            'dop_note' => $request->dop_note,
        ];
        Note::find($note->id)->update($data);

        $old_document = $request->old_document;
        $documents = $note->storage_documents;

        foreach ($documents as $document){
            $document_id = $document->id;
            if (!in_array($document_id, $old_document)) {
                Storage::disk('public')->delete($document->url);
                $document->delete();
                $note->storage_documents()->detach($document_id);  // Удаление записей в связующих таблицах
            }
        }

        $files = $request->file('documents');
        if ($files){
            foreach ($files as $file){
                $file_name = $file->getClientOriginalName();
                $path = $file->store('StorageDocument', 'public');
                $doc = [
                    'url' => $path,
                    'file_name' => $file_name,
                ];
                $note->storage_documents()->create($doc);
            }
        }

        return redirect(route('notes.show', compact('note')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $documents = $note->storage_documents;
        if ($documents){
            foreach ($documents as $document){
                Storage::disk('public')->delete($document->url);
                $document->delete();
            }
            $note->storage_documents()->detach();  // Удаление записей в связующих таблицах
        }
        $note->delete();

        return redirect(route('notes.index'));
    }
}
