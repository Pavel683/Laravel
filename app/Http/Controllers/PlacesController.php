<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Models\Document;
use App\Models\Name;
use App\Models\Place;
use App\Models\Rating;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class PlacesController extends Controller
{
    public function places(Request $request){

        $user_id = null;
        $type_id = null;
        if ($request->query()){ // Проверяем GET параметры

            if ($request->query('user')){
                $user_id = $request->query('user');
                $name_user = User::find($user_id);
                $all_places_user = $name_user->places;
                $filter_user_place = $all_places_user->map->id; // Метод map Позволяет получить колекцию по названию свойства/Колонки
//              dump($name_user->places()->where('type_id', '=', 'Гора')->get()); // Фильтрация в запросе
            }

            if ($request->query('type')){
                $type_id = $request->query('type');
            }

            if (isset($user_id) && isset($type_id)){
                $places = Place::with('type')->where('type_id', '=', $type_id)->find($filter_user_place);
            }elseif (isset($user_id) && !isset($type_id)){
                $places = Place::with('type')->find($filter_user_place);
            }elseif (!isset($user_id) && isset($type_id)){
                $places = Place::with('type')->where('type_id', '=', $type_id)->get(); // ->toSQL() - просмотреть запрос
            }else{
                $places = Place::with('type')->get();
            }

//            $places = Place::with('type')->find($filter_user_place);  // Подзапрос позволяет уменьшить количество запросов к бд, мы сразу фильтруем, а не отдельно для каждого
        }else{
            $places = Place::with('type')->get(); // Подзапрос позволяет уменьшить количество запросов к бд, мы сразу фильтруем, а не отдельно для каждого
//            $places = Place::all();
//            dd($places);
        }
        $types = Type::all();
        return view('places', compact('places', 'types', 'type_id'));
    }



    public function create(){

        $types = Type::all();
        $users = User::all();
        return view('create_place', compact('types', 'users'));
    }



    public function form(PlaceRequest $request){
        Place::create($request->all());
        return redirect(route('places'));
    }



    public function detail($place_id){
//        $place_detail = Place::find($place_id);  // Получаем конкретное место
//        $creater_nane = $test->name;             // Ищем пользователя создавшего

//        $name_user = Name::find(4);
//        $all_places_user = $name_user->place;

        /**
         * Получаем место
         */
        $place = Place::findOrfail($place_id);

        /**
         * Получаем пользователя
         */
        $user = $place->user_created;  // Полученый объект элементов класса Place -> Метод name который сопоставляет поле user_created_id таблицы Place к полу id таблицы Name -> Метод getFioAttribute() класса Name который подставляет замену

        /**
         * Получаем доки
         */
//        $images = Storage::allFiles('public/'.$place_id); // Получение файлов из объекта Storage
        $documents = $place->documents; // Получение файлов с помощью метода
                                        // Если методы доя моделей пишем как documents то получаем коллекцию которую можно выводить
                                        // Если как documents() то как конструктор запросов и можно дальше вызывать соответствующие методы
        /**
         * Получаем рейтинг
         */
        $ratings = [
            'place' => 0,
            'document' => 0
        ];
        $place_ratings = $place->ratings;
        foreach ($place_ratings as $place_rating){
            if ($place_rating->type_rating == 'like'){
                $ratings['place']++;
            }elseif ($place_rating->type_rating == 'dislike'){
                $ratings['place']--;
            }
        }
        foreach ($documents as $document){
            $document_ratings = $document->ratings;
            foreach ($document_ratings as $document_rating){
                if ($document_rating->type_rating == 'like'){
                    $ratings['document']++;
                }elseif ($document_rating->type_rating == 'dislike'){
                    $ratings['document']--;
                }
            }
        }
//        dump($ratings);
        return view('place_detail', compact('place', 'documents', 'user', 'ratings'));
    }


    /**
     *
     * Функционал работы с документами перенесен в DocumentsController
     ****************************************************************************************

//    public function photos_add($place_id){
//        $places = Place::with('type')->get();
//        return view('photos_add', compact('places', 'place_id'));
//    }

//    public function upload(Request $request){
////        dd($request->file('file')->getClientOriginalName());
//
////        dd($request);
//        $file = $request->file('file');
//        $id = $request->place_id;
//        if ($file) {
//            $url = $file->store($id, 'public');  // Сохранить файл (Какой, Куда(диск))
//            $data = [
//                'place_id' => $id,
//                'url' => 'public/'.$url,
//            ];
////            dd($data);
//            Document::create($data);
//        }
//
//        return redirect(route('place_detail', $id));
//    }
     *****************************************************************************************
     */


    public function show_ratings(Request $request){

//        $documents = Document::all();
//        dump($documents);
        $summ_ratings_places = [];
        $places = Place::with('type', 'documents', 'ratings')->get(); // Подзапрос позволяет уменьшить количество запросов к бд, мы сразу фильтруем, а не отдельно для каждого
        foreach ($places as $place){
            $summ_ratings_places[$place->id] = 0;
//            dd($summ_ratings_places);
            $place_rate = $place->ratings->map->type_rating;
            if ($place_rate->count() > 0){
                foreach ($place_rate as $rate){
                    if ($rate == 'like'){
                        $summ_ratings_places[$place->id]++;
                    }elseif ($rate == 'dislike'){
                        $summ_ratings_places[$place->id]--;
                    }
                }
            }
            foreach ($place->documents as $document){
                $doc_rate = $document->ratings->map->type_rating;
                if ($doc_rate->count() > 0){
                    foreach ($doc_rate as $doc){
                        if ($doc == 'like'){
                            $summ_ratings_places[$place->id]++;
                        }elseif ($doc == 'dislike'){
                            $summ_ratings_places[$place->id]--;
                        }
                    }
                }
            }

        }
        arsort($summ_ratings_places);

        if ($request->query('json')){
            return response()->json($places);
        }else{
            return view('all_rating', compact('places', 'summ_ratings_places'));
        }
    }


    public function new_rating(Request $request){

        /**
         * Добавления записей рейтинга через модели которым его поставили
         */

        if ($request->object_type == 'place'){
            $object = Place::find($request->object_id);
            $id = $object->id;
        }elseif ($request->object_type == 'doc'){
            $object = Document::find($request->object_id);
            $id = $object->place_id;
        }
//        dd($object->ratings()->create(['type_rating'=>$request->type_rating]));
        $object->ratings()->create($request->all());
//        dd($object->ratings()->get());
//        $object->ratings()->save(new Rating(['type_rating'=>$request->type_rating]));
//        Rating::create($request->all());

        return redirect(route('place_detail', $id));
    }

}
