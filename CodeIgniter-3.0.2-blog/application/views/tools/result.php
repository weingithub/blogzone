<?php
    
    if (0 == count($voc))
    {
        echo "未收录该单词，请在以下表格中进行输入:";
    ?>
     
     <div id="english-header" class="head_info">   
    <form action="tool/save" method="post">
           <p> 单词: <input type="text" size=20 name="word"> </p>
           <p> 页数: <input type="text" size=20 name="page"> </p>
           <p> 序号: <input type="text" size=20 name="seq"> </p>
           <p> 中文:<input type="text" size=20 name="mean"> </p>
          
            
    <input type="submit" value="收录">
    </p>
    </form>
    
    </div>
<?php    
    }
    else
    {
?>
        <?php foreach ($voc as $news_item): ?>
        
        <div id="english-header" class="head_info">
            <div id="pinyin" class="prononce">
            <h2>
                <strong> <?php echo $news_item["vocabulary"] ?>
                <span>
                <b lang="EN-US" xml:lang="EN-US"><?php echo $news_item["phonogram_eng"]?></b>
                <a url=<?php echo $news_item["pronounce_eng"] ?> href="javascript:void(0);" onclick="prononce_method(this)" >&nbsp;</a>
                <b lang="EN-US" xml:lang="EN-US"><?php echo $news_item["phonogram_us"]?></b>
                <a url=<?php echo $news_item["pronounce_us"] ?> href="javascript:void(0);" onclick="prononce_method(this)" >&nbsp;</a>
                </span>
            </h2>
            <div class="content">
                <h1>
                    <b class="active" data-id="simple_means">简明释义</b>
                </h1>
              
            </div>
                <?php echo $news_item["meaning"] ?>
           <p> 页数: <?php echo $news_item["page"] ?> </p>
           <p> 序号: <?php echo $news_item["seq"] ?> </p>
           </div>
        </div>
        <?php endforeach; 

    }
    ?>
<script src= "resource/jquery-3.1.0.js"></script>
<script src="resource/functional.js"></script>
</html>
