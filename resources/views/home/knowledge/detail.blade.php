@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-book toppic-title-i"></i>
                <span class="toppic-title-span">文章详情</span>
                <p>Article Detail</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/knowledge" class="w-white">养护知识</a></span>
            </div>
        </div>
    </div>

    <div class="am-container-1 margin-t30">
        <div class="words-title ">
            <span>{{$oArticle->title}}</span>
            <div style="color: #0b6fa2;">
                {{date('Y-m-d', strtotime($oArticle->created_at))}}
                阅读量：{{$oArticle->view_count}}
            </div>
        </div>
    </div>

    <div class="solution-inform">
        <div class=" solution-inform-content-all">
            <div class="solution-inform-content">
                {!! $oArticle->content !!}
            </div>
        </div>
    </div>

    <script>
        $(function () {
            if("{{$iSent}}" == '1'){
                swal({
                    position : 'bottom',
                    html: '<span style="color: #fff;font-size: 20px;">发币奖励：<i class="am-icon-btc am-icon-fw"></i>*' + '{{$oArticle->coins}}' + '</span>',
                    width: 200,
                    height: 100,
                    background: '#000',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    </script>
@endsection