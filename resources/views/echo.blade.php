<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$sTitle}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
  	<script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/socket.io.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles -->
</head>
<body>
<div class="flex-center position-ref full-height">
    <hr style="color: #1d68a7; height: 5px;">
    <br>
    <div id="naming">
        <input type="text" placeholder="请输入昵称" id="nickname">
        <button onclick="createName()">确认</button>
    </div>
    <div id="bord" style="display: none;">
      	<h2>使用WebSocket原理实现的简易聊天室</h2>
     	 <div style="border: 3px solid #00ff00; width: 500px; height: 600px;" id="content"></div>
        <input type="text" id="message" name="message" placeholder="请输入消息" style="width:450px;height:28px;">
        <input type="button" onclick="sendMsg()" value="发送" style="winth:100px;height:36px;background-color:#00ff00;color:#0000ff;">
    </div>
</div>
<script>
    window.name = '';

    function createName() {
        $name = $("#nickname").val();
        if ($name.toString().length == 0) {
            return false;
        }
        window.name = $name;
        $("#name").val($name);
        $("#naming").slideUp();
        $("#bord").slideDown();
    }
    
    function sendMsg() {
      	if($("#message").val().length == 0){
          return false;
        }
        $.get(
            '/chatting',
            {'name':window.name,'message':$("#message").val()},
            function (data) {
                $("#message").val("");
            }
        );
    }
</script>
<script src="/js/app.js"></script>
</body>
</html>
