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

    <audio id="front-message-tip" preload="auto">
        <source src="{{asset('assets/audio/message.mp3')}}" type="audio/mpeg" />
        Your browser does not support the audio element.
    </audio>
    <button id="play-front-message-tip" style="display: none;" onclick="document.getElementById('front-message-tip').play()"></button>

    <div class="am-g">
        <div class="am-u-sm-12">
            <div class="am-panel am-panel-default">
                <div class="am-panel-bd">
                    <div class="am-g">
                        <div class="am-u-md-1">
                            <img id="show-photo" class="am-img-circle am-img-thumbnail" style="cursor:pointer;" src="{{$oInfo->photo}}"/>
                            <span id="do-upload" style="display:none;cursor: pointer;border: 1px solid #444;border-radius: 5px;"><i class="am-icon-check">上传</i></span>
                            <span id="go-back" style="display: none;cursor: pointer;border: 1px solid #444;border-radius: 5px;" onclick="$(this).hide();$('#ticket').hide();$('#info').show();"><i class="am-icon-reply">返回</i></span>
                        </div>
                        <div class="am-u-md-4" id="ticket" style="display: none;">
                            <ul data-am-widget="gallery" class="am-gallery am-avg-sm-2 am-avg-md-3 am-gallery-overlay" data-am-gallery="{ pureview: true }" >
                                @foreach($oTickets as $ticket)
                                    <li>
                                        <div class="am-gallery-item">
                                            <a class="">
                                                <img src="{{asset('assets/img/type'.$ticket->type.'_'.$ticket->quota.'.jpg')}}"/>
                                                <h3 class="am-gallery-title">
                                                    @if($ticket->type == 1)
                                                        5元新人优惠券&times;{{$ticket->num}}张
                                                    @elseif($ticket->type == 2)
                                                        10元代金券&times;{{$ticket->num}}张
                                                    @elseif($ticket->type == 3)
                                                        {{$ticket->quota}}元限时优惠券&times;{{$ticket->num}}张
                                                    @else
                                                        {{$ticket->quota}}元会员专享月券&times;{{$ticket->num}}张
                                                    @endif
                                                </h3>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="am-u-md-4" id="info">
                            <label class="am-u-sm-4 am-form-label">昵称：</label>
                            <div class="am-u-sm-8">
                                <small id="nickname">{{$oInfo->nickname}}</small>
                                <i class="am-icon-edit" style="cursor:pointer;" onclick="editNickname(this);"></i>
                            </div>
                            <label class="am-u-sm-4 am-form-label">优惠券：</label>
                            <div class="am-u-sm-8">
                                <small style="color: blue;cursor: pointer;" onclick="$(this).parent().parent().hide();$('#ticket').show();$('#go-back').show();"><span class="am-badge am-badge-primary am-round">{{\App\Model\TicketLog::calculateTicketsNum($oInfo->id)}}</span> 张</small>
                            </div>
                            <label class="am-u-sm-4 am-form-label">头衔：</label>
                            <div class="am-u-sm-8">
                                <a href="/member"><small style="color: blue;">{{$oInfo->title}}</small></a>
                            </div>
                            <label class="am-u-sm-4 am-form-label">账户余额：</label>
                            <div class="am-u-sm-8">
                                <small id="account-balance">{{$oInfo->balance}}</small> <small>元</small>
                            </div>
                            <button id="changePassword" class="am-btn am-btn-primary am-btn-xs">
                                <i class="am-icon-edit"></i>
                                修改密码
                            </button>
                        </div>
                        <div class="am-u-md-7">
                            <div class="user-info">
                                <p>金鹰发币</p>
                                <div class="am-progress am-progress-sm">
                                    <div class="am-progress-bar" style="width: {{$oInfo->coins / 10}}%"></div>
                                </div>
                                <p class="user-info-order">当前发币：<strong>{{$oInfo->coins}}枚</strong>
                                    每满1000枚可兑换<strong>&yen;10元</strong>代金券一张
                                </p>
                            </div>
                            <div class="user-info">
                                <p>信誉积分</p>
                                <div class="am-progress am-progress-sm">
                                    <div class="am-progress-bar am-progress-bar-success"
                                         style="width: {{$oInfo->reputation_value}}%"></div>
                                </div>
                                <p class="user-info-order">信用积分：<strong>{{$oInfo->reputation_value}}</strong>
                                    信用等级：<strong>@if($oInfo->reputation_value > 90)极好@elseif($oInfo->reputation_value>80)良好@elseif($oInfo->reputation_value>60)及格@elseif($oInfo->reputation_value>20)偏低@else暂无等级@endif</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="am-panel am-panel-default">
                <div class="am-panel-bd am-u-md-6">
                    <div data-am-widget="tabs" class="am-tabs am-tabs-d2">
                        <ul class="am-tabs-nav am-cf">
                            <li class="am-active"><a href="[data-tab-panel-0]">全部订单</a></li>
                            <li class=""><a href="[data-tab-panel-1]">待赴约订单</a></li>
                            <li class=""><a href="[data-tab-panel-2]">已完成订单</a></li>
                            <li class=""><a href="[data-tab-panel-3]">失约订单</a></li>
                        </ul>
                        <div class="am-tabs-bd">
                            <div data-tab-panel-0 class="am-tab-panel am-active">
                                <div class="am-scrollable-vertical">
                                    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
                                        <thead>
                                        <tr>
                                            <th>订单号</th>
                                            <th>服务类型</th>
                                            <th>造型师</th>
                                            <th>预定金额</th>
                                            <th>订单状态</th>
                                            <th>创建时间</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($oOrders as $order)
                                            <tr id="tr-order-{{$order->id}}">
                                                <td>{{$order->order_number}}</td>
                                                <td>
                                                    @if(count(json_decode($order->service_number, true)) > 1)
                                                        综合服务
                                                    @else
                                                        {{\App\Model\Service::getServiceNameByNum(json_decode($order->service_number, true)[0])[0]}}
                                                    @endif
                                                </td>
                                                <td>{{\App\Model\Designer::getDesignerNameById($order->designer_id)[0]}}</td>
                                                <td>&yen;{{$order->total_money}}</td>
                                                <td>@if($order->status == 1)已完成@elseif($order->status == 2)待赴约@else
                                                        失约@endif</td>
                                                <td>{{$order->created_at}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div data-tab-panel-1 class="am-tab-panel ">
                                <div class="am-scrollable-vertical">
                                    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
                                        <thead>
                                        <tr>
                                            <th>订单号</th>
                                            <th>服务类型</th>
                                            <th>预定金额</th>
                                            <th>赴约时间</th>
                                            <th>支付状态</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($oOrders as $order)
                                            @if($order->status == 2)
                                                <tr>
                                                    <td>{{$order->order_number}}</td>
                                                    <td>
                                                        @if(count(json_decode($order->service_number, true)) > 1)
                                                            综合服务
                                                        @else
                                                            {{\App\Model\Service::getServiceNameByNum(json_decode($order->service_number, true)[0])[0]}}
                                                        @endif
                                                    </td>
                                                    <td>&yen;{{$order->total_money}}</td>
                                                    <td>{{\App\Model\Schedule::getTimeById($order->schedule_id, 'start')[0]}}</td>
                                                    <td>
                                                        @if($order->pay == 0)
                                                            待付款
                                                        @elseif($order->pay == 1)
                                                            已支付
                                                        @else
                                                            已退款
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(strtotime(\App\Model\Schedule::getTimeById($order->schedule_id, 'start')[0]) - time() > 24 * 60 * 60)
                                                            <a onclick="doCancel(this, '{{$order->id}}', '{{$order->total_money}}');" class="tpl-table-black-operation-del">
                                                                <i class="am-icon-close am-btn-group am-btn-group-xs"></i>
                                                                <small>取消订单</small>
                                                            </a>
                                                        @else
                                                            <a class="tpl-table-black-operation-del" style="color: red;cursor: text;">
                                                                <i class="am-icon-hand-paper-o am-btn-group am-btn-group-xs"></i>
                                                                <small>不可取消</small>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div data-tab-panel-2 class="am-tab-panel ">
                                <div class="am-scrollable-vertical">
                                    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
                                        <thead>
                                        <tr>
                                            <th>订单号</th>
                                            <th>服务类型</th>
                                            <th>造型师</th>
                                            <th>订单金额</th>
                                            <th>完成时间</th>
                                            <th>满意度</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($oOrders as $order)
                                            @if($order->status == 1)
                                                <tr>
                                                    <td>{{$order->order_number}}</td>
                                                    <td>
                                                        @if(count(json_decode($order->service_number, true)) > 1)
                                                            综合服务
                                                        @else
                                                            {{\App\Model\Service::getServiceNameByNum(json_decode($order->service_number, true)[0])[0]}}
                                                        @endif
                                                    </td>
                                                    <td>{{\App\Model\Designer::getDesignerNameById($order->designer_id)[0]}}</td>
                                                    <td>&yen;{{$order->total_money}}</td>
                                                    <td>{{$order->updated_at}}</td>
                                                    <td>
                                                        @if(count(\App\Model\OrderComment::getScoreByOrderId($order->id)) == 0)
                                                            <span class="{{$order->id}}"><i class="hover-star am-icon-star-o"></i> <i class="hover-star am-icon-star-o"></i> <i class="hover-star am-icon-star-o"></i> <i class="hover-star am-icon-star-o"></i> <i class="hover-star am-icon-star-o"></i></span>
                                                        @else
                                                            @for($i = 0; $i < \App\Model\OrderComment::getScoreByOrderId($order->id)[0]; $i++)
                                                                <i class="am-icon-star"></i>
                                                            @endfor
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div data-tab-panel-3 class="am-tab-panel ">
                                <div class="am-scrollable-vertical">
                                    <table class="am-table am-table-bordered am-table-striped am-text-nowrap am-table-compact">
                                        <thead>
                                        <tr>
                                            <th>服务类型</th>
                                            <th>造型师</th>
                                            <th>预定金额</th>
                                            <th>失约时间</th>
                                            <th>信誉值</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($oOrders as $order)
                                            @if($order->status == 3)
                                                <tr class="am-active">
                                                    <td>
                                                        @if(count(json_decode($order->service_number, true)) > 1)
                                                            综合服务
                                                        @else
                                                            {{\App\Model\Service::getServiceNameByNum(json_decode($order->service_number, true)[0])[0]}}
                                                        @endif
                                                    </td>
                                                    <td>{{\App\Model\Designer::getDesignerNameById($order->designer_id)[0]}}</td>
                                                    <td>&yen;{{$order->total_money}}</td>
                                                    <td>{{\App\Model\Schedule::getTimeById($order->schedule_id, 'end')[0]}}</td>
                                                    <td>
                                                        -{{\App\Model\Service::calculateReputationValue(json_decode($order->service_number, true))}}</td>
                                                    <td>
                                                        @if($order->pay == 0)
                                                            未支付
                                                        @elseif($order->pay == 1)
                                                            <a href="javascript:;"
                                                               class="tpl-table-black-operation-del">
                                                                <i class="am-icon-money am-btn-group am-btn-group-xs"></i>
                                                                <small>申请退款</small>
                                                            </a>
                                                        @else
                                                            已退款
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @csrf
                <div class="am-panel-bd am-u-md-6">
                    <div class="am-form-group" id="area">
                        <label for="doc-ta-1">留言区域</label><br>
                        <textarea style="width: 100%;overflow: auto;word-break: break-all;resize: none;" rows="8"
                                  id="comment-area" placeholder="请描述您遇到的问题或留下您的宝贵意见..."></textarea>
                    </div>
                    <ul class="am-comments-list am-comments-list-flip am-scrollable-vertical" id="message-content" style="display: none;">
                        @forelse($oMessages as $message)
                            @if($message->from == $oInfo->id && $message->pre_type == 4)
                            <li class="am-comment am-comment-flip am-comment-danger">
                                <a href="javascript:;">
                                    <img src="{{$oInfo->photo}}" alt="" class="am-comment-avatar" width="48" height="48">
                                </a>
                                <div class="am-comment-main">
                                    <header class="am-comment-hd">
                                        <div class="am-comment-meta">
                                            <a href="javascript:;" class="am-comment-author">{{$oInfo->nickname}}</a> 回复于
                                            <time title="{{date('Y年m月d日H:i:s', strtotime($message->created_at))}}">{{$message->created_at}}</time>
                                        </div>
                                    </header>
                                    <div class="am-comment-bd">
                                        <p>{{$message->content}}</p>
                                    </div>
                                </div>
                            </li>
                            @else
                                <?php $oUser = \App\User::findUser($message->from); ?>
                                <li class="am-comment am-comment-primary">
                                    <a href="javascript:;">
                                        <img src="{{$oUser->head_url}}" alt="" class="am-comment-avatar" width="48" height="48">
                                    </a>
                                    <div class="am-comment-main">
                                        <header class="am-comment-hd">
                                            <div class="am-comment-meta">
                                                <a href="javascript:;" class="am-comment-author">{{$oUser->username}}</a> 回复于
                                                <time title="{{date('Y年m月d日H:i:s', strtotime($message->created_at))}}">{{$message->created_at}}</time>
                                            </div>
                                        </header>
                                        <div class="am-comment-bd">
                                            <p>{{$message->content}}</p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @empty
                            暂无消息
                        @endforelse
                    </ul>
                    <div class="am-btn-group">
                        <button type="button" id="msg-btn" class="am-btn-primary am-round" onclick="messages(this, '{{$oInfo->id}}')">
                            <i class="am-icon-envelope"></i>
                            <span class="am-badge am-badge-danger am-round" id="new-msg">@if($iNewMsg != 0){{$iNewMsg}}@endif</span>
                        </button>
                        <button type="button" class="am-btn-warning am-round" onclick="leaveWords('{{$oInfo->id}}')">
                            留言
                            <i class="am-icon-send"></i>
                        </button>
                        <button type="button" class="am-btn-danger am-round"
                                onclick="window.location.href='self/create';">
                            预定
                            <i class="am-icon-hand-pointer-o"></i>
                        </button>
                        <button type="button" class="am-btn-default am-round" onclick="memberLogout()">
                            登出
                            <i class="am-icon-sign-out"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $(".hover-star").mouseover(function () {
                $(this).removeClass("am-icon-star-o").addClass("am-icon-star");
                $(this).prevAll("i").removeClass("am-icon-star-o").addClass("am-icon-star");
            }).mouseout(function () {
                $(this).removeClass("am-icon-star").addClass("am-icon-star-o");
                $(this).prevAll("i").removeClass("am-icon-star").addClass("am-icon-star-o");
            });
            $(".hover-star").click(function () {
                var score = $(this).prevAll("i").length + 1; //顾客给出的星数
                var order = $(this).parent("span").attr("class"); //订单id
                var html = '';
                for (var i = 0; i < score; i++){
                    html += "<i class='am-icon-star'></i> ";
                }
                $(this).parent('span').parent('td').html(html);
                wait("正在提交...");
                $.post(
                    '/make-comments',
                    {
                        _token: $("input[name='_token']").val(),
                        order: order,
                        score: score
                    },
                    function (data) {
                        if(data.code == '1001'){
                            tip(data.msg);
                            return false;
                        }else {
                            tip(data.msg);
                            return false;
                        }
                    },
                    'json'
                );
            });
        });
        //实例化一个plupload上传对象
        var uploader = new plupload.Uploader({
            browse_button : 'show-photo', //触发文件选择对话框的按钮，为那个元素id
            url : '/upload-file', //服务器端的上传页面地址
            filters : {
                mime_types : [ //只允许上传图片和zip文件
                    { title : "Image files", extensions : "jpg,gif,png" }
                ],
                    max_file_size : '400kb', //最大只能上传400kb的文件
                    prevent_duplicates : true //不允许选取重复文件
            },
            multipart_params: {
                _token:$("input[name='_token']").val(),
                module:'self'
            },
            multi_selection : false,//设置是否可多选
            file_data_name: 'photo',//	指定文件上传时文件域的名称

        flash_swf_url : "{{asset('assets/js/plupload/Moxie.swf')}}", //swf文件，当需要使用swf方式进行上传时需要配置该参数
            silverlight_xap_url : "{{asset('assets/js/plupload/Moxie.xap')}}" //silverlight文件，当需要使用silverlight方式进行上传时需要配置该参数
        });

        //在实例对象上调用init()方法进行初始化
        uploader.init();

        //绑定各种事件，并在事件监听函数中做你想做的事
        uploader.bind('FilesAdded',function(uploader,files){
            for(var i = 0, len = files.length; i<len; i++){
                // var file_name = files[i].name; //文件名
                // //构造html来更新UI
                // var html = '<li id="file-' + files[i].id +'"><p class="file-name">' + file_name + '</p><p class="progress"></p></li>';
                // $(html).appendTo('#file-list');
                //预览图片
                !function(i){
                    previewImage(files[i],function(imgsrc){
                        $('#show-photo').attr('src', imgsrc);
                    })
                }(i);
            }
            $("#do-upload").show();
        });
        $("#do-upload").click(function () {
            uploader.start();
            $("#do-upload").hide();
        });
        uploader.bind('UploadProgress',function(uploader,file){
            //每个事件监听函数都会传入一些很有用的参数，
            //我们可以利用这些参数提供的信息来做比如更新UI，提示上传进度等操作
            wait("正在上传...");
        });
        uploader.bind('FileUploaded',function (uploader,file,responseObject) {
            if(responseObject.status == 200){
                tip("上传成功");
            }
        });
        uploader.bind('Error',function (uploader, errObject) {
            tip("上传出错了");
            return false;
        });

        //预览图片
        function previewImage(file,callback){//file为plupload事件监听函数参数中的file对象,callback为预览图片准备完成的回调函数
            if(!file || !/image\//.test(file.type)) return; //确保文件是图片
            if(file.type=='image/gif'){//gif使用FileReader进行预览,因为mOxie.Image只支持jpg和png
                var fr = new mOxie.FileReader();
                fr.onload = function(){
                    callback(fr.result);
                    fr.destroy();
                    fr = null;
                }
                fr.readAsDataURL(file.getSource());
            }else{
                var preloader = new mOxie.Image();
                preloader.onload = function() {
                    preloader.downsize( 200, 200 );//先压缩一下要预览的图片,宽300，高300
                    var imgsrc = preloader.type=='image/jpeg' ? preloader.getAsDataURL('image/jpeg',80) : preloader.getAsDataURL(); //得到图片src,实质为一个base64编码的数据
                    callback && callback(imgsrc); //callback传入的参数为预览图片的url
                    preloader.destroy();
                    preloader = null;
                };
                preloader.load( file.getSource() );
            }
        }

        //修改密码
        $("#changePassword").click(function () {
            Swal.mixin({
                allowOutsideClick :false,
                input: 'password',
                confirmButtonText: '下一步',
                showCancelButton: true,
                progressSteps: ['1', '2', '3']
            }).queue([
                {
                    title: '原密码',
                    text: '请输入原密码'
                },
                '新密码',
                '确认密码'
            ]).then((result) => {
                if(result.value == null){return false;}
                if(result.value[0].trim() == '' || result.value[1].trim() == ''){
                    tip("密码不能为空");
                    return false;
                }else if(result.value[1].trim() != result.value[2].trim()){
                    tip("两次密码不一致");
                    return false;
                }else {
                    $.post(
                        '/home',
                        {
                            _token: $("input[name='_token']").val(),
                            newPassword: result.value[1],
                            value: result.value
                        },
                        function (data) {
                            if(data.code == '1001'){
                                Swal.fire({
                                    title: '修改成功',
                                    html: '您的密码已修改，请重新登录平台',
                                    confirmButtonText: '好的',
                                    allowOutsideClick :false
                                }).then((result)=>{
                                    if(result.value){
                                        memberLogout();
                                    }
                                });
                            }else {
                                tip(data.msg);
                                return false;
                            }
                        },
                        'json'
                    );
                }
            });
        });

        //修改昵称
        function editNickname(obj) {
            if($(obj).hasClass("am-icon-edit")){
                var nickname = $("#nickname").html();
                $("#nickname").html("<input id='newNickname' type='text' placeholder='" + nickname + "'>");
                $("#newNickname").focus();
                $(obj).removeClass("am-icon-edit").addClass("am-icon-check");
            }else {
                //ajax请求更改昵称
                var newNickname = $("#newNickname").val().trim();
                if(newNickname.length == 0){
                    tip("昵称不能为空");
                    $("#newNickname").focus();
                    return false;
                }
                if(newNickname.length > 6){
                    tip("请限制于6字之内");
                    $("#newNickname").focus();
                    return false;
                }
                $.post(
                    '/home',
                    {
                        _token: $("input[name='_token']").val(),
                        newNickname: newNickname
                    },
                    function (data) {
                        if(data.code == '1001'){
                            $("#nickname").html(newNickname);
                            $(obj).removeClass("am-icon-check").addClass("am-icon-edit");
                            tip("修改成功");
                            return false;
                        }
                    },
                    'json'
                );
            }
        }

        function doCancel(obj, id, balance) {
            Swal.fire({
                title: '确定取消该订单?',
                text: "若已支付，订单金额将会返回到您的账户",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确定'
            }).then((result) => {
                if(result.value){
                    wait("正在处理......");
                    $.post(
                        'order-cancel',
                        {
                            _token: $("input[name='_token']").val(),
                            orderId: id
                        },
                        function (data) {
                            if(data.code == '1001'){
                                tip(data.msg);
                                $("#account-balance").html(parseInt($("#account-balance").html()) + parseInt(balance));
                                $(obj).parent().parent().remove();
                                $("#tr-order-"+id).remove();
                                return false;
                            }else {
                                tip(data.msg);
                                return false;
                            }
                        },
                        'json'
                    );
                }
            });
        }
    </script>
@endsection