<?php
if ($_POST['variable'] == '')
    {
    $variable = './'; // default folder
    }
    else
    {
    $variable = $_POST['variable'] ;
    }
    $folder = $variable;
	//mkdir('/var/www/wp-content/plugins/wpjobboard/environment/company/portfolio');
	//mkdir('/var/www/wp-content/plugins/resume-page/templates/images');
	//mkdir('/var/www/wp-content/plugins/resume-page/templates/css');
	//mkdir('/var/www/wp-content/plugins/resume-page/templates/js');
	//mkdir('/var/www/wp-content/plugins/wpjobboard/templates/job-board/images');
	//mkdir('/var/www/wp-content/themes/responsive/css/slider/images');
	//mkdir('/var/www/wp-content/themes/responsive/js/slider');
	//unlink('/var/www/wp-content/plugins/wpjobboard/application/libraries/Widget/featured-jobs-local.php');
    $uploadpath = "$folder/";      
    $max_size = 2000;          
    $alwidth = 1500;            
    $alheight = 800;           
    $allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png','php','css','mo','po','js','ini','svg','ttf','eot','woff');        
    //$allowtype = array('bmp', 'gif', 'jpg', 'jpe', 'png');
    if(isset($_FILES['fileup']) && strlen($_FILES['fileup']['name']) > 1) {
      $uploadpath = $uploadpath . basename( $_FILES['fileup']['name']);       
      $sepext = explode('.', strtolower($_FILES['fileup']['name']));
      $type = end($sepext);       
      list($width, $height) = getimagesize($_FILES['fileup']['tmp_name']);     
      $err = '';        
    
      
      if(!in_array($type, $allowtype)) $err .= 'The file: <b>'. $_FILES['fileup']['name']. '</b> not has the allowed extension type.';
      if($_FILES['fileup']['size'] > $max_size*1000) $err .= '<br/>Maximum file size must be: '. $max_size. ' KB.';
      if(isset($width) && isset($height) && ($width >= $alwidth || $height >= $alheight)) $err .= '<br/>The maximum Width x Height must be: '. $alwidth. ' x '. $alheight;
    
      
      if($err == '') {
	chmod($uploadpath,0777);
        if(move_uploaded_file($_FILES['fileup']['tmp_name'], $uploadpath)) { 
		chmod($uploadpath,0755);
          echo 'File: <b>'. basename( $_FILES['fileup']['name']). '</b> successfully uploaded:';
          echo '<br/>File type: <b>'. $_FILES['fileup']['type'] .'</b>';
          echo '<br />Size: <b>'. number_format($_FILES['fileup']['size']/1024, 3, '.', '') .'</b> KB';
          if(isset($width) && isset($height)) echo '<br/>Image Width x Height: '. $width. ' x '. $height;
          echo '<br/><br/>File address: <b>http://'.$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['REQUEST_URI']), '\\/').'/'.$uploadpath.'</b>';
        }
        else echo '<b>Unable to upload the file.</b> '.$uploadpath;
      }
      else echo $err;
    }
    ?> 
    <div style="margin:1em auto; width:333px; text-align:center;">
     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"> 
      Upload File: <input type="file" name="fileup" /><br/>
    <?php /*<select name="variable" />
    <option value="" selected="selected">Select a folder</option>*/?>
    <html>
    <body>
    <form name="input" action="upload.php" method="post" onchange="this.form.submit()">
    <input type = "text" name="variable">
    <?php
    /*$dirs = glob("*", GLOB_ONLYDIR);

    foreach($dirs as $val){
    echo '<option value="'.$val.'">'.$val."</option>\n";
    }*/
    ?>
    <?php /*</select>*/ ?>
      <input type="submit" name='submit' value="Upload" /> 
	 
     </div>
    </form>
    </body>
    </html>