@extends('layout.main')
@section('content')
        <div class="col-sm-8 blog-main">
            <div>
                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                    </ol><!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="http://ww1.sinaimg.cn/large/44287191gw1excbq6tb3rj21400migrz.jpg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                        <div class="item">
                            <img src="http://ww3.sinaimg.cn/large/44287191gw1excbq5iwm6j21400min3o.jpg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                        <div class="item">
                            <img src="http://ww2.sinaimg.cn/large/44287191gw1excbq4kx57j21400migs4.jpg" alt="..." />
                            <div class="carousel-caption">...</div>
                        </div>
                    </div>
                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="right carousel-control" href="#carousel-example" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>        <div style="height: 20px;">
            </div>
            <div>
                <div class="blog-post">
                    @foreach($posts as $post)
                                                                        {{--这里传过来的是一个对象--}}
                    <h2 class="blog-post-title"><a href='{{url("/posts/$post->id")}}' >{{$post->title}}</a></h2>
                                            {{--这里有一个时间格式转换问题  http://carbon.nesbot.com/docs/ 这里直接用carbon 一个php的api扩展的toFormattedDateString()方法--}}
                    <p class="blog-post-meta">{{$post->created_at->toDayDateTimeString()}} by
                        {{--TODO--}}
                        {{--**********因为post模型关联user  这里因为控制器用了withCount的写法，所以写成$post->user_id  。有待确认？*****--}}
                        <a href="{{url("user/$post->user_id")}}">{{$post->user->name}}</a></p>
                        {{--<a href="xxxx">xxxxx</a></p>--}}
                    {{--用str_limit() 限制字符串数量--}}
                    {!! str_limit($post->content,100,'.....') !!}
                    {{--{{str_limit($post->content,100,'.....')}}--}}
                    <p class="blog-post-meta">赞 {{$post->zans_count}}  | 评论 {{$post->comment_count}}</p>
                    @endforeach
                </div>
                {{--**这里paginate分页写法**--}}
                {{$posts->links()}}

            </div><!-- /.blog-main -->
        </div>
@stop
