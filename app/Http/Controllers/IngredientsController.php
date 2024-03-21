<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredient_categories = IngredientCategory::get();
        $ingredients_in_categories = array();
        foreach ($ingredient_categories as $category){
            $ingredients_in_categories[$category->id] = $category->ingredients;
        }
//        $ingredients = Ingredient::get();
        return view('ingredients.list', compact('ingredient_categories','ingredients_in_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ingredient_categories = IngredientCategory::get();
        return view('ingredients.create', compact('ingredient_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id
        ];
        $ingredient = Ingredient::create($data);

        $photos = $request->file('photos');
        if ($photos){
            foreach ($photos as $photo){
                $path = $photo->store('StorageDocument', 'public');
                $image = [
                    'url' => $path,
                ];
                $ingredient->storage_documents()->create($image);
            }
        }

        return redirect(route('ingredients.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        dump($ingredient->category->name);
        $images = $ingredient->storage_documents;
        return view('ingredients.detail', compact('ingredient', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        $ingredient_categories = IngredientCategory::get();
        $images = $ingredient->storage_documents;
        return view('ingredients.update', compact('ingredient', 'images', 'ingredient_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ];
        Ingredient::find($ingredient->id)->update($data);


        if ($request->old_photo){
            $old_photo = $request->old_photo;
        }else{
            $old_photo = array();
        }
        $images = $ingredient->storage_documents;

        foreach ($images as $image){
            $image_id = $image->id;
            if (!in_array($image_id, $old_photo)) {
                Storage::disk('public')->delete($image->url);
                $image->delete();
                $ingredient->storage_documents()->detach($image_id);  // Удаление записей в связующих таблицах
            }
        }

        $photos = $request->file('photos');
        if ($photos){
            foreach ($photos as $photo){
                $path = $photo->store('StorageDocument', 'public');
                $img = [
                    'url' => $path,
                ];
                $ingredient->storage_documents()->create($img);
            }
        }

        return redirect(route('ingredients.show', compact('ingredient')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $documents = $ingredient->storage_documents;
        if ($documents){
            foreach ($documents as $document){
                Storage::disk('public')->delete($document->url);
                $document->delete();
            }
            $ingredient->storage_documents()->detach();  // Удаление записей в связующих таблицах
        }
        $ingredient->delete();

        return redirect(route('ingredients.index'));
    }
}
