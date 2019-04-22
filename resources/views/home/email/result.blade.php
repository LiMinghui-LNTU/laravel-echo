<!DOCTYPE html>
<html>
<head>
    <title>激活结果</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">{{$result}}</div>
    </div>
    <span id="second">3</span> 即将<a href="http://www.594lang.xin/self">跳转</a>...
</div>
</body>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script>
    var second = 3;
    timer();
    function timer(){
        setTimeout(function(){
            second--;
            $("#second").html(second);
            if(second == 0){
                window.location.href = 'http://www.594lang.xin/self';
            }
            timer();
        },1000);
    }
</script>
</html>
