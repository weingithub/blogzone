

            <div class="main-content">
                <div class="article_page">
                <h1><?php echo $title; ?></h1>
                
                  <div class="article_info">
                    <span><?php echo $times; ?></span>
                    <span>post by <?php echo $userid; ?></span>
                <?php
                    if (isset($_SESSION['username']) && $_SESSION['username'] == $userid)
                    {
                        echo '<a href="blog/write/'.$id.'">编辑</a>';
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
