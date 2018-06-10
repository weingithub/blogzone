<link rel="stylesheet" type="text/css" href="resource/login.css">

<div class="register">
    <form action="backend/register" method="post" onsubmit="return check()">
        <table>
        <tr> 
        <td>用户名:</td>
        <td><input type="text" style="width:200px" id="name" class="input" name="username" onBlur="check_user_reg()"></td>
        <td><p id="pname" class="info_red">*</p>
        </td>
        </tr><tr>
        <td>密码:</td>
        <td><input type="password" style="width:200px" id="passwd" name="userpwd" onBlur="check_pwd_reg(this)"></td>
        <td><p id="ppwd" class="info_red">*</p>
        </td>
        </tr><tr>
        <td>确认密码:</td>
        <td><input type="password" style="width:200px" id="confirmpwd" name="confirmpwd" onBlur="check_pwd_reg(this)"></td>
        <td><p id="pconpwd" class="info_red">*</p>
        </td>
        </tr>
        </table>
        
        <input type="submit" value="注册" class="button_reg">
    </form>
</div>

<script src="resource/functional.js"></script>
