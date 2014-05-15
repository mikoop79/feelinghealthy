<?php get_header(); ?>

<div id="testimonial-page">

<div id="post_page">
	
	<?php echo get_the_post_thumbnail(30); ?>

	<div id="content">			

		<h2><?php the_title(); ?></h2>         

		<?php the_post(); ?>        

		<?php the_content(); ?>   

		<p><strong><?php echo get_post_meta($post->ID, '_testname', true) ?></strong></p>	

		<div id="more_back-buttons">
			<?php if(function_exists('wp_paginate')) { wp_paginate();} ?>			
			<span class="prev"><?php previous_post('%','< Previous Testimonial', 'no'); ?></a></span>
			<span class="next"><?php next_post('%','Next Testimonial >', 'no'); ?></a></span>
		</div>	 		
	</div>
 
</div>

</div>

<?php get_footer(); ?>