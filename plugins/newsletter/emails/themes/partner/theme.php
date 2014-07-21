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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <!-- Not all email client take care of styles inserted here -->
        <style type="text/css" media="all">
            a {
                text-decoration: none;
                color: <?php echo $color; ?>;
            }
        </style>
    </head>
    <body style="background-color: #FFF; font-family: Helvetica Neue, Helvetica, Arial, sans-serif; font-size: 14px; color: #000; margin: 0 auto; padding: 0;">
        <table align="center" width="660" border="0" cellpadding="0" cellspacing="0" style="margin:0 auto; border: 1px solid #f0f0f0;">
        
            <tr bgcolor="#000099" style="box-shadow:0px 20px 40px 0px rgba(255,255,255, 0.1) inset;">
                <td height="160px;" colspan="2">
                <div style="color:#FFF;" > 
               	  <img  alt="Công ty tuyển dụng - sagojo" title="Công ty tuyển dụng - sagojo" src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/banner.png" />
                </div>
                
                </td>
            </tr>
            <tr bgcolor="#738FE6">
            		<td colspan="5" bgcolor="#738FE6" height="50">
		<div >
        <table width="660" border="0">
              <tr >
                <td width="132" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#FFF; font-weight:bold; " title="Top page" href="http://www.sagojo.com" >Top page </a></td>
                <td width="132" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#FFF; font-weight:bold;" title="For Employer" href="http://sagojo.com/for-employer/" >For Employer</a></td>
                <td width="132" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#FFF; font-weight:bold;" title="For JobSeeker" href="http://sagojo.com/for-jobseeker/">For JobSeeker</a></td>
                <td width="135" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#FFF; font-weight:bold;" title="Job auction" href="http://sagojo.com/freelance-page/" >Job auction</a></td>
                <td width="132" align="left" valign="middle"><a target="_blank" style="font-size:16px; color:#FFF; font-weight:bold;" title="Blog" href="http://sagojo.com/vi/tim-viec-lam-online/blog/">Blog</a></td>
          </tr>
		</table>

			
						
				 </div>
        
        	
        
        </td>
            
            </tr>
			
            <tr> 
            	<td colspan="2" height="10px">
            	
            
           	 	</td>
          </tr>
            <tr>
            	
            	<td height="140" colspan="2" valign="middle">
                
                <table width="630" border="0" align="center" cellpadding="0" cellspacing="0" style="font-size:16px;">
                      <tr>
                        <td><p>Kính gửi Quý <b>{name}</b><p></td>
                      </tr>
                      <tr >
                        <td >Chúng tôi là công ty tuyển dụng nhân sự đến từ Nhật Bản - Cung cấp, đấu giá việc làm cho freelancer và người tìm việc.</td>
                      </tr>
                      <tr>
                        <td align="center"><h1 style="color:#00A500; font-size:35px; font-family: verdana,arial;">Bạn đang tìm người tài?</h1></td>
                      </tr>
                      <tr>
                        <td> <span style="font-size:20px;">Hãy</span> để <span style="color:#F15A24;"><a style="color:#F15A24; text-decoration:underline" href="http://sagojo.com/jobs-board/employer/new/" ><b>sagojo</b></a></span> giúp bạn thực hiện quá trình tuyển dụng nhanh và hiệu quả hơn.</td>
                      </tr>
                    </table>

                </td>
          </tr>
            <tr> <td colspan="2">
            <div style="width: 95%;margin: auto;"><hr size="3px" color="#000099" /></div>
            
            </td></tr>
            
            
            <tr> 
            	<td colspan="2">
            	
            
           	 	</td>
          </tr>
             
              <tr> 
            <td colspan="2"></td>
            </tr>
            <tr height="300"> 
            
            	<td width="300" align="center" valign="middle">
            		
            		<div>
                   	  <img title="Tại sao chọn chúng tôi?" src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/partner_content.png" width="281" height="258" align="middle" style=" text-align:center; border:1px solid #DEE4E7;"/>
                    </div>
           	 	</td>
                
                <td width="300" align="center" valign="middle"> 
                <div style="color:#000; padding-left: 10px; font-size:16px;">
                
                <table width="360" border="0">
                <tr>
                    <td align="center" valign="top" ><span style="color:#F15A24; font-size: 23px;">Tại sao chọn chúng tôi?</span></td>
                  </tr>
                  <tr>
                    <td><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/check-icon1.png" height="21" width="21"/><a style="" > Cung cấp dịch vụ đa dạng với nhiều tiện ích cho nhà tuyển dụng và người tìm việc</a></td>
                  </tr>
                  <tr>
                    <td><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/check-icon1.png" height="21" width="21"/><a style="" > Giao diện web thân thiện cho người sử dụng với 3 ngôn ngữ chính: tiếng Việt, tiếng Anh và tiếng Nhật.</a></td>
                  </tr>
                  <tr>
                    <td><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/check-icon1.png" height="21" width="21"/><a style="" > Nguồn nhân lực dồi dào và tiềm năng</a></td>
                  </tr>
                  <tr>
                    <td> <img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/check-icon1.png" height="21" width="21"/><a style="" >Tin tuyển dụng sẽ có mặt trên website, facebook và newsletters cho người tìm việc mỗi ngày.</a></td>
                  </tr>
                  <tr>
                    <td> <img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/check-icon1.png" height="21" width="21"/><a style="" > Đội ngũ nhân viên chuyên nghiệp, đầy nhiệt huyết</a></td>
                  </tr>
                </table>
                </div>
                </td>
          </tr>
             
             
             <tr> <td colspan="2">
            	 <div style="width: 95%;margin: auto;"><hr size="3px" color="#000099" /></div>
            
            </td></tr>
             <tr> <td colspan="2">
            	
            
            </td></tr>
            <tr> <td height="109" colspan="2">
            	<div style="padding-left:15px; text-align:center;">
               		<h2> Tất cả dịch vụ của chúng tôi hoàn toàn <span style="color:#F15A24; font-size:20px;"> MIỄN PHÍ!!!</span></h2>
                	<p style="text-align:center"><a target="_blank" href="http://sagojo.com"> <img title="Đăng ký miễn phí!!!" src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/dangky.png"/></a></p>
                    
                    <div style="clear:both;"></div>
                </div>
            
</td></tr>
            <tr> <td colspan="2">
            	
            
            </td></tr>
             <tr> <td colspan="2">
            	 <div style="width: 95%;margin: auto;"><hr size="3px" color="#000099" /></div>
            
            </td></tr>
            
            <tr>
        <tr>
        <td colspan="5" valign="middle" height="100">
			<div style="text-align:center;">
				<p>sagojo’s apps</p>
				<p><a href="https://play.google.com/store/search?q=sagojo&c=apps"><img title="Application for Android and IOS"  alt="Application for Android" width="160" height="52" src="<?php echo site_url()?>/wp-content/themes/responsive/images/logo_googleplay.png" /></a>&nbsp;&nbsp;&nbsp;<a href="https://itunes.apple.com/vn/app/horoscope/id862253396?mt=8&ign-mpt=uo%3D4"><img title="Application for IOS"  alt="Application for Android and IOS" width="160" height="52" src="<?php echo site_url()?>/wp-content/themes/responsive/images/logo_appstore.png" /></a></p>
			
			</div>
		
		</td>
        
      </tr>
            <tr bgcolor="#808080">
   <td colspan="2" valign="middle" height="150"> 
				 <div style="text-align: center;">
						
                        
                   	    <table width="530" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr> 
								<td colspan="5" height="45"><a style="font-size:15px; color:#FFF;">Developed and operated by a team of Vietnamese and Japanese</a></td>
							</tr>
                              <tr >
                                <td width="80" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#014f8c; font-weight:bold;" title="About Us" href="http://www.sagojo.com" >About Us</a></td>
                                <td width="100" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#014f8c; font-weight:bold;"  title="Contact Us" href="http://sagojo.com/for-employer/" >Contact Us</a></td>
                                <td width="120" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#014f8c; font-weight:bold;" title="Terms Of User" href="http://sagojo.com/for-jobseeker/">Terms Of User</a></td>
                                <td width="150" align="center" valign="middle"><a target="_blank" style="font-size:16px; color:#014f8c; font-weight:bold;" title="Private Statement" href="http://sagojo.com/freelance-page/" >Private Statement</a></td>
                                <td width="80" align="left" valign="middle"><a target="_blank" style="font-size:16px; color:#014f8c; font-weight:bold;" title="Site Map" href="http://sagojo.com/vi/tim-viec-lam-online/blog/">Site Map</a></td>
							  </tr>
							  <tr> 
								<td colspan="5" height="45"><a style="font-size:15px; color:#FFF;">Copyright © A-LINE ltd. and A-LINE Vietnam Co., Ltd.</a></td>
							</tr>
                        </table>
               
				 </div>
		 
		 </td> 
         </tr>
        </table>
    </body>
</html>