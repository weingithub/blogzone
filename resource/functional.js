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


function pages(url,nextpage)
{
    var maxid =$('#hide_maxid')[0];
    var sum=$('#hide_sum')[0];
    var lastpage=$('#hide_lastpage')[0];
    var minid = $('#hide_minid')[0];
    
    var ch = url.charAt(url.length -1);
    
    var targeturl;
    
    //判断blog后是否为数字
    var fistpos = url.indexOf('/');
 
    //考虑以下这几种情况/blog ;/blog/; /blog/2 ;/blog/tag/1; /blog/tag/1/1
    //1与4相同处理
    //2
    //3与5同
    
    var splitlen = url.split('/').length;
    var nextpos =  url.indexOf('/', fistpos);

    if (nextpos != -1 && (nextpos - fistpos +2 == url.length)) //2
    {
        targeturl = url + nextpage;
    }   
    else if (nextpos == -1) //1
    {
        targeturl = url + "/"+ nextpage;
    }
    if (3 == splitlen || 5 == splitlen) //3或5
    {
        targeturl = url.substring(0, url.length -1) + nextpage;
    }
    else
    {
        targeturl = url + "/"+ nextpage;
    }

    //创建虚拟表单，提交post请求
    var temp = document.createElement("form");
    temp.action = targeturl;
    temp.method = "post";
    temp.style.display = "none"; 


    temp.appendChild(maxid);
    temp.appendChild(sum);
    temp.appendChild(lastpage);    
    temp.appendChild(minid);
    
    
    //var opt = document.createElement("input");    
    //opt.type = "submit";  
    //opt.name = "postsubmit";  

    //temp.appendChild(opt);  

    document.body.appendChild(temp);
    temp.submit();
    
    return 0;
}

function prononce_method(aobj)
{
    //alert("ok");
    var urlval = aobj.getAttribute("url");
    
    //alert(urlval);   
    
    /*
    $.ajax({
        type: 'get',
        url: urlval,
        async:false,
        success: function(responseText)
                  {
                alert("success");
        }
   })
   */
    window.open(urlval,'top');
   //window.location
}

