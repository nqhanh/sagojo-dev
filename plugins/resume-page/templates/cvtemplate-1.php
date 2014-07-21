<section class="resume-wrap <?php echo $themeclass;?>" >
			<div class="resume-container">
				<div class="resume-inner">

					<?php do_action('ba_resume_page_inside_top_container'); //action ?>

					<!-- start resume header -->
					<header class="row resume-section-header">
						<div class="col-sm-3">
							<?php //the_post_thumbnail(array(400,400), array('class'=>'resume-avatar'));?>
							<img src="<?php echo $image;?>" width="400px">
						</div>
						<div class="re-banner">
							<h1 class="zmt resume-bio-title"><?php echo $name;?></h1>
							<?php if ($tagline): ?>
								<h2 class="zmt resume-bio-tag"><span><?php echo $tagline;?></span></h2>
							<?php endif; ?>
							</div>
						<div class="col-sm-7 resume-bio">
							
						
							<ul class="resume-bio-meta">
								<?php if ($email): ?>
									<li><a href="mailto:<?php echo $email;?>" class="resume-bio-email"><i class="resumecon resumecon-envelope"></i> <?php echo $email;?></a></li>
								<?php endif;
								if ($website): ?>
									<li><a href="<?php echo $website;?>" target="_blank" rel="nofollow" class="resume-bio-site"><i class="resumecon resumecon-globe"></i> <?php echo $website;?></a></li>
								<?php endif;
								if ($phone): ?>
									<li><i class="resumecon resumecon-phone-square"></i> <?php echo $phone;?></li>
								<?php endif; 
								if ($my_location): ?>
									<li><i class="resumecon resumecon-location-square"></i> <?php _e($my_location);?></li>
								<?php endif; 
								if ($salary): ?>
									<li><i class="resumecon resumecon-salary-square"></i> <?php _e($mysalary);?></li>
								<?php else : ?><li><i class="resumecon resumecon-salary-square"></i> <?php _e($mysalary);?></li>
								<?php endif;?>
							</ul>
						</div>
						<?php if ($twitter || $facebook || $github): ?>
							<div class="col-sm-2 resume-social-wrap tar">
								<ul class="resume-bio-social unstyled">
									<?php if ($twitter): ?>
										<li><a href="http://twitter.com/<?php echo $twitter;?>" target="_blank"><i class="resumecon resumecon-twitter-square"></i></a></li>
									<?php endif;
									if ($facebook): ?>
										<li><a href="http://facebook.com/<?php echo $facebook;?>" target="_blank"><i class="resumecon resumecon-facebook-square"></i></a></li>
									<?php endif;
									if ($github): ?>
										<li><a href="http://github.com/<?php echo $github;?>" target="_blank"><i class="resumecon resumecon-github-square"></i></a></li>
									<?php endif; ?>
								</ul>
							</div>
						<?php endif ;?>
					</header>
					<!-- end resume header -->

					<?php do_action('ba_resume_page_after_header'); //action ?>

					<!-- start main -->
					<main class="resume-section-main">

						<?php if (!$hide_objective) { ?>
							<!-- start objective -->
							<section class="row resume-objective-wrap">
								<!--<div class="col-sm-3">
									<h4 class="zmt resume-item-title"><?php echo $objective_title;?></h4>
								</div>-->
								<div class="resume-objective lead">
									<?php echo $objective_content;?>
								</div>
							</section>
							
							<!-- end objective -->
						<?php }

						do_action('ba_resume_page_after_objective'); //action


						if (!$hide_experience) { ?>
							<!-- start work experience wrap -->
							<section class="row resume-work-wrap">
							<blockquote>
								<div class="rs-title">
									<h4 class="zmt resume-item-title"><i class="resumecon resume-item-con"></i><?php _e($experience_title);?></h4>
								</div>
							</blockquote>
								<div class="rs-content">
									<?php 		
										$job = $experience;
										$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
										$job = nl2br($job);
										$find = array("</ul><br />", "</li><br />", "</ol><br />");
										$repl = array("</ul>", "</li>", "</ol>");
										echo str_replace($find, $repl, $job);
									?>									
								</div>
							</section>
							
							<!-- end work experience wrap -->
						<?php }

						do_action('ba_resume_page_after_experience'); //action

						if (!$hide_skills) { ?>
							<!-- start skillset wrap -->
							<section class="row resume-skillset-wrap">
							<blockquote>
								<div class="rs-title">
									<h4 class="zmt resume-item-title"><i class="resumecon resume-item-con"></i><?php echo _e($skills_title);?></h4>
								</div>
							</blockquote>
								<div class="rs-content">
									<?php 		
										$job = $kynang;
										$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
										$job = nl2br($job);
										$find = array("</ul><br />", "</li><br />", "</ol><br />");
										$repl = array("</ul>", "</li>", "</ol>");
										echo str_replace($find, $repl, $job);
									?>	
								</div>
							</section>
							
							<!-- end skillset wrap -->
						<?php }

						do_action('ba_resume_page_after_skillset'); //action

						if (!$hide_education) { ?>
							<!-- start education wrap -->
							<section class="row resume-education-wrap">
							<blockquote>
								<div class="rs-title">
									<h4 class="zmt resume-item-title"><i class="resumecon resume-item-con"></i><?php _e($education_title);?></h4>
								</div>
							</blockquote>
								<div class="rs-content">
									<?php 		
										$job = $education;
										$job = strip_tags($job, '<p><a><b><strong><em><i><ul><li><h3><h4><br>');
										$job = nl2br($job);
										$find = array("</ul><br />", "</li><br />", "</ol><br />");
										$repl = array("</ul>", "</li>", "</ol>");
										echo str_replace($find, $repl, $job);
									?>
								</div>
							</section>
							
							<!-- end education wrap -->
						<?php }

						do_action('ba_resume_page_after_education'); //action

						if (!$hide_github) { ?>
							<!-- start github activity stream -->
							<section class="row resume-github-wrap no-print">
							<blockquote>
								<div class="rs-title">
									<h4 class="zmt resume-item-title"><i class="resumecon resume-item-con"></i><?php echo $github_title;?></h4>
								</div>
							</blockquote>
								<div class="rs-content github-stream-wrap">
									<ul class="github-stream unstyled">
										<?php echo ba_resume_page_github_feed( $github , $excluded = array(), $count = 5);?>
									</ul>
								</div>
							</section>
							
							<!-- end github activity stream -->
						<?php }

						do_action('ba_resume_page_after_github'); //action

						if (!$hide_portfolio) { ?>
							<!-- start portfolio -->
							<section class="row resume-portfolio-wrap no-print">
							<blockquote>
								<div class="rs-title">
									<h4 class="zmt resume-item-title"><i class="resumecon resume-portfolio-con"></i><?php echo $portfolio_title;?></h4>
								</div>
							</blockquote>
								<div class="rs-content resume-porfolio">
									<?php echo ba_resume_page_portfolio($resume_ID);?>
								</div>
							</section>
							<!-- end portfolio -->
						<?php } ?>

					</main>
					<!-- end main -->
					<?php do_action('ba_resume_page_inside_bottom_container'); //action ?></a>
					<hr />
					<a href="http://www.sagojo.com"><img style="margin-top: -4px;" src="http://sagojo.com/wp-content/themes/responsive/core/images/default-logo.png" width="66" height="22" alt="Job vacancies, job search, find more jobs with top recruiters| sagojo.com"></a><?php _e('[:en]Job matching and Job auctioning service for freelancers, jobseekers, employers and agencies.[:vi]Cung cấp và đấu giá việc làm cho freelancer, người tìm việc và nhà tuyển dụng.[:ja]Job matching and Job auctioning service for freelancers, jobseekers, employers and agencies.');?>
				</div>
			</div>
		</section>