<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/socket.io.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$sTitle}}</title>
</head>
<body>
<form action="/test/push" method="get">
    <input type="text" id="message" name="message" value="{{old('message')}}"><br>
    <input type="submit">
</form>
<br>
--------------------------------------------------------------<br>
<form action="/test/privatePush" method="get">
    <select name="user" id="user" onchange="loadJs('/js/app.js?v=4')">
        <option value="">请选择</option>
        @foreach($oUser as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
    <input type="text" name="private-message" id="private-message" value="{{old('message')}}">
    <input type="submit">
</form>
</body>
<script>
    window.id = "{{\Illuminate\Support\Facades\Auth::user()->id}}"; //初始化广播频道
    function loadJs(file) {
        window.id = $("#user").val();
        var head = $("head").remove("script[role='reload']");
        $("<scri" + "pt>" + "</scr" + "ipt>").attr({ role: 'reload', src: file, type: 'text/javascript' }).appendTo(head);

    }
</script>
<script src="/js/app.js?v=1"></script>
</html>