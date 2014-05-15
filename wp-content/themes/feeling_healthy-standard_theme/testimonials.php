<?php
/*
Template Name: Testimonials
*/
?>

<?php get_header(); ?>

<div id="standard_page">

	<?php echo get_the_post_thumbnail(); ?>	

	<div id="content">   	
	
	<?php
		global $post;
		$args = array( 'posts_per_page' => 100, 'post_type' =>'the_testimonials');
		$myposts = get_posts( $args );
		$i = 1;
		foreach( $myposts as $post ) :	setup_postdata($post); ?>
		<?php if($i == 1) echo "<div class='testimonial-new-line'>";  ?>
		<div class="testimonial-wrapper">
			<h2><?php the_title(); ?></h2>
			<?php the_excerpt(); ?>   
			<p><strong><?php echo get_post_meta($post->ID, '_testname', true) ?></strong></p>			
		</div>	
		<?php if($i == 3) echo "</div>";  ?>
		<?php if($i == 3){$i = 1;} else {$i++;} ?>
	<?php endforeach; ?>			

	</div>
 
</div>

<?php get_footer(); ?>