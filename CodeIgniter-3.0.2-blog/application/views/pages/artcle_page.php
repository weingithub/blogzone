            <div class="main-content">
            <?php foreach ($news as $news_item): ?>
                <div class="article">
                <p><a href="<?php echo site_url('blog/article/'.$news_item['id']); ?>"><?php echo $news_item['title']; ?></a></p>
                <div class="article_info">    
                    <span class="link_postdate"><?php echo $news_item['times']; ?></span>
                    <span class="link_postdate">post by <?php echo $news_item['userid']; ?></span>
                </div>
                <?php echo strip_tags($news_item['brief']),"..."; ?>
                </div>
             <?php endforeach; ?>
                    <input type="hidden" id="hide_maxid" name='maxid' value="<?php echo $maxid ?>"> 
                    <input type="hidden" id="hide_tagid" name='tagid' value="<?php echo $curtag ?>"> 
                    <input type="hidden" id="hide_sum" name='sum' value="<?php echo $allpage ?>"> 
                    <input type="hidden" id="hide_lastpage" name='lastpage' value="<?php echo $curpage ?>"> 
                    <input type="hidden" id="hide_minid" name='minid' value="<?php echo $minid ?>"> 
                    <?php
                        echo '<div id="pagenavi" class="navigation">
                        <span class="pages">第 '.$curpage.'页， 共'.$allpage.'页</span>
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
