<html>
    <head>
        <title>coolcity's fun blog</title>
        <meta http-equiv="Content-Type" content="text/hmtl; charset=utf-8" />
	<base href="<?php  echo base_url();?>"/>
        <link rel="stylesheet" type="text/css" href="resource/basic.css">
        <link href="kindeditor/themes/default/default.css" rel="stylesheet" />
         <link rel="stylesheet" href="kindeditor/plugins/code/prettify.css" />
    </head>
    <body>

    <div class="banner" >
        <div class="banner-2">
            <h1>coolcity--- just for fun</h1>
        </div>
      
        <div id="nav-wrap1">
            <div id="nav-wrap2">
                <ul id="nav">
                    <li id="nav-homelink" class="current_page_item"><a class="fadeThis" href="blog" title="You are Home"><span>主页</span></a></li>
                    <li><a class="fadeThis" href="#"><span>关于</span></a></li>
                    <li><a class="fadeThis" href="blog/write"><span>写文</span></a></li>
                    <li><span class="welcome" >欢迎:</span>
                        <?php 
                         //session_start();
                        if (!isset($_SESSION['username']))
                        {
                            echo '<a style="color:#261c13;font-weight: bold;" onmouseover="this.style.cssText=\'color:#FFFFFF;\'" onmouseout="this.style.cssText=\'color:#261c13;\'" href="blog/login"><span>登录</span></a>';
                        }
                        else
                        {
                            $name = $_SESSION['username'];
                            echo '<span style="color:#ffffff;font-weight: bold;">'.$name.'</span>';
                        }

                        ?>
                    </li>
                    
                    <?php
                        if (isset($_SESSION['username']))
                        {
                            echo '<li><a class="fadeThis" href="backend/logout"> <span>注销</span></a></li>';
                        }
                    ?>
                </ul>
          </div>
        </div>
    </div>

    <div id="container" class="am-container ui-container">
        <div id="J_mayigogo" class="mayigogo">
              <b class="am-mayi mayi01" data-opt="{delay:1,speed:2}"></b>
              <b class="am-mayi mayi02" data-opt="{delay:1,speed:1}"></b>
              <b class="am-mayi mayi03" data-opt="{delay:3,speed:2}"></b>
        </div>
    </div>

