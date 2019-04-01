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
                    @foreach($oVips as $vip)
                        <li>
                            <figure class="effect-lily">
                                <img style="cursor: text;"  data-am-popover="{content: '<h3>会员特权</h2>{{$vip->privilege}}<h3>奖励</h2>信誉值：{{$vip->reputation_value}}个，发币：{{$vip->coins}}枚', trigger: 'hover'}" src="@if(!is_null($oMember))@if($oMember->vip_id == 2) {{asset('assets/img/zhz_ty.jpg')}} @elseif($oMember->vip_id == 3) {{asset('assets/img/zsh_ty.jpg')}} @elseif($oMember->vip_id == 4) {{asset('assets/img/hj_ty.jpg')}} @elseif($oMember->vip_id == 5) {{asset('assets/img/by_ty.jpg')}} @elseif($oMember->vip_id == 6) {{asset('assets/img/qt_ty.jpg')}} @else {{$vip->picture}} @endif @else {{$vip->picture}} @endif" alt="" class="am-img-responsive">
                                <figcaption>
                                    <h3>
                                        {{$vip->title}}
                                        @if($vip->id == 2)
                                            原:<span style="text-decoration: line-through;font-weight: normal;color: red;">&yen;1100</span> 现:<span style="color: yellow;font-weight: normal;">&yen;{{$vip->charge}}</span>
                                        @elseif($vip->id == 3)
                                            原:<span style="text-decoration: line-through;font-weight: normal;color: red;">&yen;800</span> 现:<span style="color: yellow;font-weight: normal;">&yen;{{$vip->charge}}</span>
                                        @elseif($vip->id == 4)
                                            原:<span style="text-decoration: line-through;font-weight: normal;color: red;">&yen;600</span> 现:<span style="color: yellow;font-weight: normal;">&yen;{{$vip->charge}}</span>
                                        @elseif($vip->id == 5)
                                            原:<span style="text-decoration: line-through;font-weight: normal;color: red;">&yen;400</span> 现:<span style="color: yellow;font-weight: normal;">&yen;{{$vip->charge}}</span>
                                        @else
                                            原:<span style="text-decoration: line-through;font-weight: normal;color: red;">&yen;200</span> 现:<span style="color: yellow;font-weight: normal;">&yen;{{$vip->charge}}</span>
                                        @endif
                                    </h3>
                                    <p class="handle">立即办理</p>
                                    <a href="javascript:handleVip('{{$vip->id}}', '{{$vip->title}}', '{{$vip->charge}}', '{{$vip->discount}}', '{{$vip->handle_count}}', '{{$vip->reputation_value}}');">View more</a>
                                </figcaption>
                            </figure>
                        </li>
                    @endforeach
                </ul>
            </section>
        </article>
        <form action="/handle-member" method="post" style="display: none;" id="payForm">
            @csrf
            <input type="hidden" name="id">
            <input type="hidden" name="title">
            <input type="hidden" name="charge">
            <input type="hidden" name="discount">
            <input type="hidden" name="handle_count">
            <input type="hidden" name="reputation_value">
        </form>
    </div>
    <script>
        function toastTip(message) {
            swal({
                toast: true,
                type: 'warning',
                html: '<span style="color: #fff;font-size: 20px;">'+message+'</span>',
                width: 200,
                height: 100,
                background: '#000',
                showConfirmButton: false,
                timer: 2000
            });
            return false;
        }
        function handleVip(id, title, charge, discount, handle_count, reputation_value) {
            @if(is_null($oMember))
                toastTip("请先登录！");
            @else
                @if($oMember->vip_id != 1 && $oMember->balance > 0)
                    toastTip("您账户仍有余额");
                @else
                    $("input[name='id']").val(id);
                    $("input[name='title']").val(title);
                    $("input[name='charge']").val(charge);
                    $("input[name='discount']").val(discount);
                    $("input[name='handle_count']").val(handle_count);
                    $("input[name='reputation_value']").val(reputation_value);
                    $("#payForm").submit();
                @endif
            @endif
        }
    </script>
@endsection