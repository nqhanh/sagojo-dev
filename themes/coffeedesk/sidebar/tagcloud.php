		<?php if(function_exists('wp_tag_cloud')){ ?>
				<li><h1>Tag Cloud</h1><div style="padding:5px 2px 5px 2px;"><?php wp_tag_cloud('smallest=10&largest=20&number=30&unit=px&format=flat&orderby=name'); ?></div></li>
		<?php }?>
