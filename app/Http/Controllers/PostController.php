<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用．
    {
	    return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
         //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }
    
    public function show(Post $post) 
    {
        // dd($post);
        return view('posts/show')->with(['post' => $post]);
        //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    
    public function create()
    {
        return view('posts/create');
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();//インスタンス化しているpostにinputの中身を代入している．
        return redirect('/posts/' . $post->id);
    }
}
