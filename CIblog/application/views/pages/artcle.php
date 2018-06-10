

            <div class="main-content">
                <div class="article_page">
                    <div class="article_page_title">
                         <h1><?php echo $title; ?></h1>
                    </div>
                    <div class="article_info">
                        <span><?php echo $times; ?></span>
                        <span class="author">post by <?php echo $userid; ?></span>
                    <?php
                        if (isset($_SESSION['username']) && $_SESSION['username'] == $userid)
                        {
                            echo '<a href="blog/write/'.$id.'">编辑</a>';
                            echo '<a href="backend/delete/'.$id.'" style="margin-left:20px;">删除</a>';
                        }
                    
                    ?>
                    </div>                

        <HR width="100%" SIZE=1/>               
        <div class="content">
        <?php echo $content; ?>   
        </div>
        <div class="comments">
            <div class="comment-content">
                <div class="comment-bigheader">
                 <h3> 评论</h3>
                 </div>
                 <?php 
                    $count = 0;
                    foreach($article_comments as $commitem): 
                    ++$count;
                 ?> 
                    <div class="comment-data" id="comment-<?php echo $commitem['id'] ?>">
                        <div class="comment-header">
                            <p><span><?php echo  $commitem['name'] ?> 说：</span>
                        </div>
                        <div class="comment-content" id="comment-quote-<?php echo $commitem['id'] ?>">
                        <?php echo $commitem['comm_content'] ?>
                        </div>
                        
                        <div class="comment-footer">
                            <p> <?php echo $commitem['comm_date'] ?>| <?php echo $count; ?>楼|
                            
                            <a href="<?php echo $_SERVER['REQUEST_URI'] ?>#comment-text" title="引用<?php echo $commitem['name'] ?>的这条评论" onclick='return CommentQuote("comment-quote-<?php echo $commitem['id'] ?>","<?php echo $commitem['name'] ?>")'>引用</a>
                            </p>
                        </div>
                    </div>
                  <?php endforeach;  ?>
            </div>
            <form action="blog/make_comment" method="post" name="comments_form">
                 <input type="hidden" name='article_id' value="<?php echo $id ?>">
                <div class="comment-publish" id="comment-publish">
                    <div class="comment-bigheader">
                        <h3> 发表评论</h3>
                    </div>
                    <div class="comment-publish-data">
                        <p>
                            <label for="comment-author">名字：</label>
                            <input id="comment-author" name="author" size=30> </input>
                        </p>
                    </div>
                    <p>
                            <label for="comment-text">评论：</label>
                            <textarea id="comment-text" name="text" rows="10" cols="50"></textarea>
                    </p>
                    
                    <div id="comment-publish-footer">
                        <input type="submit" value="提交"> </input>
                    </div>
                </div>
            </form>
        </div>  
    </div>
</div>
<br style="clear:both;" />  
<br style="clear:both;" />

<script charset="utf-8" src="resource/functional.js"></script>

