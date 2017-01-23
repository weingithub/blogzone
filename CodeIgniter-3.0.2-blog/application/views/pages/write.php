<?php
	$htmlData = '';
	if (!empty($content)) {
		if (get_magic_quotes_gpc()) {
			$htmlData = stripslashes($content);
		} else {
            $cont = $content."<br>";
			$htmlData = $cont;
		}
	}
?>

<?php
    
    if (!isset($_SESSION['username']))
    {
        header("Location: login"); 
        exit(0);
    }
    
?>

				<div class="main-content" >
                	<form name="example" method="post" action="Backend/savearticle">
                        <input type="text" name="aid" style="display:none" value="<?php if (empty($id)) echo 0; else echo $id; ?>" >
                        <p>标题:</p>
                        <select name="tag" id="tag_id">
                        <?php foreach ($tags as $tagopt): ?>
                           <option value="<?php echo $tagopt['id'] ?>" <?php if (!empty($tagid) && $tagid == $tagopt['id']) 
                                echo 'selected="true"';?> > 
                           <?php echo $tagopt['tagname']; ?></option>   
                        <?php endforeach; ?>
                        <input type="text" name="title" style="width:300px; height:30px;size:20; margin-left:20px;"
                            <?php if (!empty($title)) echo 'value="'.$title.'"'  ?>
                        >
                        <p>正文:</p>
                         <textarea name="content" style="width:700px;height:400px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
                    <br />
                    <input type="submit" name="button" value="提交内容" /> (提交快捷键: Ctrl + Enter)
                    </form>
				</div> 

    <link href="kindeditor/themes/default/default.css" rel="stylesheet" />
    <link rel="stylesheet" href="kindeditor/plugins/code/prettify.css" />
    <script src="kindeditor/kindeditor-all.js"></script>
    <script charset="utf-8" src="kindeditor/plugins/code/prettify.js"></script>
    
    <script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
                cssPath : 'http://www.yrczone.com/kindeditor/plugins/code/prettify.css',
				afterCreate : function() {
					var self = this;
                    
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
		});
    </script>
