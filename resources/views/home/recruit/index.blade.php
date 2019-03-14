@extends('home.layout.layout')
@section('title'){{$sTitle}}@endsection
@section('content')
    <div class="toppic">
        <div class="am-container-1">
            <div class="toppic-title left">
                <i class="am-icon-bullhorn toppic-title-i"></i>
                <span class="toppic-title-span">招贤纳士</span>
                <p>Recruit</p>
            </div>
            <div class="right toppic-progress">
                <span><a href="/home" class="w-white">首页</a></span>
                <i class=" am-icon-arrow-circle-right w-white"></i>
                <span><a href="/recruit" class="w-white">招贤纳士</a></span>
            </div>
        </div>
    </div>

    <div>
        <ul class=" product-show-ul">
            @csrf
            <?php $i = 0; ?>
            @foreach($oInfo as $info)
                <?php $i++; $bIsSubmit = \App\Model\Resume::isSubmit($info->id);?>
                @if($i % 2 == 0)
                    <li class="gray-li">
                        <div class="product-content">
                            <div class="left am-u-sm-12 am-u-md-6 am-u-lg-6 recruit-left">
                                <div class="product-show-title">
                                    <span>{{$info->position}}</span>
                                    <input type="file" id="resume{{$info->id}}" name="resume{{$info->id}}" style="display: none;" onchange="uploadFile('/upload-file','resume{{$info->id}}','ok{{$info->id}}','btn{{$info->id}}','recruit')">
                                    <span class="am-badge am-round" style="background-color: green; @if(!$bIsSubmit) display:none; @endif" id="ok{{$info->id}}">√</span>
                                    <button style="background-color: red;color: yellow; @if($bIsSubmit) display:none; @endif" class="am-btn-success am-round" onclick="uploadResume({{$info->id}})" id="btn{{$info->id}}">投递简历</button>
                                </div>

                                <div class="product-show-content">{!! $info->content !!}</div>
                            </div>
                            <div class="right am-u-sm-12 am-u-md-6 am-u-lg-6 recruit-right">
                                <img class="product-img" src="{{$info->thumb}}"/>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </li>
                @else
                    <li>
                        <div class="product-content">
                            <div class="left am-u-sm-12 am-u-md-6 am-u-lg-6 recruit-left">
                                <img class="product-img" src="{{$info->thumb}}"/>
                            </div>
                            <div class="right am-u-sm-12 am-u-md-6 am-u-lg-6 recruit-right">

                                <div class="product-show-title">
                                    <span>{{$info->position}}</span>
                                    <input type="file" id="resume{{$info->id}}" name="resume{{$info->id}}" style="display: none;" onchange="uploadFile('/upload-file','resume{{$info->id}}','ok{{$info->id}}','btn{{$info->id}}','recruit')">
                                    <span class="am-badge am-round" style="background-color: green; @if(!$bIsSubmit) display:none; @endif" id="ok{{$info->id}}">√</span>
                                    <button style="background-color: red;color: yellow; @if($bIsSubmit) display:none; @endif" class="am-btn-success am-round" onclick="uploadResume({{$info->id}})" id="btn{{$info->id}}">投递简历</button>
                                </div>

                                <div class="product-show-content">{!! $info->content !!}</div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </li>
                @endif
            @endforeach
            <div class="clear"></div>
        </ul>
    </div>
    <script>
        function uploadResume(info_id) {
            Swal.fire({
                title: '上传提醒',
                text: "每个职位每个IP仅可上传1次,要求PDF格式且不超过1MB",
                // type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#abc',
                confirmButtonText: '确认',
                cancelButtonText: '取消'
            }).then((result) => {
                if (result.value) {
                    $("#resume"+info_id).click();
                }
            });
        }
    </script>
@endsection