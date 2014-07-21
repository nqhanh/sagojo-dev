<!-- CSS For The Menu --> 
<link rel="stylesheet" href="<?php echo plugins_url('style.css', __FILE__ );?>" /> 
<!-- Menu Start --> 
<div id="jQ-menu" class="newspaper"> 
<?php
	$path = "../wp-content/plugins/wpjobboard/environment/apply/";

	function createDir($path = '.')
	{	
		if ($handle = opendir($path)) 
		{
			echo "<ul>";
		
			while (false !== ($file = readdir($handle))) 
			{
				if (is_dir($path.$file) && $file != '.' && $file !='..')
					printSubDir($file, $path, $queue);
				else if ($file != '.' && $file !='..')
					$queue[] = $file;
			}
			
			printQueue($queue, $path);
			echo "</ul>";
		}
	}
	
	function printQueue($queue, $path)
	{	
		if(!empty($queue)){
			foreach ($queue as $file) 
			{
				printFile($file, $path);
			}
		}
	}
	
	function printFile($file, $path)
	{
		echo "<li><a href=\"".$path.$file."\">$file</a></li>";
	}
	
	function printSubDir($dir, $path)
	{
		echo "<li><span class=\"toggle\">$dir</span>";
		createDir($path.$dir."/");
		echo "</li>";
	}
	
	createDir($path);
?>
</div> 
<!-- End Menu --> 
<!-- Add jQuery From the Google AJAX Libraries --> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script> 
 
<!-- jQuery Color Plugin --> 
<script src="<?php echo plugins_url('jquery.color.js', __FILE__ );?>" type="text/javascript"></script>  
 
<!-- Import The jQuery Script --> 
<script src="<?php echo plugins_url('jMenu.js', __FILE__ );?>" type="text/javascript"></script>  