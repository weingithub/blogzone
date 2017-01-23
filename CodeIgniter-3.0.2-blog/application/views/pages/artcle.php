

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
                    <?php echo $content; ?>   
                </div>
            </div>
<br style="clear:both;" />  
<br style="clear:both;" />

<script src="kindeditor/kindeditor-all.js"></script>
<script charset="utf-8" src="kindeditor/plugins/code/prettify.js"></script>
