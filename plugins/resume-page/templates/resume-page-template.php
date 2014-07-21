<!DOCTYPE html>
<html>
<head>
<?php
global $wpdb;
if(isset($_GET['job_resumes'])){
	$resume_ID = $_GET["job_resumes"];

	$datas = $wpdb->get_results("SELECT * FROM wpjb_resume WHERE id = '$resume_ID'");	
	foreach ($datas as $data){
		if ($data->image_ext=="")
			$image = site_url()."/wp-content/plugins/wpjobboard/templates/user.png";
		else $image = site_url()."/wp-content/plugins/wpjobboard/environment/resumes/photo_".$data->id.".".$data->image_ext;
		$name = $data->firstname." ".$data->lastname;
		$tagline = $data->title;
		$email = $data->email;
		$website = $data->website;
		$phone = $data->phone;
		$location = $data->city;
		$experience = $data->experience;
		$education = $data->education;
		$kynang = $data->skills;
		$salary = $data->salary;
		$sym_currency = $data->sym_currency;		
		$objective_content = $data->headline;
		
		$getbgimg = $data->bg_image;
		$bgcolor = $data->bg_color;
		$containerbg = $data->ctn_color;
		$opacitybg = $data->bg_opacity;
		$txtcolor = $data->txtcolor;
		$link_color = $data->link_color;
		$customcss = $data->customcss;
		$template = $data->template;
	}
}

else if(isset($_GET['company'])){
	$company_ID = $_GET["company"]; 
	
	$datas = $wpdb->get_results("SELECT * FROM wpjb_employer WHERE id = '$company_ID'");	
	foreach ($datas as $data){
		if ($data->company_logo_ext=="")
			$image = site_url()."/wp-content/plugins/wpjobboard/templates/user.png";
		else $image = site_url()."/wp-content/plugins/wpjobboard/environment/company/logo_".$data->id.".".$data->company_logo_ext;
		$name = $data->company_name;		
		$fieldarea = $data->company_field;
		$quality = $data->company_qual;
		$website = $data->company_website;
		$location = $data->company_address;
		$experience = $data->company_info;
		$education = $data->why_us;		
		
		$getbgimg = $data->bg_image;
		$bgcolor = $data->bg_color;
		$containerbg = $data->ctn_color;
		$opacitybg = $data->bg_opacity;
		$txtcolor = $data->txtcolor;
		$link_color = $data->link_color;
		$customcss = $data->customcss;
		$template = $data->template;
	}
	
}
?>
        <title>sagojo - <?php echo $name?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php wp_head();?>
    </head>
    <body>
<?php


// helper functioun for convering hex to rgba
    function hex2rgb( $colour ) {
        if ( $colour[0] == '#' ) {
                $colour = substr( $colour, 1 );
        }
        if ( strlen( $colour ) == 6 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
        } elseif ( strlen( $colour ) == 3 ) {
                list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
        } else {
                return false;
        }
        $r = hexdec( $r );
        $g = hexdec( $g );
        $b = hexdec( $b );
        return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	}
// setup variables - if you're overriding in a child template be sure to keep these here! only chnage the markup below and use these to fill in dynamic info

/*
$name 				= get_post_meta(get_the_ID(),'rp_name', true);
$tagline 			= get_post_meta(get_the_ID(),'rp_tagline', true);
$email 				= get_post_meta(get_the_ID(),'rp_email', true);
$website 			= get_post_meta(get_the_ID(),'rp_website', true);
$phone 				= get_post_meta(get_the_ID(),'rp_phone', true);
*/
$twitter 			= get_post_meta(get_the_ID(),'rp_twitter', true);
$facebook			= get_post_meta(get_the_ID(),'rp_facebook', true);
$github 			= get_post_meta(get_the_ID(),'rp_github', true);

