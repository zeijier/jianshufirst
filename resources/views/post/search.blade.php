@extends('layout.main')

    <div class="row">
        @section('content')
        <div class="alert alert-success" role="alert">
            {{--=============total() 拿出有多少条+++++++++++--}}
            下面是搜索"{{$query}}"出现的文章，共{{$posts->total()}}条
        </div>

        <div class="col-sm-8 blog-main">
            @foreach($posts as $post)
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="{{url("posts/$post->id")}}" >{{$post->title}}</a></h2>
                <p class="blog-post-meta">{{$post->created_at->toDayDateTimeString()}} by
                    <a href="{{url("user/$post->user->id")}}">{{$post->user->name}}</a></p>
                <p>{!! $post->content !!}</p>
            </div>
            @endforeach
            {{--分页逻辑--}}
                {{$posts->links()}}
        </div><!-- /.blog-main -->

        @stop
    </div>



