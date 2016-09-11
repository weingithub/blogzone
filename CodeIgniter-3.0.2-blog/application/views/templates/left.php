
<div class="main-left">
    <div class="left-tag">
        <p>&nbsp LABEL</p>
        <ul>
         <?php foreach ($tags as $tag_item): ?>
            <li> <a href="<?php echo site_url('blog/tag/'.$tag_item['id']); ?>"> <?php echo $tag_item["tagname"] ?></a></li> 
             <?php endforeach; ?>
        </ul>
        <br>
    </div>
    <div class="popular">
    
    </div>

</div>
