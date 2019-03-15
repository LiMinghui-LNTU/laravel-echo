@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-paper-plane toppic-title-i"></i>
                <span class="toppic-title-span">关于我们</span>
                <p>About Us</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/about" class="w-white">关于我们</a></span>
            </div>
        </div>
    </div>

    <div class=" am-container-1">
        <div class="part-title part-title-mar">
            <a href="javascript:;">
                <i class=" am-icon-paper-plane part-title-i"></i>
                <span class="part-title-span">关于金鹰</span>
                <p>About Jinying</p>
            </a>
        </div>
        <div class="company-intro">
            <p>
                天公路货运管理系统是华天软件为物流货运企业全力打造的一套物流网络信息化的实在营运解决方案，通过６年的不华天公路货运管理系统是华天软件为物流货运企业全力打造的一套物流网络信息化的实在营流网络信息化的实在营运解决</p>
            <p>天公路货运管理系统是华天软件为物流货运企业天软件为物流货运企业全力打造的一套物流网络信息化的实在营流网络信息化的实在营运解决</p>
            <p>天公路货运管理系统是华天软件为物流货运企业天软件为物流货运企业流网络信息化的实在营运解决</p>
            <p>
                天公路货运管理系统是华天软件为物流货运企业全力打造的一套物流网络信息化的实在营运解决方案，通过６年的不华天公路货运管理系统是华天软件为物流货运企业全力打造的一套物流网络信息化的实在营流网络信息化的实在营运解决</p>
        </div>
    </div>

    <div class=" am-container-1">
        <div class="part-title part-title-mar">
            <a href="javascript:;">
                <i class=" am-icon-home part-title-i"></i>
                <span class="part-title-span">办公环境</span>
                <p>Office Space</p>
            </a>
        </div>
        <div class="office-space">
            <div class="cam-u-lg-6 am-u-md-6 am-u-sm-12">
                <img src="{{'assets/img/space-1.png'}}"/>
            </div>
            <div class="cam-u-lg-3 am-u-md-3 am-u-sm-6">
                <img src="{{'assets/img/space-2.png'}}"/>
            </div>
            <div class="cam-u-lg-3 am-u-md-3 am-u-sm-6">
                <img src="{{'assets/img/space-3.png'}}"/>
            </div>
            <div class="cam-u-lg-3 am-u-md-3 am-u-sm-6">
                <img src="{{'assets/img/space-4.png'}}"/>
            </div>
            <div class="cam-u-lg-3 am-u-md-3 am-u-sm-6">
                <img src="{{'assets/img/space-5.png'}}"/>
            </div>
            <div class="clear"></div>
        </div>

    </div>
    </div>
    <div class=" am-container-1">
        <div class="part-title part-title-mar">
            <a href="javascript:;">
                <i class=" am-icon-comments-o part-title-i"></i>
                <span class="part-title-span">联系我们</span>
                <p>Contact Us</p>
            </a>
        </div>
    </div>
    <div class="gray-li">
        <div class=" am-container-1">
            <div class="contact-us">
                {{--<div style="width: 100%;height: 100px;" id="map-content"></div>--}}

                <div class="am-u-lg-8 am-u-md-6 am-u-sm-12" id="map-content" style="height: 170px;">

                </div>
                <div class="am-u-lg-4 am-u-md-6 am-u-sm-12">
                    <ul class="contact-add">
                        <li>
                            <div><i class=" am-icon-map-marker"></i><span
                                        class="contact-add-1">{{$oInfo->address}}</span>
                            </div>
                        </li>
                        <li>
                            <div><i class=" am-icon-phone"></i><span>{{$oInfo->telephone}}</span></div>
                        </li>
                        <li>
                            <div><i class=" am-icon-mobile mobile"></i><span>{{$oInfo->mobile}}</span></div>
                        </li>
                        <li>
                            <div><i class=" am-icon-envelope-o"></i><span>{{$oInfo->email}}</span></div>
                        </li>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //创建和初始化地图函数：
        function initMap() {
            createMap();//创建地图
            setMapEvent();//设置地图事件
            addMapControl();//向地图添加控件
            addMarker();//向地图中添加marker
        }

        //创建地图函数：
        function createMap() {
            var map = new BMap.Map("map-content");//在百度地图容器中创建一个地图
            var point = new BMap.Point(115.675172, 37.750675);//定义一个中心点坐标
            map.centerAndZoom(point, 17);//设定地图的中心点和坐标并将地图显示在地图容器中
            window.map = map;//将map变量存储在全局
        }

        //地图事件设置函数：
        function setMapEvent() {
            map.enableDragging();//启用地图拖拽事件，默认启用(可不写)
            map.enableScrollWheelZoom();//启用地图滚轮放大缩小
            map.enableDoubleClickZoom();//启用鼠标双击放大，默认启用(可不写)
            map.enableKeyboard();//启用键盘上下左右键移动地图
        }

        //地图控件添加函数：
        function addMapControl() {
        }

        //标注点数组
        var markerArr = [{
            title: "金鹰发艺",
            content: "前进南大街104号",
            point: "115.675792|37.750704",
            isOpen: 1,
            icon: {w: 23, h: 25, l: 46, t: 21, x: 9, lb: 12}
        }
        ];

        //创建marker
        function addMarker() {
            for (var i = 0; i < markerArr.length; i++) {
                var json = markerArr[i];
                var p0 = json.point.split("|")[0];
                var p1 = json.point.split("|")[1];
                var point = new BMap.Point(p0, p1);
                var iconImg = createIcon(json.icon);
                var marker = new BMap.Marker(point, {icon: iconImg});
                var iw = createInfoWindow(i);
                var label = new BMap.Label(json.title, {"offset": new BMap.Size(json.icon.lb - json.icon.x + 10, -20)});
                marker.setLabel(label);
                map.addOverlay(marker);
                label.setStyle({
                    borderColor: "#808080",
                    color: "#333",
                    cursor: "pointer"
                });

                (function () {
                    var index = i;
                    var _iw = createInfoWindow(i);
                    var _marker = marker;
                    _marker.addEventListener("click", function () {
                        this.openInfoWindow(_iw);
                    });
                    _iw.addEventListener("open", function () {
                        _marker.getLabel().hide();
                    })
                    _iw.addEventListener("close", function () {
                        _marker.getLabel().show();
                    })
                    label.addEventListener("click", function () {
                        _marker.openInfoWindow(_iw);
                    })
                    if (!!json.isOpen) {
                        label.hide();
                        _marker.openInfoWindow(_iw);
                    }
                })()
            }
        }

        //创建InfoWindow
        function createInfoWindow(i) {
            var json = markerArr[i];
            var iw = new BMap.InfoWindow("<b class='iw_poi_title' title='" + json.title + "'>" + json.title + "</b><div class='iw_poi_content'>" + json.content + "</div>");
            return iw;
        }

        //创建一个Icon
        function createIcon(json) {
            var icon = new BMap.Icon("http://app.baidu.com/map/images/us_mk_icon.png", new BMap.Size(json.w, json.h), {
                imageOffset: new BMap.Size(-json.l, -json.t),
                infoWindowOffset: new BMap.Size(json.lb + 5, 1),
                offset: new BMap.Size(json.x, json.h)
            })
            return icon;
        }

        initMap();//创建和初始化地图
    </script>
@endsection