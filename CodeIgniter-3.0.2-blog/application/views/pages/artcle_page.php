            <div class="main-content">
            <?php foreach ($news as $news_item): ?>
                <div class="article">
                <p><a href="<?php echo site_url('blog/article/'.$news_item['id']); ?>"><?php echo $news_item['title']; ?></a></p>
                <div class="article_info">    
                    <span class="link_postdate"><?php echo $news_item['times']; ?></span>
                    <span class="link_postdate">post by <?php echo $news_item['userid']; ?></span>
                </div>
    
                <?php echo htmlspecialchars($news_item['brief']),"..."; ?>
                
                </div>
             <?php endforeach; ?>
            </div>
<br style="clear:both;" />  
<br style="clear:both;" />

