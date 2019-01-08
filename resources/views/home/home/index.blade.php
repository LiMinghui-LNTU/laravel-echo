@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="rollpic">
        <div data-am-widget="slider" class="am-slider am-slider-default" data-am-slider='{}'>
            <ul class="am-slides">
                <li><a href="www.baidu.com"><img src="{{'assets/img/hw_bg1.png'}}"/></a></li>
                <li><img src="{{'assets/img/hw_bg.png'}}"/></li>
                <li><img src="{{'assets/img/hw_bg3.png'}}"/></li>
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
                    <i class="am-icon-safari solution-circle"></i>
                    <span class="solutions-title">网站、移动网站</span>
                    <p class="solutions-way">微信公众号开发移动网站微信公众号开发</p>
                </li>
                <li class="am-u-sm-6 am-u-md-3 am-u-lg-3">
                    <i class="am-icon-magic solution-circle"></i>
                    <span class="solutions-title">网站、移动网站</span>
                    <p class="solutions-way">移动网站微信公众号开发移动网站微信公众号开发,解决方案</p>
                </li>
                <li class="am-u-sm-6 am-u-md-3 am-u-lg-3">
                    <i class="am-icon-phone solution-circle"></i>
                    <span class="solutions-title">网站、移动网站</span>
                    <p class="solutions-way">移动网站微信公众号开发移动网站微信公众号开发</p>
                </li>
                <li class="am-u-sm-6 am-u-md-3 am-u-lg-3">
                    <i class="am-icon-hacker-news solution-circle"></i>
                    <span class="solutions-title">网站、移动网站</span>
                    <p class="solutions-way">网站、移动网站微信公众号开发移动网站微信公众号开发,解决方案</p>
                </li>

            </ul>

        </div>
    </div>
    <div class="gray-li">
        <div class="customer-case part-all ">
            <div class="part-title">
                <a href="customer-case.html">
                    <i class=" am-icon-book part-title-i"></i>
                    <span class="part-title-span">养护知识</span>
                    <p>Maintenance Knowledge</p>
                </a>
            </div>


            <ul data-am-widget="gallery" class=" am-avg-sm-1
  am-avg-md-4 am-avg-lg-4 am-gallery-bordered customer-case-content">
                <li class="case-li am-u-sm-6 am-u-md-6 am-u-lg-3">
                    <div class="am-gallery-item case-img1">
                        <a href="#">
                            <img src="{{'assets/img/app1.png'}}"/>

                        </a>
                    </div>
                    <div class="case-li-mengban">
                        <div class=" case-word">
                            <h3 class="am-gallery-title">响应式商城</h3>
                            <p>2015-06-11</p>
                            <a><span><i class="am-icon-eye"></i>查看更多</span></a>
                        </div>
                    </div>
                </li>
                <li class="case-li am-u-sm-6 am-u-md-6 am-u-lg-3">
                    <div class="am-gallery-item case-img1">
                        <a href="#">
                            <img src="{{'assets/img/app2.png'}}"/>
                        </a>
                    </div>
                    <div class="case-li-mengban">
                        <div class=" case-word">
                            <h3 class="am-gallery-title">物流红娘</h3>
                            <p>2015-06-11</p>
                            <a><span><i class="am-icon-eye"></i>查看更多</span></a>
                        </div>
                    </div>
                </li>
                <li class="case-li am-u-sm-6 am-u-md-6 am-u-lg-3">
                    <div class="am-gallery-item case-img1">
                        <a href="#">
                            <img src="{{'assets/img/app3.png'}}"/>
                        </a>
                    </div>
                    <div class="case-li-mengban">
                        <div class=" case-word">
                            <h3 class="am-gallery-title">车型湖北</h3>
                            <p>2015-06-11</p>
                            <a><span><i class="am-icon-eye"></i>查看更多</span></a>
                        </div>
                    </div>
                </li>
                <li class="case-li am-u-sm-6 am-u-md-6 am-u-lg-3">
                    <div class="am-gallery-item case-img1">
                        <a href="#">
                            <img src="{{'assets/img/app4.png'}}"/>
                        </a>
                    </div>
                    <div class="case-li-mengban">
                        <div class=" case-word">
                            <h3 class="am-gallery-title">管理系统</h3>
                            <p>2015-06-11</p>
                            <a><span><i class="am-icon-eye"></i>查看更多</span></a>
                        </div>
                    </div>
                </li>
                <li class="case-li am-u-sm-6 am-u-md-6 am-u-lg-3">
                    <div class="am-gallery-item case-img1">
                        <a href="#">
                            <img src="{{'assets/img/app5.png'}}"/>
                        </a>
                    </div>
                    <div class="case-li-mengban">
                        <div class=" case-word">
                            <h3 class="am-gallery-title">智众商城</h3>
                            <p>2015-06-11</p>
                            <a><span><i class="am-icon-eye"></i>查看更多</span></a>
                        </div>
                    </div>
                </li>
                <li class="case-li am-u-sm-6 am-u-md-6 am-u-lg-3">
                    <div class="am-gallery-item case-img1">
                        <a href="#">
                            <img src="{{'assets/img/app6.png'}}"/>
                        </a>
                    </div>
                    <div class="case-li-mengban">
                        <div class=" case-word">
                            <h3 class="am-gallery-title">汇众商城</h3>
                            <p>2015-06-11</p>
                            <a><span><i class="am-icon-eye"></i>查看更多</span></a>
                        </div>
                    </div>
                </li>
                <li class="case-li am-u-sm-6 am-u-md-6 am-u-lg-3">
                    <div class="am-gallery-item case-img1">
                        <a href="#">
                            <img src="{{'assets/img/app7.png'}}"/>
                        </a>
                    </div>
                    <div class="case-li-mengban">
                        <div class=" case-word">
                            <h3 class="am-gallery-title">无鞋网</h3>
                            <p>2015-06-11</p>
                            <a><span><i class="am-icon-eye"></i>查看更多</span></a>
                        </div>
                    </div>
                </li>
                <li class="case-li am-u-sm-6 am-u-md-6 am-u-lg-3">
                    <div class="am-gallery-item case-img1">
                        <a href="#">
                            <img src="{{'assets/img/app8.png'}}"/>
                        </a>
                    </div>
                    <div class="case-li-mengban">
                        <div class=" case-word">
                            <h3 class="am-gallery-title">响应式商城</h3>
                            <p>2015-06-11</p>
                            <a><span><i class="am-icon-eye"></i>查看更多</span></a>
                        </div>
                    </div>
                </li>

            </ul>
            <div class="lan-bott">
                <div class="left"><span>全方位解决方案,为您轻松解决不同问题</span>
                    <p>A full range of solutions for you to solve different problems</p>
                </div>
                <div class="right">
                    <a href="customer-case.html">
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
    <!--<div class="three-reason">
                <div class="part-title three-reason-title">
                <span class="part-title-span w-white">选择恒望的三大理由</span>
                <p class="w-white">Why Choose Hengwang</p>

            </div>
                <ul class="am-g part-content three-reason-content">
                  <li class="am-u-sm-4 am-u-md-4 am-u-lg-4">
                      <div class="three-reason-img1 "></div>
                      <p class="reason-title w-white">规模优势<br/>Scale advantage</p>
                  </li>
                  <li class="am-u-sm-4 am-u-md-4 am-u-lg-4">
                      <div class="three-reason-img2 "></div>
                      <p class="reason-title w-white ">领先技术<br/>Leading technology</p>
                  </li>
                  <li class="am-u-sm-4 am-u-md-4 am-u-lg-4">
                      <div class="three-reason-img3 "></div>
                      <p class="reason-title w-white">整合能力<br/>Integration capability</p>
                  </li>
            </ul>
            </div>-->
    <div class="part-all gray-li">
        <div class="customer  am-container-1">
            <div class="part-title">
                <i class="am-icon-users part-title-i"></i>
                <span class="part-title-span">服务客户</span>
                <p>Serve Customers</p>
            </div>

            <div class="am-slider am-slider-default am-slider-carousel part-all"
                 data-am-flexslider="{itemWidth:150, itemMargin: 5, slideshow: false}"
                 style="  background-color: #f0eeed; box-shadow:none;">
                <ul class="am-slides">
                    <li><img src="{{'assets/img/ptn4.png'}}"/></li>
                    <li><img src="{{'assets/img/ptn5.png'}}"/></li>
                    <li><img src="{{'assets/img/ptn6.png'}}"/></li>
                    <li><img src="{{'assets/img/ptn7.png'}}"/></li>
                    <li><img src="{{'assets/img/ptn8.png'}}"/></li>
                    <li><img src="{{'assets/img/ptn4.png'}}"/></li>
                    <li><img src="{{'assets/img/ptn5.png'}}"/></li>
                    <li><img src="{{'assets/img/ptn6.png'}}"/></li>
                    <li><img src="{{'assets/img/ptn7.png'}}"/></li>
                    <li><img src="{{'assets/img/ptn8.png'}}"/></li>
                </ul>
            </div>
            <!--<ul class="customer-content">
                <li class="am-u-sm-6 am-u-md-4 am-u-lg-2"><div><img src="img/ptn4.png"/></div></li>
                <li class="am-u-sm-6 am-u-md-4 am-u-lg-2"><div><img src="img/ptn5.png"/></div></li>
                <li class="am-u-sm-6 am-u-md-4 am-u-lg-2"><div><img src="img/ptn6.png"/></div></li>
                <li class="am-u-sm-6 am-u-md-4 am-u-lg-2"><div><img src="img/ptn7.png"/></div></li>
                <li class="am-u-sm-6 am-u-md-4 am-u-lg-2"><div><img src="img/ptn8.png"/></div></li>
                <li class="am-u-sm-6 am-u-md-4 am-u-lg-2"><div><img src="img/ptn4.png"/></div></li>
                <div class="clear"></div>
            </ul>-->
        </div>
    </div>
@endsection