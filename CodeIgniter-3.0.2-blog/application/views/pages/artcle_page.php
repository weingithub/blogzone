            <div class="main-content">
            <?php foreach ($news as $news_item): ?>
                <div class="article">
                <div>
                <p><a href="<?php echo site_url('blog/article/'.$news_item['id']); ?>"><?php echo $news_item['title']; ?></a></p>
                <?php echo strip_tags($news_item['brief']),"..."; ?>
                </div>
                <div class="article_info">    
                    发布时间：<span><?php echo $news_item['times']; ?></span>&nbsp;| 
                    作者：<span class="author"><?php echo $news_item['userid']; ?></span>&nbsp;| 
                    分类：<a href="<?php echo site_url('blog/tag/'.$news_item['tagid']);?>"><?php echo $news_item['tagname']; ?></a>&nbsp;
                </div>
                </div>
             <?php endforeach; ?>
                    <input type="hidden" id="hide_maxid" name='maxid' value="<?php echo $maxid ?>"> 
                    <input type="hidden" id="hide_tagid" name='tagid' value="<?php echo $curtag ?>"> 
                    <input type="hidden" id="hide_sum" name='sum' value="<?php echo $allpage ?>"> 
                    <input type="hidden" id="hide_lastpage" name='lastpage' value="<?php echo $curpage ?>"> 
                    <input type="hidden" id="hide_minid" name='minid' value="<?php echo $minid ?>"> 

                    <?php
                        //判断是否有keyword字段
                        if(isset($keyword))
                            echo '<input type="hidden" id="hide_keyword" name="keyword" value="'.$keyword.'">';
                    ?>   
		            
		    <?php
                        echo '<div id="pagenavi" class="navigation">
                        <span class="pages">第 '.$curpage.'页,共'.$allpage.'页</span>
                         ';
                    ?>

                 <?php 

                        $start = max(1, $curpage-2);
                        
                        if ($start > 1)
                        {
                    ?>
                     <a class="page_larger" href="javascript:void(0);" onclick='pages("<?php echo $_SERVER['REQUEST_URI']; ?>", 1)'> 最新 </a>    
                 <?php   }
                        
                        if ($curpage > 1)
                        {
                 ?>
                    <a class="page_larger" href="javascript:void(0);" onclick='pages("<?php echo $_SERVER['REQUEST_URI']; ?>", <?php echo $curpage-1; ?> )'> << </a>
                <?php    }
                        
                        if ($start > 1)
                        {
                ?>
                    <span class="extend">...</span>        
               <?php    }
                        
                        $end = max($allpage/2, $curpage+2);

                        for($j=$start; $j <= $end && $j <= $allpage; $j++)
                        {
                            if ($j != $curpage)
                            {
               ?>
                    <a class="page_larger" href="javascript:void(0);" onclick='pages("<?php echo $_SERVER['REQUEST_URI']; ?>",<?php echo $j ?> )'> <?php echo $j ?> </a>
               <?php        }
                            else
                            {
               ?>
                     <span class="current"> <?php echo $curpage; ?> </span>
                                        
                <?php       }
                        }

                        if ($end < $allpage)
                        {
                ?> 
                   <span class="extend">...</span>
                <?php   }

                        if ($curpage < $allpage)
                        {
                 ?>
                   <a class="page_larger" href="javascript:void(0);" onclick='pages("<?php echo $_SERVER['REQUEST_URI']; ?>",<?php echo $curpage+1 ?> )'> >> </a>
                <?php   }   
                        
                        if ($end < $allpage)
                        {
                ?> 
                     <a class="page_larger" href="javascript:void(0);" onclick='pages("<?php echo $_SERVER['REQUEST_URI']; ?>",<?php echo $allpage ?> )'> 最旧>> </a>
                <?php   }
                ?>

            </div>
<br style="clear:both;" />  
<br style="clear:both;" />

<script src= "resource/functional.js"></script>
