<?php
/*
Template Name: 3 Columns Only
*/
?>

<?php get_header(); ?>

<div id="three-columns-only">

<div id="standard_page">

	<?php echo get_the_post_thumbnail(); ?>	

	<div id="content">   	

		<?php the_post(); ?>        

		<?php the_content(); ?>   			

	</div>
 
</div>

</div>

<?php get_footer(); ?>