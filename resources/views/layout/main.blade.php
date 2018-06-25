<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    {{--这里为ajax 的post提交设置token****************************--}}
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>laravel for blog</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="{{asset('css/blog.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/wangEditor.min.css')}}">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>

<body>

@include('layout.nav')
<div class="container">

    <div class="blog-header">
    </div>

    <div class="row">
        {{--不共用的挖一个空--}}
        @yield('content')
        {{--把能拆开的拆开，再用include引进来--}}
        @include('layout.sidebar')
    </div>
</div><!-- /.row -->
<!-- /.container -->

@include('layout.footer')
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('js/wangEditor.min.js')}}"></script>
<script src="{{asset('js/ylaravel.js')}}"></script>

</body>
</html>