$hide_objective 	= get_post_meta(get_the_ID(),'rp_disable_objective', true);
$hide_experience 	= get_post_meta(get_the_ID(),'rp_disable_experience', true);
$hide_github 		= get_post_meta(get_the_ID(),'rp_disable_github', true);
$hide_skills 		= get_post_meta(get_the_ID(),'rp_disable_skills', true);
$hide_education 	= get_post_meta(get_the_ID(),'rp_disable_education', true);
//$hide_portfolio 	= get_post_meta(get_the_ID(),'rp_disable_portfolio', true);

$dir = $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/wpjobboard/environment/resumes/portfolio/'.$resume_ID;
$hide_portfolio = is_dir_empty($dir);

$objective_title 	= get_post_meta(get_the_ID(),'rp_objective_title', true) ? get_post_meta(get_the_ID(),'rp_objective_title', true) : __('Objective','resume-page');
/*
$objective_content 	= get_post_meta(get_the_ID(),'rp_objective_content', true) ? get_post_meta(get_the_ID(),'rp_objective_content', true) : __('What is your objective?','resume-page');
*/

$experience_title 	= get_post_meta(get_the_ID(),'rp_experience_title', true) ? get_post_meta(get_the_ID(),'rp_experience_title', true) : __('Experience','resume-page');
$github_title 		= get_post_meta(get_the_ID(),'rp_github_title', true) ? get_post_meta(get_the_ID(),'rp_github_title', true) : __('Github Activity','resume-page');
$skills_title 		= get_post_meta(get_the_ID(),'rp_skills_title', true) ? get_post_meta(get_the_ID(),'rp_skills_title', true) : __('Skills','resume-page');
$education_title 	= get_post_meta(get_the_ID(),'rp_education_title', true) ? get_post_meta(get_the_ID(),'rp_education_title', true) : __('Education','resume-page');
$portfolio_title 	= get_post_meta(get_the_ID(),'rp_portfolio_title', true) ? get_post_meta(get_the_ID(),'rp_portfolio_title', true) : __('Portfolio','resume-page');

//$skills 			= get_post_meta(get_the_ID(),'rp_single_skill', false);
$schools 			= get_post_meta(get_the_ID(),'rp_school_places', false);
$companies 			= get_post_meta(get_the_ID(),'rp_work_places', false);

//begin Hanhdo coding

 if($salary): if ($sym_currency==0): $sym_currency="USD"; else: $sym_currency="VND"; endif;
            
				
                 $mysalary = number_format($salary,0,",",".").$sym_currency."[:en]/month[:vi]/tháng[:ja]/month";
            
			 else :
			
                 $mysalary = "[:en]Negotiable[:vi]Lương thỏa thuận[:ja]Negotiable";
            		
             endif; 

$city_file = "city_list_vn.ini" ;
	if (file_exists($city_file) && is_readable($city_file))
	{
		$citys=parse_ini_file($city_file,true);
		foreach ($citys as $city) { 
			if($location==$city['code']) {$my_location = $city['name'];}		
		}
	} else
		{
			// If the configuration file does not exist or is not readable, DIE php DIE!
			die("Sorry, the $city_file file doesnt seem to exist or is not readable!");
		}
//$themeclass 		= get_post_meta(get_the_ID(),'rp_theme', true) ? get_post_meta(get_the_ID(),'rp_theme', true) : 'paper';
$themeclass 		= $template == 0 || $template == 2 || $template == 3 || $template == 4 ?  'flat' : 'paper';

//$getbgimgid 		= get_post_meta(get_the_ID(),'rp_bg_img', true);
//$getbgimg 			= $getbgimgid ? wp_get_attachment_url( $getbgimgid ) : false;

$bgdefault = "http://sagojo.com/wp-content/banners/cvbg4.jpg";
$bgimg 				= is_numeric($getbgimg) ? sprintf('background:url(\'%s\');background-attachment :fixed;',$bgdefault) : sprintf('background:url(\'%s\');background-attachment :fixed;',$getbgimg);


//$bgcolor			= get_post_meta(get_the_ID(),'rp_bg_color', true) ? get_post_meta(get_the_ID(),'rp_bg_color', true) : '#FFFFFF';

