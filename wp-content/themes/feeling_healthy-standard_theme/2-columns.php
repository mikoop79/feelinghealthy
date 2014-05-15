<?php
/*
Template Name: 2 Columns Advert
*/
?>

<?php get_header(); ?>

<div id="standard_page">

	<?php echo get_the_post_thumbnail(); ?>	

	<div id="content">  				

		<?php the_post(); ?>        

		<?php the_content(); ?>   
		
		<div class="the_advert">
			<a href="/free-age-check">
			<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'banner1'); endif; ?>
			</a>
		</div>
	</div>
 
</div>

<?php get_footer(); ?>