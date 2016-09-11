 <link rel="stylesheet" type="text/css" href="resource/login.css">

<div class="login">
    <p class="preg"> 没有账号？<a href="blog/register">注册</a>一个吧</p>
    <form action="backend/login" method="post" onsubmit="return check_login()">
        <p>用户名:</p>
        <input type="text" style="width:200px" class="input" id="name" name="username" onBlur="check_user_login()">
        <p id="pname" class="info_red">*</p>       
        <br>
        <p>密码:</p>
        <input type="password" style="width:200px" id="userpass" name="userpwd" onBlur="check_pwd_login()">
        <p id="ppwd" class="info_red">*</p>
        <input type="submit" value="登录">
    </form>
</div>

<script src="resource/functional.js"></script>