$styles 			= $bgimg || $bgcolor ? sprintf('%s;background-color:%s;',$bgimg,$bgcolor) : false;

$container_to_rgba 		= $containerbg ? hex2rgb($containerbg) : hex2rgb('#FFFFFF');
$container_rgba 		= $containerbg ? sprintf('%s,%s,%s',$container_to_rgba['red'],$container_to_rgba['green'],$container_to_rgba['blue']) : false;
$final_container_color 	= $containerbg ? sprintf('background:%s;background:rgba(%s,%s);',$containerbg,$container_rgba,$opacitybg) : false;



//$innerstyles 		= $containerbg || $opacitybg ? sprintf('background-color:%s;opacity:%s',$containerbg,$opacitybg) : false;




		if ($styles || $txtcolor || $innerstyles || $link_color): ?>
		<!-- Resume Page - User Set Styles -->
		<style>
		.resume-wrap {<?php echo $styles;?>;background-size: 100%;}
		.resume-wrap a i,.resume-wrap {color:<?php echo $txtcolor;?>;}
		.resume-inner {<?php echo $final_container_color;?>;}
		.label-resume {background:<?php echo $link_color;?>;}
		.resume-bio-social a:hover i,.resume-wrap a {color:<?php echo $link_color;?>;}
		.frontcover {
			margin-top: 20px;
			position: relative;
			text-align: center;
			background-color: <?php echo $bgcolor;?>;
			padding: 10px;
			color: <?php echo $containerbg;?>;
		}
		</style>
		<?php endif;

		if ( $customcss ):
			?><!-- Resume Page - User Custom CSS --><style><?php echo $customcss;?></style><?php
		endif;


		
		
		
do_action('ba_resume_page_before'); // action

	?>
	<?php
	if(isset($_GET['job_resumes'])){
		if($template==0){
			?><link rel="stylesheet" href="<?php echo plugins_url('../css/style1.css', __FILE__ );?>"><?php
			include ("cvtemplate-1.php");
		}
		else if($template==1){
			?><link rel="stylesheet" href="<?php echo plugins_url('../css/style2.css', __FILE__ );?>"><?php
			include ("cvtemplate-2.php");
		}
		else if($template==2){
			?><link rel="stylesheet" href="<?php echo plugins_url('../css/style3.css', __FILE__ );?>"><?php
			include ("cvtemplate-3.php");
		}
		else if($template==3){
			?><link rel="stylesheet" href="<?php echo plugins_url('../css/style4.css', __FILE__ );?>"><?php
			include ("cvtemplate-4.php");
		}
		else if($template==4){
			?><link rel="stylesheet" href="<?php echo plugins_url('../css/style5.css', __FILE__ );?>"><?php
			include ("cvtemplate-5.php");
		}
	}
	else if(isset($_GET['company'])){
		if($template==0){
			?><link rel="stylesheet" href="<?php echo plugins_url('../css/comstyle1.css', __FILE__ );?>"><?php
			include ("comtemplate-1.php");
		}
		else if($template==1){
			?><link rel="stylesheet" href="<?php echo plugins_url('../css/comstyle2.css', __FILE__ );?>"><?php
			include ("comtemplate-2.php");
		}
		else if($template==2){
			?><link rel="stylesheet" href="<?php echo plugins_url('../css/comstyle3.css', __FILE__ );?>"><?php
			include ("comtemplate-3.php");
		}
		else if($template==3){
			?><link rel="stylesheet" href="<?php echo plugins_url('../css/comstyle4.css', __FILE__ );?>"><?php
			include ("comtemplate-4.php");
		}
		else if($template==4){
			?><link rel="stylesheet" href="<?php echo plugins_url('../css/comstyle5.css', __FILE__ );?>"><?php
			include ("comtemplate-5.php");
		}
	}
	?>
		
	<?php
do_action('ba_resume_page_after'); // action

wp_footer();?>
</body></html>