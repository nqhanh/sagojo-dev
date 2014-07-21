<?php
/*
 * Some variables are already defined:
 *
 * - $theme_options An array with all theme options
 * - $theme_url Is the absolute URL to the theme folder used to reference images
 * - $theme_subject Will be the email subject if set by this theme
 *
 */

global $newsletter, $post;

$color = $theme_options['theme_color'];
if (empty($color)) $color = '#0088cc';

if (isset($theme_options['theme_posts'])) {
    $filters = array();
    
    if (empty($theme_options['theme_max_posts'])) $filters['showposts'] = 10;
    else $filters['showposts'] = (int)$theme_options['theme_max_posts'];
    
    if (!empty($theme_options['theme_categories'])) {
        $filters['category__in'] = $theme_options['theme_categories'];
    }
    
    if (!empty($theme_options['theme_tags'])) {
        $filters['tag'] = $theme_options['theme_tags'];
    }
    
    if (!empty($theme_options['theme_post_types'])) {
        $filters['post_type'] = $theme_options['theme_post_types'];
    }    
    
    $posts = get_posts($filters);
}

?><!DOCTYPE html>
<html>
<head>
        <!-- Not all email client take care of styles inserted here -->
        <style type="text/css" media="all">
            a {
                text-decoration: none;
                color: #555555;
            }
        </style>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body style="background-color: #e5e5e5; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 14px; color: #666; margin: 0 auto; padding: 0;">
       <table width="680" align="center" cellpadding="0" cellspacing="0" bgcolor="#f4f4f4" >
	   <tbody style="background: none repeat scroll 0 0 #FFFFFF; font-family:Arial, Helvetica, sans-serif;">
      <tr>
      
        <td colspan="5" height="150" style="font-size: 0;line-height: 0;" bgcolor="#21196A">
        <div>
		
			<a href="<?php echo site_url()?>"><img style="padding-bottom: 20px;" src="<?php echo site_url()?>/wp-content/themes/responsive/core/images/sagojo_h.png" alt="Plum jobs, rewarding lives" /></a>
			
      	</div>
      	</td>
      
      </tr>
      <tr>
        <td colspan="5" bgcolor="#738FE6">
		<div >
					 <table width="660" border="0">
					  <tr height="50">
						<td width="132" align="center" valign="middle"><a target="_blank" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFF; text-decoration:none;" title="Top page" href="http://www.sagojo.com" >Top page </a></td>
						<td width="132" align="center" valign="middle"><a target="_blank" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFF; text-decoration:none;" title="For Employer" href="http://sagojo.com/for-employer/" >For Employer</a></td>
						<td width="132" align="center" valign="middle"><a target="_blank" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFF; text-decoration:none;" title="For JobSeeker" href="http://sagojo.com/for-jobseeker/">For JobSeeker</a></td>
						<td width="135" align="center" valign="middle"><a target="_blank" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFF; text-decoration:none;" title="Job auction" href="http://sagojo.com/freelance-page/" >Job auction</a></td>
						<td width="132" align="left" valign="middle"><a target="_blank" style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFF; text-decoration:none;" title="Blog" href="http://sagojo.com/vi/tim-viec-lam-online/blog/">Blog</a></td>
				  </tr>
				</table>	
						
						
				 </div>
        
        	
        
        </td>
      </tr>
      <tr>
        <td colspan="5" height="5" ></td>
      </tr>
   
      <tr>
         <td colspan="5" valign="middle" style="">
			<table cellpadding="0" width="660px" align="center">
                                <?php
                                $i=0;
                                foreach ($posts as $post) {
									setup_postdata($post);
									if ($i==0){?>
                                    <tr style="font-size: 16px; color:#555555;">
                                        <?php if (isset($theme_options['theme_thumbnails'])) {?>
                                        <td colspan="5"><a target="_blank"  href="<?php echo get_permalink(); ?>"><img style="float: left; text-align:center; " src="<?php echo newsletter_get_post_image($post->ID,'large-image'); ?>" alt="image" width="100%"></a></td>
                                    </tr>
                                    <tr style="font-size: 16px; color:#555555;">
                                        <?php } ?>
                                        <td valign="top" colspan="5">
                                            <a target="_blank"  href="<?php echo get_permalink(); ?>" style="font-size: 18px; line-height: 26px; text-decoration:none;"><?php the_title(); ?></a>
                                            <?php if (isset($theme_options['theme_excerpts'])) the_excerpt(); ?><div style="text-align: right;" ><a style="font-size:13px; text-decoration:none;" target="_blank"  href="<?php echo get_permalink(); ?>">(Đọc tiếp...)</a></div>
											
                                        </td>
                                    </tr>
                                    <tr><td colspan="5"></td></tr>
                                    <tr style="font-size: 16px; color:#555555;">
									<?php } elseif ($i==1 || $i==2) { //else if ($i !=0)?>
									
                                        <?php if (isset($theme_options['theme_thumbnails'])) { ?>
                                        <td width="210px" valign="top" ><a target="_blank"  href="<?php echo get_permalink(); ?>"><img style="float: left;" src="<?php echo newsletter_get_post_image($post->ID,'small-image'); ?>" alt="image" width="100%"></a>
                                        <?php } ?>
                                        <a target="_blank"  href="<?php echo get_permalink(); ?>" style="font-size: 18px; line-height: 26px; text-decoration:none;"><?php the_title(); ?></a><br/>
                                            <?php if (isset($theme_options['theme_excerpts'])) the_content_rss('', FALSE, '', 20); ?>
                                             
                                        </td>
                                    	<td width="15px" valign="top" ></td>
                                    
									<?php } elseif ($i==3) {?>
									<?php if (isset($theme_options['theme_thumbnails'])) { ?>
                                        <td width="210px" valign="top" ><a target="_blank"  href="<?php echo get_permalink(); ?>"><img style="float: left;" src="<?php echo newsletter_get_post_image($post->ID,'small-image'); ?>" alt="image" width="100%"></a>
                                        <?php } ?>
                                        <a target="_blank"  href="<?php echo get_permalink(); ?>" style="font-size: 18px; line-height: 26px; text-decoration:none;"><?php the_title(); ?></a><br/>
                                            <?php if (isset($theme_options['theme_excerpts'])) the_content_rss('', FALSE, '', 20); ?>
                                             
                                        </td>
								<?php } //end if ($i==0)
								$i++; } //end foreach ?>
                   </tr>          
            </table>
		 
		 </td>
      </tr>
      <tr>
        <td colspan="5">
		
		</td>
       
      </tr>
     <tr>
         <td colspan="5" height="10" align="center" ></td>
       
      </tr>
      <tr valign="middle">
	  
        <td  bgcolor="#F0F8FF"  height="350">
        
		<div style="width: 680px; background:#F0F8FF;"> 
		
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
		 <tr>
        <td colspan="6" height="20">
		</td>
	  </tr>
 
	
	
		
    
		
									<?php
										
										
										$rows = $wpdb->get_results("SELECT * FROM wpjb_job WHERE wpjb_job.is_active=1 AND wpjb_job.is_new=1 ORDER BY wpjb_job.id DESC limit 8" );

										foreach ( $rows as $row ) 
										{
																				
											echo " <tr ><td  valign=\"middle\"><b><a style='font-size:15px; text-decoration:none;' href =\"".site_url()."/tim-viec-lam/view/".$row->job_slug."\" target=_blank>".$row->job_title.'</a></b><br><i>'.$row->company_name.'</i> <hr size=1px color="#E3E9FC"/></td></tr>' ;
										}
										
										?>
											
									
							
					
		
		
	  
	   <tr>
        <td colspan="6" height="20">
		</td>
	  </tr>
