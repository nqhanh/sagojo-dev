<?php 

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Full Content Template
 *
   Template Name:  Tin Tuc HTML
 *
 * @file           tintuc.php
 * @package        Responsive 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/responsive/full-width-page.php
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */


get_header(); ?>

<div id="content" class="grid col-620 ">
		<div class="news-tintuc">
            <div class="tinmoi tu-van-huong-nghiep">
                <h1 id="tieu-de-news">Tin mới</h1>
                <div class="img-tincu">
                    <img src="<?php echo bloginfo('template_directory');?>/images/img-news/tinmoi.jpg" alt="<?php _e('Việc làm, viec lam, tìm việc làm, tim viec lam, công việc, cong viec, tuyển dụng, tuyen dung, tìm việc nhanh, viec nhanh') ?>" title="<?php _e('Gọi tên thành công - sagojo');?>"/>
                    <div id="content-child">
                        <h2 id="conten-child-tieude"><a href="#">Gọi tên Thành Công</a></h2>
                        <p>
                            Bạn còn nhớ ngày lễ tốt nghiệp đại học không? 
                            Khi tên bạn được xướng lên và thầy hiệu trưởng trao cho bạn tấm bằng tốt nghiệp quý giá, 
                            ít nhất bốn năm trời ròng rã, bao cố gắng nỗ lực và kết quả là đây...
                            
                        </p>
                    </div><!--End centent-child-->
                    <div id="tin-cu">
                        <ul id="ul-tincu">
                            <li><a class="icon" href="#">Gọi tên Thành Công</a></li>
                            <li><a class="icon" href="#">Chuỗi cung ứng tối ưu - Chi phí tối thiểu</a></li>
                            <li><a class="icon" href="#"> Tự tin như... Michael Jackson</a></li>
                        </ul>
                    </div><!--end-tincu-->
                </div>
               
            </div><!--tinmoi-->
            <div class="timviec tu-van-huong-nghiep">
                <h1 id="tieu-de-job">Tìm việc</h1>
                <div class="img-tincu">
                     <img src="<?php echo bloginfo('template_directory');?>/images/img-news/timviec.jpg" alt="<?php _e('Việc làm, viec lam, tìm việc làm, tim viec lam, công việc, cong viec, tuyển dụng, tuyen dung, tìm việc nhanh, viec nhanh') ?>" title="<?php _e('Diễn tập trước buổi phỏng vấn, tại sao không? - sagojo');?>"/>
                     <div id="content-child">
                
                        <h2 id="conten-child-tieude"><a href="#">Diễn tập trước buổi phỏng vấn, tại sao không?</a></h2>
                        <p>
                            Đôi khi có những sai lầm rất nhỏ trong hồ sơ xin việc của bạn lại là 
                            yếu tố lớn để nhà tuyển dụng (NTD) quyết định liệu có tuyển dụng bạn hay không. 
                            Vì vậy, hãy hoàn thiện hồ sơ của bạn hoàn hảo nhất...
                            
                        </p>
                    </div>
                    <div id="tin-cu">
                        <ul id="ul-tincu">
                            <li><a class="icon" href="#">Diễn tập trước buổi phỏng vấn, tại sao không?</a></li>
                            <li><a class="icon" href="#">Nắm cơ hội để vượt khủng hoảng</a></li>
                            <li><a class="icon" href="#">Cách viết thư cảm ơn sau phỏng vấn</a></li>
                        </ul>
                    </div><!--end-tincu-->
                </div>
                
            </div><!--timviec-->
            <div class="thangtien tu-van-huong-nghiep">
                <h1 class="tieu-de">Thăng tiến sự nghiệp</h1>
                <div class="img-tincu">
                    <img src="<?php echo bloginfo('template_directory');?>/images/img-news/SS-Moving-Forward.jpg" alt="<?php _e('Việc làm, viec lam, tìm việc làm, tim viec lam, công việc, cong viec, tuyển dụng, tuyen dung, tìm việc nhanh, viec nhanh');?>" title="<?php _e('Tập trung thế mạnh, để thăng tiến thành công - sagojo');?>"/>
                    <div id="content-child">
                    <h2 id="conten-child-tieude"><a href="#">Tập trung thế mạnh, để thăng tiến thành công</a></h2>
                        <p>
                            Trong công việc, chắc chắn có những nhiệm vụ bạn chẳng bao giờ thấy hứng thú và dù cố gắng
                             thế nào đi nữa thì bạn vẫn không thể làm tốt việc đó.
                            Những nhiệm vụ này rơi đúng vào vùng điểm yếu của bạn. 
                            Thay vì cố gắng hoàn thiện những điểm yếu, tại sao bạn không tập trung vào 
                            những việc mang lại sự hứng khởi cũng như phát huy tối đa khả năng của mình?
                        </p> 
                    </div>
                    <div id="tin-cu">
                         <ul id="ul-tincu">
                            <li><a class="icon" href="#">Đánh giá nghề nghiệp với phân tích SWOT</a></li>
                            <li><a class="icon" href="#">Dự tiệc công ty - bạn sẵn sàng chưa?</a></li>
                            <li><a class="icon" href="#"></a>Có nên nói thật về mức lương hiện tại?</li>
                        </ul>
                    </div>
                </div><!--end-tincu-->
                
                
            </div><!--thangtien-->
            <div class="thanhcong tu-van-huong-nghiep">
                <h1 class="tieu-de">Bài học thành công</h1>
                <div class="img-tincu">
                    <img src="<?php echo bloginfo('template_directory');?>/images/img-news/CHANGE-CAREER.jpg" alt="<?php _e('Việc làm, viec lam, tìm việc làm, tim viec lam, công việc, cong viec, tuyển dụng, tuyen dung, tìm việc nhanh, viec nhanh');?>" title="<?php _e('Cần chuẩn bị gì để chuyển ngành thành công? - sagojo');?>"/>
                    <div id="content-child">
                        
                        <h2 id="conten-child-tieude"><a href="#">Cần chuẩn bị gì để chuyển ngành thành công?</a></h2>
                        <p>
                            Là một nhân viên mẫn cán ngày ngày xách cặp đi làm, 
                            một ngày nọ bạn phát hiện ra công việc bấy lâu nay không phù hợp với mình, 
                            không hợp một chút nào cả. Bạn cảm thấy thật ngán ngẩm khi bước chân vào văn phòng mỗi ngày.
                            Muốn đổi việc lắm, nhưng lại ngại phải bắt tay làm lại từ đầu…
                        </p>
                    </div>
                    <div id="tin-cu">
                         <ul id="ul-tincu">
                            <li><a class="icon" href="#">HÃY THAY ĐỔI MỖI NGÀY!</a></li>
                            <li><a class="icon" href="#">NẾU CUỘC SỐNG ĐÁ CHO BẠN MỘT CÚ ...</a></li>
                            <li><a class="icon" href="#">BÀI HỌC VỀ SỰ  THÙ DAI</a></li>
                        </ul>
                    </div>
                </div><!--end-tincu-->
                
            </div><!--thanhcong-->
        
        </div><!--end news-tintuc--->
			
</div> <!-- end #content -->

<?php get_sidebar(); ?>        
<?php get_footer(); ?>