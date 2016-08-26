<head>
    <style>
        .article {
    height: 280px;
    width: 100%;
    margin-top:10px;
    padding: 0.8em;
    border: 1px solid black;
    background-color:#ffffff;
    }


    </style>
</head>


<?php foreach ($news as $news_item): ?>

    <div class="article">
        <p><a href="<?php echo site_url('news/'.$news_item['id']); ?>"><?php echo $news_item['title']; ?></a></p>
        <?php echo $news_item['content']; ?>

        
    </div>

<?php endforeach; ?>
