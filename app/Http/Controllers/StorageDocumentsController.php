<?php

namespace App\Http\Controllers;

use App\Models\StorageDocument;
use Illuminate\Http\Request;

class StorageDocumentsController extends Controller
{

    public function download($document_id)
    {

        $document = StorageDocument::find($document_id);
        return response()->download('storage/'.$document->url, $document->file_name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StorageDocument $storageDocument)
    {
        //
    }
}
