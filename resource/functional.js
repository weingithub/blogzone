function check_user_reg()
{
    //先判断用户名是否为空
    var name=$('#name').val();
    
    if (!name.length)
    {
        //$("#pname").toggleClass("info_red");
        $('#pname').removeClass("info_green").addClass("info_red");
        $('#pname').text("*用户名不能为空");
        return false;
    }

    //判断用户名是否已存在
    var res = false;

    $.ajax({ 
        type: 'post', 
        url: 'backend/checkuser', 
        dataType: 'json', 
        async:false,
        data:"uid="+name, 
        success: function(responseText) 
                  { 
                    if (responseText["isexists"])
                    {
                        $('#pname').text("*用户名已经存在");
                        //$("#pname").toggleClass("info_red"); 
                        $('#pname').removeClass("info_green").addClass("info_red");
                        res = false;
                    }
                    else
                    {
                        $('#pname').html("&radic;&nbsp;用户名可以使用");
                        $('#pname').removeClass("info_red").addClass("info_green");
                        //$("#pname").toggleClass("info_green");
                        res = true;
                    }
                  }  
   }) 

    return res;
}

function check_user_login()
{
    //先判断用户名是否为空
    var name=$('#name').val();

    if (!name.length)
    {
        $('#pname').text("*用户名不能为空");
        return false;
    }

    //判断用户名是否已存在
    var res = false;

    $.ajax({
        type: 'post',
        url: 'backend/checkuser',
        dataType: 'json',
        async:false,
        data:"uid="+name,
        success: function(responseText)
                  {
                    if (responseText["isexists"])
                    {
	            		$('#pname').text("");
                        res = true;
                    }
                    else
                    {
			            $('#pname').text("*用户名不存在");
                        res = false;
                    }
                  }
   })

    return res;
}

function check_pwd_reg(pass)
{
    var passwd = $(pass).val();
    var pobj;
    var otherpwd;

    if ($(pass).attr("name") == "confirmpwd")
    {
        pobj = $('#pconpwd');   
        otherpwd = $('#passwd').val();       
    }
    else
    {
        pobj = $('#ppwd');        
        otherpwd = $('#confirmpwd').val(); 
    }

    if (!passwd.length)
    {
        $(pobj).text("*密码不能为空");
        $(pobj).removeClass("info_green").addClass("info_red");
        return false;
    }
    
    if(passwd != otherpwd)
    {
        $(pobj).text("*密码不一致");
        $(pobj).removeClass("info_green").addClass("info_red");
        return false;
    }
    else
    {
        $('#pconpwd').html("&radic;&nbsp;密码可用");
        $('#pconpwd').removeClass("info_red").addClass("info_green");
        $('#ppwd').html("&radic;&nbsp;密码可用");
        $('#ppwd').removeClass("info_red").addClass("info_green");
        
        return true;
    }    
}

function check_pwd_login()
{
    var pval = $('#userpass').val();
    
    if (!pval.length)
    {
        $('#ppwd').text("*密码不能为空");
        return false;
    }

    return true;
}

function check()
{
    var resuser = check_user_reg();
    var respwd =  check_pwd_reg($('#passwd'));

    if (!resuser || !respwd)
    {
        alert("不可注册，条件不满足");
        return false;
    }
    
    return true;
}

function check_login()
{
    var resuser = check_user_login();
    var respwd =  check_pwd_login();

    if (!resuser || !respwd)
    {
        alert("条件不满足，不能登录");
        return false;
    }

    return true;
}
