<?php
/*
Template Name: Yellow
*/
?>

<?php get_header(); ?>

<div id="standard_page">

	<?php echo get_the_post_thumbnail(); ?>	

	<div id="content">   		

		<?php the_post(); ?>        

		<?php the_content(); ?>    

	</div>
 
</div>

<script>

$(document).ready(function(){
	$('body').addClass('yellow-body');
});

</script>

<?php get_footer(); ?>