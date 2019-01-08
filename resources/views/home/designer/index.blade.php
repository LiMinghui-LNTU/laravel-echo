@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-dropbox toppic-title-i"></i>
                <span class="toppic-title-span">{{$sTitle}}</span>
                <p>Designer Team</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/designer" class="w-white">{{$sTitle}}</a></span>
            </div>
        </div>
    </div>

    <div>
        <ul class=" product-show-ul">
            <li>
                <div class="product-content">
                    <div class="left am-u-sm-12 am-u-md-6 am-u-lg-6 product-content-left">
                        <div class="product-show-title">
                            <h3>响应式商城模板</h3>
                            <span>网站建设</span>
                        </div>

                        <div class="product-show-content">
                            <div class="product-add">
                                <span>查看地址：</span>
                                <div><a href="#">http://www.hwshop.com</a></div>
                                <i class="am-icon-dribbble"></i>
                            </div>
                            <div class="product-intro">
                                <span>详情介绍：</span>
                                <div><p>一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。
                                        该产品基于领先的云计算技术，用户无需在本地安装软件、无需购买专门的服务器硬件、无需专业的IT人员进行维护，
                                        只要打开浏览器，登录网站，即可使用在线物流软件。</p></div>
                                <i class="am-icon-tasks"></i>
                            </div>
                        </div>
                    </div>
                    <div class="right am-u-sm-12 am-u-md-6 am-u-lg-6 product-content-right">
                        <img class="product-img" src="{{'assets/img/product2.png'}}"/>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
            <li class="gray-li">
                <div class="product-content">
                    <div class="left am-u-sm-12 am-u-md-6 am-u-lg-6 product-content-left">
                        <img class="product-img" src="{{'assets/img/product1.png'}}"/>

                    </div>
                    <div class="right am-u-sm-12 am-u-md-6 am-u-lg-6 product-content-right">
                        <div class="product-show-title">
                            <h3>响应式商城模板</h3>
                            <span>网站建设</span>
                        </div>

                        <div class="product-show-content">
                            <div class="product-add">
                                <span>查看地址：</span>
                                <div><a href="#">http://www.hwshop.com</a></div>
                                <i class="am-icon-dribbble"></i>
                            </div>
                            <div class="product-intro">
                                <span>详情介绍：</span>
                                <div><p>一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。
                                        该产品基于领先的云计算技术，用户无需在本地安装软件、无需购买专门的服务器硬件、无需专业的IT人员进行维护，
                                        只要打开浏览器，登录网站，即可使用在线物流软件。</p></div>
                                <i class="am-icon-tasks"></i>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
            <li>
                <div class="product-content">
                    <div class="left am-u-sm-12 am-u-md-6 am-u-lg-6 product-content-left">
                        <div class="product-show-title">
                            <h3>响应式商城模板</h3>
                            <span>网站建设</span>
                        </div>

                        <div class="product-show-content">
                            <div class="product-add">
                                <span>查看地址：</span>
                                <div><a href="#">http://www.hwshop.com</a></div>
                                <i class="am-icon-dribbble"></i>
                            </div>
                            <div class="product-intro">
                                <span>详情介绍：</span>
                                <div><p>一款响应式商城模板，是专门针对中小物流企业的实际业务需求量身定做的物流管理系统，具有界面简洁、流程灵活、操作方便、易于实施的特点。
                                        该产品基于领先的云计算技术，用户无需在本地安装软件、无需购买专门的服务器硬件、无需专业的IT人员进行维护，
                                        只要打开浏览器，登录网站，即可使用在线物流软件。</p></div>
                                <i class="am-icon-tasks"></i>
                            </div>
                        </div>
                    </div>
                    <div class="right am-u-sm-12 am-u-md-6 am-u-lg-6 product-content-right">
                        <img class="product-img" src="{{'assets/img/product2.png'}}"/>
                    </div>
                    <div class="clear"></div>
                </div>
            </li>
            <div class="clear"></div>
        </ul>
    </div>
@endsection