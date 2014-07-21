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

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>


<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  	<tr> 
        <td width="20%" align="center" valign="top"><a target="_blank" href="http://sagojo.com"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/header.jpg" width="650"  alt="sagojo - Trang tuyển dụng việc làm" longdesc="http://sagojo.com" /></a></td>
      </tr>
  
      <tr>
        <td height="50" align="center" valign="middle" bgcolor="#738fe6" style="color:#FFF; border:2px solid #9eb2ee;"><h4 style="font-family:Arial, Helvetica, sans-serif; text-shadow: 0px 1px 1px;">Chúng tôi có chế độ <span style="color:#fff600;">ƯU ĐÃI</span> dành cho những người giới thiệu đăng tin</h4></td>
      </tr>
       
      <tr>
        <td align="center" valign="middle">
        
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  background="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/bg-n.png">
            <tr>
            <td height="50">&nbsp;</td>
          </tr>
       		<tr><td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="47%" height="50" align="center" valign="middle"  bgcolor="#738fe6"><h3 style="color:#FFF; font-family:Arial, Helvetica, sans-serif; text-shadow: 1px 1px 1px;">Dịch vụ HR Outsourcing</h3></td>
                    <td>&nbsp;</td>
                    <td width="47%" height="50" align="center" valign="middle"  bgcolor="#738fe6"><h3 style="color:#FFF; font-family:Arial, Helvetica, sans-serif; text-shadow: 1px 1px 1px;">Tuyển dụng trực tuyến</h3></td>
                  </tr>
                  <tr>
                    <td bordercolor="#d1eaff" bgcolor="#FFFFFF" style="border-bottom:2px solid #c6e6ff; border-left:2px solid #c6e6ff; border-right:2px solid #c6e6ff;"><p  style="color:#26587c; padding-left:20px; line-height: 26px;"><strong>* Tư vấn, cung cấp người lao động<br/>
                     * Tìm kiếm nhân tài<br/>
						* Rút ngắn thời gian tuyển dụng<br/>
						* Thuê ngoài dân sự<br/>
 						</strong></p>
                     </td>
                    <td width="6%">&nbsp;</td>
                    <td bgcolor="#FFFFFF" style="border-bottom:2px solid #c6e6ff; border-left:2px solid #c6e6ff; border-right:2px solid #c6e6ff;"><p style="color:#26587c; padding-left:20px;line-height: 26px;"><strong>* <span style="color:#F00">Miễn phí</span> đăng tin tại sagojo.com<br />
                      * Duyệt tin nhanh<br />
                      * Cơ hội tiếp cận ứng viên tài năng </strong></p></td> 

                  </tr>
                  <tr>
                    <td height="50"  bgcolor="#f2f2f2" align="center" valign="middle"><a href="http://sagojo.com/vi/for-employer/" style="background:url(<?php echo site_url()?>/wp-content/themes/responsive/images/partner/button.jpg) no-repeat; padding-top: 5px;padding-bottom: 10px;padding-left: 20px;padding-right: 20px; color: #FFF;font-size: 18px;text-decoration: none;  font-family:Arial, Helvetica, sans-serif;">Liên Hệ</td>
                    <td>&nbsp;</td>
                      <td height="50"bgcolor="#f2f2f2"  align="center" valign="middle"><a href="http://sagojo.com/vi/for-employer/" style="background:url(<?php echo site_url()?>/wp-content/themes/responsive/images/partner/button.jpg) no-repeat; padding-top: 5px;padding-bottom: 10px;padding-left: 15px;padding-right: 20px; color: #FFF;font-size: 18px;text-decoration: none;  font-family:Arial, Helvetica, sans-serif;">Đăng Tin</td>
                  </tr>
            </table></td></tr>
            
             <tr>
  	<td height="60" align="center" valign="bottom"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/soc-ngang-1.png" width="650px" height="30" /></td>
  
  </tr>
  <tr>
  	<td height="80">	
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="162.5" height="80" align="center" valign="middle"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/koinohana-logo.png" width="141" height="23" /></td>
                <td width="162.5" height="80" align="center" valign="middle"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/yahoo-logo.png" width="91" height="23" /></td>
                <td width="162.5" height="80" align="center" valign="middle"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/sakura-logo.png" width="136" height="28" /></td>
                <td width="162.5" height="80" align="center" valign="middle"><img src="<?php echo site_url()?>/wp-content/themes/responsive/images/partner/cushman-wakefield.png" width="99" height="26" /></td>
          </tr>
      </table>
    </td>
  </tr>
  <tr><td height="80" align="center" valign="middle" bgcolor="e9e9e9" >
  	<p style="color:#8b8b8b; font-family:Arial, Helvetica, sans-serif; line-height: 25px;"><span style="color:#8b8b8b;"><b>A-LINE Vietnam Co., Ltd</b></span><br/>
    Tell: <b>08-7309-1212</b> 		Fax: <b>08-7309-1213</b>  		Email:<b><a href="mailto:tthang@aline.jp">tthang@aline.jp</a></b><br/>
    801 ZEN plaza, 54-56 Nguyen Trai str., Ben Thanh ward, Dist 1, HCM city
	</p>
   </td></tr>
 <tr>
                            <td style="border-top: 1px solid #eee; border-bottom: 1px solid #eee; font-size: 12px; color: #999">
                                You received this email because you subscribed for it as {email}. If you'd like, you can <a target="_tab" href="{unsubscription_url}">unsubscribe</a>.
                            </td>
                        </tr>
            
        </table>
    </td>
  </tr>
</table>

</body>
</html>
