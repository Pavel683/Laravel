<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Models\CocktailProperty;
use App\Services\ValidIngredientsServes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CocktailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = '';
        if ($request->query('search')){
            $search = $request->query('search');
        }

        $menu_checkbox = $request->query('menu');
        $in_menu = false;
        if ($menu_checkbox && $menu_checkbox == "true"){
            $in_menu = true;
        }

        $filter_properties = collect();
        $filter_cocktails_valid_list = array();
        if ($request->query('prop')){

            $filter_params = $request->query('prop');
            $filter_params_arr = explode(';', $filter_params);
            $filter_params_count = count($filter_params_arr) - 1;
            $filter_properties = CocktailProperty::find($filter_params_arr);
            $filter_cocktails = array();

            foreach ($filter_properties as $filter_property){
                $filter_cocktails = array_merge($filter_cocktails, $filter_property->cocktails->map->id->toArray());
            }
            $filter_cocktails_excess = array_count_values($filter_cocktails);

            foreach ($filter_cocktails_excess as $key=>$cocktails_excess){
                if ($cocktails_excess == $filter_params_count){
                    $filter_cocktails_valid_list[] = $key;
                }
            }
            if (empty($filter_cocktails_valid_list)) {
                $filter_cocktails_valid_list[] = 0;
            }
        }

        $cocktails = new Cocktail();
        if ($search){
            $cocktails = $cocktails->where(function (Builder $query) use ($search){
                $query->where('name', 'like', '%'.$search.'%')->orWhere('ingredients', 'like', '%'.$search.'%');
            });
        }

        if ($in_menu) {
            $cocktails = $cocktails->where('in_menu', 1);
        }

        if ($filter_cocktails_valid_list){
            $cocktails = $cocktails->whereIn('id', $filter_cocktails_valid_list);
        }

        $cocktails = $cocktails->get();



        $properties = CocktailProperty::get();
        return view('cocktails.list', compact('cocktails', 'properties', 'filter_properties', 'in_menu', 'search'));
    }

    public function cocktails_menu(Request $request)
    {

        $search = '';
        if ($request->query('search')){
            $search = $request->query('search');
        }

        $filter_properties = collect();
        $filter_cocktails_valid_list = array();
        if ($request->query('prop')){

            $filter_params = $request->query('prop');
            $filter_params_arr = explode(';', $filter_params);
            $filter_params_count = count($filter_params_arr) - 1;
            $filter_properties = CocktailProperty::find($filter_params_arr);
            $filter_cocktails = array();

            foreach ($filter_properties as $filter_property){
                $filter_cocktails = array_merge($filter_cocktails, $filter_property->cocktails->map->id->toArray());
            }
            $filter_cocktails_excess = array_count_values($filter_cocktails);

            foreach ($filter_cocktails_excess as $key=>$cocktails_excess){
                if ($cocktails_excess == $filter_params_count){
                    $filter_cocktails_valid_list[] = $key;
                }
            }
            if (empty($filter_cocktails_valid_list)) {
                $filter_cocktails_valid_list[] = 0;
            }
        }

        $cocktails = new Cocktail();
        if ($search){
            $cocktails = $cocktails->where(function (Builder $query) use ($search){
                $query->where('name', 'like', '%'.$search.'%')->orWhere('ingredients', 'like', '%'.$search.'%');
            });
        }
        if ($filter_cocktails_valid_list){
            $cocktails = $cocktails->where('in_menu', 1)->find($filter_cocktails_valid_list);
        }else{
            $cocktails = $cocktails->where('in_menu', 1)->get();
        }

        $properties = CocktailProperty::get();
        return view('cocktails_menu.list', compact('cocktails', 'properties', 'filter_properties', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cocktails.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ingredients_list =  $request->ingredients;
        $ingredients_list = '• '.str_replace("\n", "\n• ", $ingredients_list);
        $data = [
            'name' => $request->name,
            'ingredients' => $ingredients_list,
            'description' => $request->description
        ];
        $cocktail = Cocktail::create($data);

        $photos = $request->file('photos');
        if ($photos){
            foreach ($photos as $photo){
                $path = $photo->store('StorageDocument', 'public');
                $image = [
                    'url' => $path,
                ];
                $cocktail->storage_documents()->create($image);
            }
        }

        return redirect(route('cocktails.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cocktail $cocktail)
    {
        $properties = CocktailProperty::get();
        $images = $cocktail->storage_documents;
        $binding_properties = $cocktail->cocktail_properties()->orderBy('cocktail_property_id')->get();

        $ingredient_list = new ValidIngredientsServes($cocktail->ingredients);
        $ingredient_list = $ingredient_list->formatted();

        return view('cocktails.detail', compact('cocktail', 'images', 'properties', 'binding_properties', 'ingredient_list'));
    }

    public function cocktails_menu_detail($cocktail_id)
    {
        $cocktail = Cocktail::find($cocktail_id);
        $properties = CocktailProperty::get();
        $images = $cocktail->storage_documents;
        $binding_properties = $cocktail->cocktail_properties()->orderBy('cocktail_property_id')->get();
        return view('cocktails_menu.detail', compact('cocktail', 'images', 'properties', 'binding_properties'));
    }



    public function set_in_menu(Request $request)
    {
        $cocktail_id = $request->query('cocktail');
        Cocktail::find($cocktail_id)->setInMenu();
        return redirect()->back();
    }
    public function del_in_menu(Request $request)
    {
        $cocktail_id = $request->query('cocktail');
        Cocktail::find($cocktail_id)->delInMenu();
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cocktail $cocktail)
    {
        $ingredients_list =  $cocktail->ingredients;
        $ingredients_list = str_replace("• ", "", $ingredients_list);
        $images = $cocktail->storage_documents;
        return view('cocktails.update', compact('cocktail', 'ingredients_list', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cocktail $cocktail)
    {
        $ingredients_list =  $request->ingredients;
        $ingredients_list = '• '.str_replace("\n", "\n• ", $ingredients_list);
        $data = [
            'name' => $request->name,
            'ingredients' => $ingredients_list,
            'description' => $request->description
        ];
        Cocktail::find($cocktail->id)->update($data);


        if ($request->old_photo){
            $old_photo = $request->old_photo;
        }else{
            $old_photo = array();
        }
        $images = $cocktail->storage_documents;

        foreach ($images as $image){
            $image_id = $image->id;
            if (!in_array($image_id, $old_photo)) {
                Storage::disk('public')->delete($image->url);
                $image->delete();
                $cocktail->storage_documents()->detach($image_id);  // Удаление записей в связующих таблицах
            }
        }

        $photos = $request->file('photos');
        if ($photos){
            foreach ($photos as $photo){
                $path = $photo->store('StorageDocument', 'public');
                $img = [
                    'url' => $path,
                ];
                $cocktail->storage_documents()->create($img);
            }
        }

        return redirect(route('cocktails.show', compact('cocktail')));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cocktail $cocktail)
    {
        $documents = $cocktail->storage_documents;
        if ($documents){
            foreach ($documents as $document){
                Storage::disk('public')->delete($document->url);
                $document->delete();
            }
            $cocktail->storage_documents()->detach();  // Удаление записей в связующих таблицах
        }
        $cocktail->cocktail_properties()->detach();
        $cocktail->delete();

        return redirect(route('cocktails.index'));
    }
}
