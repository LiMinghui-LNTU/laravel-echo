@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-user toppic-title-i"></i>
                <span class="toppic-title-span">个人中心</span>
                <p>Center</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/self" class="w-white">个人中心</a></span>
            </div>
        </div>
    </div>

    <div class="am-g">
        <div class="am-u-sm-12">
            <div class="am-panel am-panel-default">
                <div class="am-panel-bd">
                    <div class="am-g">
                        <div class="am-u-md-1">
                            <img class="am-img-circle am-img-thumbnail"
                                 src="http://s.amazeui.org/media/i/demos/bw-2014-06-19.jpg?imageView/1/w/200/h/200/q/80"
                                 alt=""/>
                        </div>
                        <div class="am-u-md-4">
                            <label class="am-u-sm-4 am-form-label">账号：</label>
                            <div class="am-u-sm-8">
                                <small>13582853262</small>
                            </div>
                            <label class="am-u-sm-4 am-form-label">昵称：</label>
                            <div class="am-u-sm-8">
                                <small>包子入侵</small>
                            </div>
                            <label class="am-u-sm-4 am-form-label">优惠券：</label>
                            <div class="am-u-sm-8">
                                <small>3张</small>
                            </div>
                            <label class="am-u-sm-4 am-form-label">头衔：</label>
                            <div class="am-u-sm-8">
                                <small>钻石VIP</small>
                            </div>
                            <button class="am-btn am-btn-primary am-btn-xs">
                                <i class="am-icon-edit"></i>
                                编辑信息
                            </button>
                        </div>
                        <div class="am-u-md-7">
                            <div class="user-info">
                                <p>金鹰发币</p>
                                <div class="am-progress am-progress-sm">
                                    <div class="am-progress-bar" style="width: 60%"></div>
                                </div>
                                <p class="user-info-order">当前发币：<strong>83枚</strong> 可抵现金：<strong>&yen;8.30元</strong>
                                </p>
                            </div>
                            <div class="user-info">
                                <p>信誉积分</p>
                                <div class="am-progress am-progress-sm">
                                    <div class="am-progress-bar am-progress-bar-success" style="width: 80%"></div>
                                </div>
                                <p class="user-info-order">信用等级：正常当前 信用积分：<strong>80</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="am-panel am-panel-default">
                <div class="am-panel-bd am-u-md-6">
                    <div data-am-widget="tabs" class="am-tabs am-tabs-d2">
                        <ul class="am-tabs-nav am-cf">
                            <li class="am-active"><a href="[data-tab-panel-0]">青春</a></li>
                            <li class=""><a href="[data-tab-panel-1]">彩虹</a></li>
                            <li class=""><a href="[data-tab-panel-2]">歌唱</a></li>
                        </ul>
                        <div class="am-tabs-bd">
                            <div data-tab-panel-0 class="am-tab-panel am-active">
                                【青春】那时候有多好，任雨打湿裙角。忍不住哼起，心爱的旋律。绿油油的树叶，自由地在说笑。燕子忙归巢，风铃在舞蹈。经过青春的草地，彩虹忽然升起。即使视线渐渐模糊，它也在我心里。就像爱过的旋律，没人能抹去。因为生命存在失望，歌唱，所以才要歌唱。
                            </div>
                            <div data-tab-panel-1 class="am-tab-panel ">
                                【彩虹】那时候有多好，任雨打湿裙角。忍不住哼起，心爱的旋律。绿油油的树叶，自由地在说笑。燕子忙归巢，风铃在舞蹈。经过青春的草地，彩虹忽然升起。即使视线渐渐模糊，它也在我心里。就像爱过的旋律，没人能抹去。因为生命存在失望，歌唱，所以才要歌唱。
                            </div>
                            <div data-tab-panel-2 class="am-tab-panel ">
                                【歌唱】那时候有多好，任雨打湿裙角。忍不住哼起，心爱的旋律。绿油油的树叶，自由地在说笑。燕子忙归巢，风铃在舞蹈。经过青春的草地，彩虹忽然升起。即使视线渐渐模糊，它也在我心里。就像爱过的旋律，没人能抹去。因为生命存在失望，歌唱，所以才要歌唱。
                            </div>
                        </div>
                    </div>

                </div>

                <div class="am-panel-bd am-u-md-6">
                    <div class="user-info">
                        <p>等级信息</p>
                        <div class="am-progress am-progress-sm">
                            <div class="am-progress-bar" style="width: 60%"></div>
                        </div>
                        <p class="user-info-order">当前等级：<strong>LV8</strong> 活跃天数：<strong>587</strong> 距离下一级别：<strong>160</strong>
                        </p>
                    </div>
                    <div class="user-info">
                        <p>信用信息</p>
                        <div class="am-progress am-progress-sm">
                            <div class="am-progress-bar am-progress-bar-success" style="width: 80%"></div>
                        </div>
                        <p class="user-info-order">信用等级：正常当前 信用积分：<strong>80</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection