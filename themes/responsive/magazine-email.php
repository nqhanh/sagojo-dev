
<?php



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
    </head>
    <body style="background-color: #e5e5e5; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 14px; color: #666; margin: 0 auto; padding: 0;">
       <table width="680px" align="center" cellpadding="0" cellspacing="0" bgcolor="#f4f4f4" style="padding-left: 100px; padding-right: 100px;">
	   <tbody style="background: none repeat scroll 0 0 #FFFFFF;">
      <tr>
      
        <td colspan="5" height="150" style="font-size: 0;line-height: 0;" bgcolor="#21196A">
        <div style="padding-left: 10px;">
		
			<a href="[site_url]"><img style="padding-bottom: 20px;" src="[site_url]/wp-content/themes/responsive/core/images/default-logo.png" alt="Plum jobs, rewarding lives" width="300px" /></a>
			<a style="color: #FFF;font-size: 15px;float: left;">Job matching and Job auctioning service for freelancers, jobseekers, employers and agencies</a>
      	</div>
      	</td>
      
      </tr>
      <tr>
        <td colspan="5" bgcolor="#738FE6">
		<div >
						
						<ul style="margin-left: -30px;">

							<li style="display: inline-block; padding-right:20px"> <a title="Top page" style="font-size:15px; color:#FFF; font-weight: bold;" href="http://www.sagojo.com"> Top Page </a></li>
							<li style="display: inline-block; padding-right:20px " > <a title="For Employer" style="font-size:15px; color:#FFF; font-weight: bold;" href="http://sagojo.com/for-employer/"> For Employer </a></li>
							<li style="display: inline-block; padding-right:20px"> <a title="For JobSeeker" style="font-size:15px; color:#FFF; font-weight: bold;" href="http://sagojo.com/for-jobseeker/"> For JobSeeker </a></li>
							<li style="display: inline-block; padding-right:20px"> <a title="Job auction" style="font-size:15px; color:#FFF; font-weight: bold;" href="http://sagojo.com/freelance-page/"> Job auction </a></li>
							<li style="display: inline-block; "> <a title="Blog" style="font-size:15px; color:#FFF; font-weight: bold;" href="http://sagojo.com/tim-viec-lam-online/viec-lam-online/"> Blog</a></li>

						
						</ul>
						
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
                                while ( $the_query->have_posts() ) : $the_query->the_post(); 
									setup_postdata($post);
									if ($i==0){?>
                                    <tr style="font-size: 16px; color:#555555;">
                                        <?php //if (isset($theme_options['theme_thumbnails'])) {?>
                                        <td colspan="5"><a target="_blank"  href="<?php echo get_permalink(); ?>"><img style="float: left;" src="<?php echo newsletter_get_post_image($post->ID,'large-image'); ?>" alt="image" width="100%"></a></td>
                                    </tr>
                                    <tr style="font-size: 16px; color:#555555;">
                                        <?php //} ?>
                                        <td valign="top" colspan="5">
                                            <a target="_blank"  href="<?php echo get_permalink(); ?>" style="font-size: 18px;color:#014f8c; line-height: 26px"><?php the_title(); ?></a>
                                            <?php /*if (isset($theme_options['theme_excerpts']))*/ the_excerpt(); ?><div style="text-align: right;" ><a style="font-size:13px;" target="_blank"  href="<?php echo get_permalink(); ?>">(Đọc tiếp...)</a></div>
											
                                        </td>
                                    </tr>
                                    <tr><td colspan="5"></td></tr>
                                    <tr style="font-size: 16px; color:#555555;">
									<?php } elseif ($i==1 || $i==2) { //else if ($i !=0)?>
									
                                        <?php //if (isset($theme_options['theme_thumbnails'])) { ?>
                                        <td width="210px" valign="top" ><a target="_blank"  href="<?php echo get_permalink(); ?>"><img style="float: left;" src="<?php echo newsletter_get_post_image($post->ID,'small-image'); ?>" alt="image" width="100%"></a>
                                        <?php //} ?>
                                        <a target="_blank"  href="<?php echo get_permalink(); ?>" style="font-size: 18px;color:#014f8c; line-height: 26px"><?php the_title(); ?></a>
                                            <?php /*if (isset($theme_options['theme_excerpts']))*/ the_excerpt(); ?>
                                             
                                        </td>
                                    	<td width="15px" valign="top" ></td>
                                    
									<?php } elseif ($i==3) {?>
									<?php //if (isset($theme_options['theme_thumbnails'])) { ?>
                                        <td width="210px" valign="top" ><a target="_blank"  href="<?php echo get_permalink(); ?>"><img style="float: left;" src="<?php echo newsletter_get_post_image($post->ID,'small-image'); ?>" alt="image" width="100%"></a>
                                        <?php //} ?>
                                        <a target="_blank"  href="<?php echo get_permalink(); ?>" style="font-size: 18px;color:#014f8c; line-height: 26px"><?php the_title(); ?></a>
                                            <?php /*if (isset($theme_options['theme_excerpts']))*/ the_excerpt(); ?>
                                             
                                        </td>
								<?php } //end if ($i==0)
								$i++; endwhile; //end foreach ?>
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
      <tr >
	  
        <td  bgcolor="#F0F8FF">
        
		<div style="width: 680px; background:#F0F8FF;"> 
		
								<ul style="background:#F0F8FF; padding-top: 5px; padding-bottom: 5px;">
									<?php
										
									global $wpdb;
										$rows = $wpdb->get_results("SELECT * FROM wpjb_job ORDER BY wpjb_job.id DESC limit 8" );

										foreach ( $rows as $row ) 
										{
																				
											echo "<li style='float:left; border-bottom:1px dotted #e5e5e5; list-style-type:none; width:94%; padding-top:5px; padding-bottom:5px;'><b><a style='font-size:15px;' href =\"".site_url()."/jobs-board/view/".$row->job_slug."\" target=_blank>".$row->job_title.'</a></b><br><i>'.$row->company_name.'</i></li>' ;
										}
										
										?>
									<li style="clear:both; list-style-type:none"></li>
								</ul>		
									
							
					</div>
		
		</td>
        
      </tr>
	  
	   <tr>
        <td colspan="6" height="10">
		</td>
	  </tr>
	  
	   <tr>
        <td colspan="5" valign="middle">
			<div style="text-align:center;">
				<p>Color match game app and Horoscope app are available on Google play. It's free, Click now!!</p>
				<p><a href="https://play.google.com/store/search?q=sagojo&c=apps"><img title="Application for Android and IOS"  alt="Application for Android and IOS" width="160" height="52" src="[site_url]/wp-content/themes/responsive/core/images/app_and.png" /></a></p>
			
			</div>
		
		</td>
        
      </tr>
	  
      
	  <tr>
		 <td colspan="5"> </td>
	  </tr>
	   <tr bgcolor="#808080">
         <td colspan="5" valign="middle"> 
				 <div style="text-align: center;">
						<p style="font-size:15px; color:#FFF; padding-top: 30px;">Developed and operated by a team of Vietnamese and Japanese</p>
						<ul>

							<li style="display: inline-block;"> <a title="About Us" style="font-size:15px; color:#014f8c; font-weight: bold;" href="http://www.sagojo.com/?page_id=242&lang=vi"> About Us </a>|</li>
							<li style="display: inline-block;"> <a title="Contact Us" style="font-size:15px; color:#014f8c; font-weight: bold;" href="http://www.sagojo.com/?page_id=21&lang=vi"> Contact Us </a>|</li>
							<li style="display: inline-block;"> <a title="Terms Of User" style="font-size:15px; color:#014f8c; font-weight: bold;" href="http://www.sagojo.com/?page_id=245&lang=vi"> Terms Of Use </a>|</li>
							<li style="display: inline-block;"> <a title="Private Statement" style="font-size:15px; color:#014f8c; font-weight: bold;" href="http://www.sagojo.com/?page_id=258&lang=vi"> Privacy Statement </a>|</li>
							<li style="display: inline-block;"> <a title="Site Map" style="font-size:15px; color:#014f8c; font-weight: bold;" href="http://www.sagojo.com/?page_id=284&lang=vi"> Site Map</a></li>

						
						</ul>
						<p style="font-size:15px; color:#FFF; padding-bottom: 20px;">Copyright © A-LINE ltd. and A-LINE Vietnam Co., Ltd.</p>
				 </div>
		 
		 </td>
       
      </tr>
      </tbody>
    </table>
    </body>
</html>