
		<div class='freelance-single'>
			<div class="freelance-header">
				<h2><?php the_title(); ?></h2>		
			</div>

						
			<div class="entry-content post_content">
			
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wpfrl' ), 'after' => '</div>' ) ); ?>
			</div>
				
		<div class="dash"></div>
		
		<?php majormedia_posted_on(); ?> 

		<?php majormedia_content_nav( 'nav-below' ); ?>

		</div>

