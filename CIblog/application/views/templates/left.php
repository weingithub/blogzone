
<div class="main-left">
    <div class="left-tag">
        <p>&nbsp 标签</p>
        <ul>
         <?php foreach ($tags as $tag_item): ?>
            <li> <a href="<?php echo site_url('blog/tag/'.$tag_item['id']); ?>"> <?php echo $tag_item["tagname"] ?></a> (<?php echo $tag_item['num'] ?>)</li> 
             <?php endforeach; ?>
        </ul>
        <br>
    </div>
    <div class="popular">
    
    </div>
        <div class="left-tag">
        <p>Search</p>
        <form method=post action="blog/searchinside">
        <input id='search' size="15" <?php if ($keyword != "") echo "value=$keyword" ?> name="keyword">
        <input type="submit" value="站内搜索">
        </form>
    </div>    

    <div class="left-tag">
        <p>&nbsp;友情链接</p>
        &nbsp;<a href="http://www.boatsky.com/" title="一个有追求的前端工程师">太空船博客</a>
    </div>
</div>
