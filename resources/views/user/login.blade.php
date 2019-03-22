<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="js/mui.min.js"></script>
    <link href="css/mui.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="container">
    <div class="col-md-6 col-md-offset-3">


        <div class="form-group has-feedback">
            <label for="username">用户名</label>
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input id="username" class="form-control" placeholder="请输入用户名" maxlength="20" type="text">
            </div>

            <span style="color:red;display: none;" class="tips"></span>
            <span style="display: none;" class=" glyphicon glyphicon-remove form-control-feedback"></span>
            <span style="display: none;" class="glyphicon glyphicon-ok form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
            <label for="password">密码</label>
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                <input id="password" class="form-control" placeholder="请输入密码" maxlength="20" type="password">
            </div>

            <span style="color:red;display: none;" class="tips"></span>
            <span style="display: none;" class="glyphicon glyphicon-remove form-control-feedback"></span>
            <span style="display: none;" class="glyphicon glyphicon-ok form-control-feedback"></span>
        </div>

        <div class="form-group">
            <button class="form-control btn btn-primary" onclick="submit()">立&nbsp;&nbsp;即&nbsp;&nbsp;登&nbsp;&nbsp;录</button>
        </div>
    </div>
</div>
</body>

</html>

<script>
    function submit(){
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        mui.ajax({
            url:'/login',
            data:{username:username,password:password},
            type:"POST",
            dataType:"json",
            success:function(data){
                alert(data.msg);
                window.location.href = "{{$url}}";
            },
            error:function(data){
                alert(data.msg)
            }


        })
    }
</script>
