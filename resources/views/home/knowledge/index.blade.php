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

<div class="am-container-1">
    <ul data-am-widget="gallery" class="am-gallery am-avg-sm-1
  am-avg-md-3 am-avg-lg-4 am-gallery-bordered customer-case-ul" data-am-gallery="{  }" >
        <li>
            <div class="am-gallery-item">
                <a href="case-inform.html" class="">
                    <div class="customer-case-img">
                        <img src="{{asset('assets/img/app1-1.png')}}" />
                    </div>
                    <h3 class="am-gallery-title">响应式商城</h3>
                    <div class="am-gallery-desc gallery-words">一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。 该产品基于领先的云计算技术，用户无需在本地安装软件、无需购买专门的服务器硬件、无需专业的IT人员进行维护， 只要打开浏览器，登录网站，即可使用在线物流软件。</div>
                </a>
            </div>
        </li>
        <li>
            <div class="am-gallery-item">
                <a href="#" class="">
                    <div class="customer-case-img">
                        <img src="{{asset('assets/img/app2-2.png')}}"  />
                    </div>
                    <h3 class="am-gallery-title">物流红娘</h3>
                    <div class="am-gallery-desc gallery-words">一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。 该产品基于领先的云计算技术，用户无需在本地安装软件、无需专业的IT人员进行维护即可使用在线物流软件。</div>
                </a>
            </div>
        </li>
        <li>
            <div class="am-gallery-item">
                <a href="#" class="">
                    <div class="customer-case-img">
                        <img src="{{asset('assets/img/app3-3.png')}}" />
                    </div>
                    <h3 class="am-gallery-title">车型湖北</h3>
                    <div class="am-gallery-desc gallery-words">一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。 该产品基于领先的云计算技术，用户无需在本地安装软件、无需购买专门的服务器硬件、无需专业的IT人员进行维护， 只要打开浏览器，登录网站，即可使用在线物流软件。</div>
                </a>
            </div>
        </li>
        <li>
            <div class="am-gallery-item">
                <a href="#" class="">
                    <div class="customer-case-img">
                        <img src="{{asset('assets/img/app4-4.png')}}"/>
                    </div>
                    <h3 class="am-gallery-title">管理系统</h3>
                    <div class="am-gallery-desc gallery-words">一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。 该产品基于领先的云计算技术，用户无需在本地安装软件、无需购买专门的服务器硬件、无需专业的IT人员进行维护， 只要打开浏览器，登录网站，即可使用在线物流软件。
                    </div>
                </a>
            </div>
        </li>
        <li>
            <div class="am-gallery-item">
                <a href="#" class="">
                    <div class="customer-case-img">
                        <img src="{{asset('assets/img/app5-5.png')}}" />

                    </div>
                    <h3 class="am-gallery-title">响应式商城</h3>
                    <div class="am-gallery-desc gallery-words">一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。 该产品基于领先的云计算技术，用户无需在本地安装软件、无需购买专门的服务器硬件、无需专业的IT人员进行维护， 只要打开浏览器，登录网站，即可使用在线物流软件。</div>
                </a>
            </div>
        </li>
        <li>
            <div class="am-gallery-item">
                <a href="#" class="">
                    <div class="customer-case-img">
                        <img src="{{asset('assets/img/app6-6.png')}}"  />
                    </div>
                    <h3 class="am-gallery-title">物流红娘</h3>
                    <div class="am-gallery-desc gallery-words">一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。 该产品基于领先的云计算技术，用户无需在本地安装软件、无需专业的IT人员进行维护即可使用在线物流软件。</div>
                </a>
            </div>
        </li>
        <li>
            <div class="am-gallery-item">
                <a href="#" class="">
                    <div class="customer-case-img">
                        <img src="{{asset('assets/img/app7-7.png')}}" />
                    </div>
                    <h3 class="am-gallery-title">车型湖北</h3>
                    <div class="am-gallery-desc gallery-words">一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。 该产品基于领先的云计算技术，用户无需在本地安装软件、无需购买专门的服务器硬件、无需专业的IT人员进行维护， 只要打开浏览器，登录网站，即可使用在线物流软件。</div>
                </a>
            </div>
        </li>
        <li>
            <div class="am-gallery-item">
                <a href="#" class="">
                    <div class="customer-case-img">
                        <img src="{{asset('assets/img/app8-8.png')}}"/>
                    </div>
                    <h3 class="am-gallery-title">管理系统</h3>
                    <div class="am-gallery-desc gallery-words">一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。 该产品基于领先的云计算技术，用户无需在本地安装软件、无需购买专门的服务器硬件、无需专业的IT人员进行维护， 只要打开浏览器，登录网站，即可使用在线物流软件。
                    </div>
                </a>
            </div>
        </li>
    </ul>

</div>
<div class="part-all gray-li">
    <div class="customer  am-container-1">
        <div class="part-title">
            <i class="am-icon-users part-title-i"></i>
            <span class="part-title-span">服务客户</span>
            <p>Serve Customers</p>
        </div>

        <div class="am-slider am-slider-default am-slider-carousel part-all" data-am-flexslider="{itemWidth:150, itemMargin: 5, slideshow: false}" style="  background-color: #f0eeed; box-shadow:none;">
            <ul class="am-slides">
                <li><img src="{{asset('assets/img/ptn4.png')}}"/></li>
                <li><img src="{{asset('assets/img/ptn5.png')}}"/></li>
                <li><img src="{{asset('assets/img/ptn6.png')}}"/></li>
                <li><img src="{{asset('assets/img/ptn7.png')}}"/></li>
                <li><img src="{{asset('assets/img/ptn8.png')}}"/></li>
                <li><img src="{{asset('assets/img/ptn4.png')}}"/></li>
                <li><img src="{{asset('assets/img/ptn5.png')}}"/></li>
                <li><img src="{{asset('assets/img/ptn6.png')}}"/></li>
                <li><img src="{{asset('assets/img/ptn7.png')}}"/></li>
                <li><img src="{{asset('assets/img/ptn8.png')}}"/></li>
            </ul>
        </div>
    </div>
</div>
    @endsection