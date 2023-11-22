<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Debugbar;
use Illuminate\Support\Facades\App;

class PostsController extends Controller
{

    public function create(){
        $data = [
            'title' => 'post1',
            'intro' => 'one_post',
        ];
        Post::create($data);

    }

    public function delete(){
        Post::orderBy('created_at', 'desc')->first()->delete();
    }

}
