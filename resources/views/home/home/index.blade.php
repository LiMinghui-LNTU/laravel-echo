@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="rollpic">
        <div data-am-widget="slider" class="am-slider am-slider-default" data-am-slider='{}'>
            <ul class="am-slides">
                @foreach($oSowmaps as $sowmap)
                    <li><a href="{{$sowmap->redirect}}"><img src="{{$sowmap->thumb}}"/></a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="am-container-1">
        <div class="solutions part-all">
            <div class="part-title">
                <a href="solutions.html">
                    <i class="am-icon-lightbulb-o part-title-i"></i>
                    <span class="part-title-span">发型展示</span>
                    <p>Haircut Show</p>
                </a>
            </div>
            <ul class="am-g part-content solutions-content">
                <li class="am-u-sm-6 am-u-md-3 am-u-lg-3">
                    <img class="solution-circle" src="{{'assets/img/zxlx.jpg'}}" style="width: 70%; height: auto;" />
                    <span class="solutions-title">最新流行</span>
                    <p class="solutions-way">推荐现阶段时尚、潮流的造型，提供独特、新颖的设计方案</p>
                </li>
                <li class="am-u-sm-6 am-u-md-3 am-u-lg-3">
                    <img class="solution-circle" src="{{'assets/img/nsfs.jpg'}}" style="width: 70%; height: auto;" />
                    <span class="solutions-title">男士风尚</span>
                    <p class="solutions-way">专门为男性顾客提供适合其脸型、身材的造型设计，有专业的设计师指导</p>
                </li>
                <li class="am-u-sm-6 am-u-md-3 am-u-lg-3">
                    <img class="solution-circle" src="{{'assets/img/nxcl.png'}}" style="width: 70%; height: auto;" />
                    <span class="solutions-title">女性潮流</span>
                    <p class="solutions-way">提供丰富的女性美发案例，上百套造型、染烫方案可供选择</p>
                </li>
                <li class="am-u-sm-6 am-u-md-3 am-u-lg-3">
                    <img class="solution-circle" src="{{'assets/img/yxzp.jpg'}}" style="width: 70%; height: auto;" />
                    <span class="solutions-title">优秀作品</span>
                    <p class="solutions-way">有成体系的优秀作品可供学员参考，提供良好的学习交流机会</p>
                </li>

            </ul>

        </div>
    </div>
    <div class="gray-li">
        <div class="customer-case part-all ">
            <div class="part-title">
                <a href="/knowledge">
                    <i class=" am-icon-book part-title-i"></i>
                    <span class="part-title-span">养护知识</span>
                    <p>Maintenance Knowledge</p>
                </a>
            </div>


            <ul data-am-widget="gallery" class=" am-avg-sm-1 am-avg-md-4 am-avg-lg-4 am-gallery-bordered customer-case-content">
                @foreach($oArticles as $article)
                    <li class="case-li am-u-sm-6 am-u-md-6 am-u-lg-3">
                        <div class="am-gallery-item case-img1">
                            <a href="/knowledge/{{$article->id}}">
                                <img src="{{$article->thumb}}"/>
                            </a>
                        </div>
                        <div class="case-li-mengban">
                            <div class=" case-word">
                                <h3 class="am-gallery-title">{{$article->title}}</h3>
                                <p>{{date('Y-m-d', strtotime($article->created_at))}}</p>
                                <p>浏览量：{{$article->view_count}}</p>
                                <a href="/knowledge/{{$article->id}}"><span><i class="am-icon-eye"></i>查看详情</span></a>
                            </div>
                        </div>
                    </li>
                @endforeach

            </ul>
            <div class="lan-bott">
                <div class="left"><span>全方位解决方案,为您轻松解决不同问题</span>
                    <p>A full range of solutions for you to solve different problems</p>
                </div>
                <div class="right">
                    <a href="/knowledge">
                        <span class="see-more">查看更多<i class="am-icon-angle-double-right"></i></span>
                    </a>
                </div>
                <div class="clear"></div>
            </div>
            <div class="part-title">

            </div>
        </div>
    </div>

    <div class=" news-all">
        <div class="am-container-1">
            <div class="news part-all">
                <div class="part-title">
                    <a href="news.html">
                        <i class="am-icon-money part-title-i"></i>
                        <span class="part-title-span">优惠活动</span>
                        <p>Preferential Activities</p>
                    </a>
                </div>
                <div class="news-content ">
                    <ul class="news-content-ul">
                        <li class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <a href="#">
                                <div class=" am-u-sm-12 am-u-md-12 am-u-lg-5">
                                    <div class="news-img">
                                        <img src="{{'assets/img/news.png'}}" />
                                    </div>
                                </div>
                                <div class=" am-u-sm-12 am-u-md-12 am-u-lg-7">
                                    <span class="news-right-title">关于召开年会的通知</span>
                                    <p class="news-right-time">2015-06-11</p>
                                    <p class="news-right-words">互联网，又称网际网路或音译因特网、英特网，是网络与网络之间所串连成的庞大网络网络与网络之...</p>
                                    <a><span class="see-more2">查看更多<i class="am-icon-angle-double-right"></i></span></a>
                                </div>
                                <div class="clear"></div>
                            </a>
                        </li>
                        <li class="am-u-sm-12 am-u-md-6 am-u-lg-6">
                            <a href="#">
                                <div class=" am-u-sm-12 am-u-md-12 am-u-lg-5">
                                    <div class="news-img">
                                        <img src="{{'assets/img/news1.png'}}" />
                                    </div>
                                </div>
                                <div class=" am-u-sm-12 am-u-md-12 am-u-lg-7">
                                    <span class="news-right-title">关于召开年会的通知</span>
                                    <p class="news-right-time">2015-06-11</p>
                                    <p class="news-right-words">互联网，又称网际网路或音译因特网、英特网，是网络与网络之间所串连成的庞大网络网络与网络之...</p>
                                    <a><span class="see-more2">查看更多<i class="am-icon-angle-double-right"></i></span></a>
                                </div>
                                <div class="clear"></div>
                            </a>
                        </li>
                        <div class="clear"></div>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
@endsection