
<html>
    <head>
        <title>Welcome to my vocabulary</title>
        <meta http-equiv="Content-Type" content="text/hmtl; charset=utf-8" />
    <base href="<?php  echo base_url();?>"/>
        <link rel="stylesheet" type="text/css" href="resource/tool.css">
    
    </head>
<form action="tool/search" method="post" class="word_search">

    <input type="text" size=40 name="word" value="<?php if(!empty($word)) echo $word; ?>">
    <input type="submit" value="查询">
    </p>
</form>

<?php


?>

</html>
