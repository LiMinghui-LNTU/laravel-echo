@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
<div class="toppic">
    <div class="am-container-1">
        <div class="toppic-title left">
            <i class="am-icon-book toppic-title-i"></i>
            <span class="toppic-title-span">养护知识</span>
            <p>Maintenance Knowledge</p>
        </div>
        <div class="right toppic-progress">
            <span><a href="/home" class="w-white">首页</a></span>
            <i class=" am-icon-arrow-circle-right w-white"></i>
            <span><a href="/knowledge" class="w-white">养护知识</a></span>
        </div>
    </div>
</div>

@csrf
<div class="am-container-1">
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-1 am-avg-md-3 am-avg-lg-4 am-gallery-bordered customer-case-ul" data-am-gallery="{  }" id="article-content">
        @foreach($oArticles as $article)
            <li>
                <div class="am-gallery-item">
                    <a href="/knowledge/{{$article->id}}" class="">
                        <div class="customer-case-img">
                            <img src="{{$article->thumb}}"  />
                        </div>
                        <h3 class="am-gallery-title">
                            @if((strlen($article->title) + mb_strlen($article->title,'utf-8')) / 2 >= 22)
                                {{mb_strimwidth($article->title, 0, 22,'...', 'utf-8' )}}
                            @else
                                {{$article->title}}
                            @endif
                            <i class="am-icon-eye"></i>{{$article->view_count}}
                        </h3>
                        <div class="am-gallery-desc gallery-words">{{$article->description}}</div>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="part-title" style="cursor: pointer;" id="has-more" onclick="loadMore()">
        加载更多 <br>...
    </div>
</div>
<script>
    var page = 2;
    function loadMore() {
        $("#has-more").html("加载中...");
        $.post(
            '/knowledge',
            {
                _token : $("input[name='_token']").val(),
                page : page
            },
            function (data) {
                if(data.code == '1001'){
                    $("#article-content").append(data.msg);
                    if(data.count < 8){
                        $("#has-more").html("没有更多内容<br>￣▽￣");
                        $("#has-more").attr("style", "");
                        $("#has-more").attr("onclick", "");
                    }
                    page++;
                }else {
                    tip(data.msg);
                    return false;
                }
            },
            'json'
        );
    }
</script>
@endsection