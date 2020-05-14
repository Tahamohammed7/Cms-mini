<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->get();
        return view('welcome',compact('posts'));
    }

    public function show($id)
    {
//        return view('show')->with('post',$post)->with('tags')->with('categories',Category::all());


        $post = Post::with('tags')->findorfail($id);
        $user    = $post->user;
        $profile = $user->profile;
        return view('show',compact('post'))->with('categories',Category::all(),'user',User::all())->with('tags',Tag::all())->with('profile',$profile)->with('user',$user);
    }

    public function articles()
    {
        $posts = Post::all();
        return view('articles',compact('posts'));
    }

}