</table>

			
		</div>
		</td>
        
      </tr>
	  
	   <tr>
        <td colspan="6" height="10">
		</td>
	  </tr>
	  
	   <tr>
        <td colspan="5" valign="middle" height="100">
			<div style="text-align:center;">
				<p>sagojo’s apps</p>
				<p><a href="https://play.google.com/store/search?q=sagojo&c=apps"><img title="Application for Android and IOS"  alt="Application for Android" width="160" height="52" src="<?php echo site_url()?>/wp-content/themes/responsive/images/logo_googleplay.png" /></a>&nbsp;&nbsp;&nbsp;<a href="https://itunes.apple.com/vn/app/horoscope/id862253396?mt=8&ign-mpt=uo%3D4"><img title="Application for IOS"  alt="Application for Android and IOS" width="160" height="52" src="<?php echo site_url()?>/wp-content/themes/responsive/images/logo_appstore.png" /></a></p>
			
			</div>
		
		</td>
        
      </tr>
	  
      
	  <tr>
		 <td colspan="5"> </td>
	  </tr>
	   <tr bgcolor="#808080">
         <td colspan="5" valign="middle" height="100"> 
				 <div style="text-align: center;">
						
							 <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
								 <tr> 
									<td valign="center" colspan="5" height="45"><a style="font-size:15px; color:#FFF;">Developed and operated by a team of Vietnamese and Japanese</a></td>
								</tr>
								  <tr valign="center" >
									<td width="80" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#014f8c; font-weight:bold; text-decoration:none;" title="About Us" href="http://www.sagojo.com" >About Us</a></td>
									<td width="100" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#014f8c; font-weight:bold; text-decoration:none;"  title="Contact Us" href="http://sagojo.com/for-employer/" >Contact Us</a></td>
									<td width="120" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#014f8c; font-weight:bold; text-decoration:none;" title="Terms Of User" href="http://sagojo.com/for-jobseeker/">Terms Of User</a></td>
									<td width="150" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#014f8c; font-weight:bold; text-decoration:none;" title="Private Statement" href="http://sagojo.com/freelance-page/" >Private Statement</a></td>
									<td width="80" align="left" valign="middle"><a target="_blank" style="font-size:16px; color:#014f8c; font-weight:bold; text-decoration:none;" title="Site Map" href="http://sagojo.com/vi/tim-viec-lam-online/blog/">Site Map</a></td>
								</tr>
								 <tr> 
									<td  valign="center" colspan="5" height="45"><a style="font-size:15px; color:#FFF;">Copyright © A-LINE ltd. and A-LINE Vietnam Co., Ltd.</a></td>
								</tr>
								<tr>
                            <td style="border-top: 1px solid #eee; border-bottom: 1px solid #eee; font-size: 12px; color: #999">
                                You received this email because you subscribed for it as {email}. If you'd like, you can <a target="_tab" href="{unsubscription_url}">unsubscribe</a>.
                            </td>
                        </tr>
							</table>
						
				 </div>
		 
		 </td>
       
      </tr>
      </tbody>
    </table>
</body>
</html>