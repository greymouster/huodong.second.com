<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>系统登录</title>
    <link rel="stylesheet" href="/Public/Admin/css/style.css">
    <script src="/Public/Admin/js/jquery-1.11.3.min.js"></script>
	<script src="/Public/Admin/js/doLogin.js"></script>
</head>
<body>
    <div class="login">
        <h2>天道教育活动管理平台</h2>
        <form action="" >
            <p class="box" style="display:none;">！无效的用户名或密码</p>
            <dl>
                <dt>登录名：</dt>
                <dd><input class="name" name="username" type="text" placeholder="请输入RTX账号名" /></dd>
            </dl>
            <dl>
                <dt>密码：</dt>
                <dd><input type="password" name="password" /></dd>
            </dl>
            <dl class="check">
                <dt><input type="checkbox" name="remeber"/>记住我</dt>
            </dl>
            <input class="submit" type="button" value="登录" />
        </form>
    </div>
</body>
</html>
<script>


</script>