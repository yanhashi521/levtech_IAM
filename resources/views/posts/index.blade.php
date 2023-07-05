<!DOCTYPE html>
<html lang = "{{ str_replace('_', '_', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <Link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
        <x-slot name="header">
            <p>ブログ投稿</p>
        </x-slot>
        <body>
            <h1>Blog Name</h1>
            {{ Auth::user()->name }}
            <a href="/posts/create">create</a>
            <div class = 'posts'>
                @foreach ($posts as $post)
                    <div class = 'post'>
                        <h2>
                            <a href="/posts/{{ $post->id }}"><h2 class='title'>{{ $post->title }}</h2></a>
                        </h2>
                        <p class='body'>{{ $post->body }}</p>
                        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
    
            <div class='paginate'>{{$posts -> links()}}</div>
            <script>
                function deletePost(id) {
                    console.log("form_" +　id);
                    'use strict'
                    
                    if(confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                        
                    }
                }
            </script>
        </body>
    </x-app-layout>
</html>
