
<div class="main-left">
    <div class="left-tag">
        <p>&nbsp LABEL</p>
        <ul>
         <?php foreach ($tags as $tag_item): ?>
                        <li> <a href="<?php echo site_url('blog/tag/'.$tag_item['id']); ?>"> <?php echo $tag_item["tagname"] ?></a> (<?php echo $tag_item['num'] ?>)</li> 
             <?php endforeach; ?>
        </ul>
        <br>
    </div>
    <div class="left-tag">
        <p>Search</p>
        <form method=post action="blog/searchinside">
        <input id='search' size="15" <?php if ($keyword != "") echo "value=$keyword" ?> name="keyword">
        <input type="submit" value="’æƒ⁄À—À˜">
        <!-- <span class="search_button"> </span> <a href="tool/vocabulary">µ•¥ ≤È—Ø</a> -->
        </form>
    </div>

</div>
