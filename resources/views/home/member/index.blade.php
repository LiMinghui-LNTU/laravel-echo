@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-lightbulb-o toppic-title-i"></i>
                <span class="toppic-title-span">会员办理</span>
                <p>Member Handling</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/member" class="w-white">会员办理</a></span>
            </div>
        </div>
    </div>

    <nav class="m-cat-nav">

    </nav>

    <div class="am-container m-list">
        <article>
            <section class="m-case-list">
                <ul class="am-avg-sm-1 am-avg-md-2 am-avg-lg-3 am-thumbnails">
                    <li>
                        <figure class="effect-lily">
                            <img src="{{asset('assets/img/zhz.jpg')}}" alt="广州立冠创新科技有限公司" class="am-img-responsive">
                            <figcaption>
                                <h3>广州立冠创新科技有限</h3>
                                <p>一家专业从事机箱电源的企业</p>
                                <p class="handle">立即办理</p>
                                <a href="javascript:;">View more</a>
                            </figcaption>
                        </figure>
                    </li>
                    <li>
                        <figure class="effect-lily">
                            <img src="{{asset('assets/img/zsh.jpg')}}" alt="南京启凡英语课程专题" class="am-img-responsive">
                            <figcaption>
                                <h3>南京启凡英语课程专题</h3>
                                <p>南京唯一一家欧洲教育管理培训中心</p>
                                <p class="handle">立即办理</p>
                                <a href="javascript:;">View more</a>
                            </figcaption>
                        </figure>
                    </li>
                    <li>
                        <figure class="effect-lily">
                            <img src="{{asset('assets/img/hj.jpg')}}" alt="广州唯一印象婚纱摄影" class="am-img-responsive">
                            <figcaption>
                                <h3>广州唯一印象婚纱摄影</h3>
                                <p>专注高端定制婚纱摄影</p>
                                <p class="handle">立即办理</p>
                                <a href="javascript:;">View more</a>
                            </figcaption>
                        </figure>
                    </li>


                </ul>
            </section>
        </article>
    </div>
@endsection