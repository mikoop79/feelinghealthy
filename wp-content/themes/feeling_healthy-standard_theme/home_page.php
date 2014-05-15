<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<div id="landing_page">

	<!-- FOR THE SLIDER -->
		<div id="slider-wrapper">

		<div id="slider">
		<div class="subscribe-panel"><a id="click-to-subscribe" onclick="openModal()">Sign up to our latest newsletter and offers</a></div>		
		<ul>
			<?php
				global $post;
				$args = array( 'posts_per_page' => 10, 'post_type' =>'intro_slides');
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) :	setup_postdata($post); ?>
				<li>
				<a href="<?php echo get_post_meta($post->ID, '_slidelink', true) ?>">
					<?php echo get_the_post_thumbnail(); ?>						
				</a>
				</li>
			<?php endforeach; ?>	
				
		</ul>	
		
		</div>
		</div>

		
	<div id="call-to-actions">
		<a href="/services/massage" class="massage">	
			<h2>Massage</h2>
		</a>
		<a href="/services/naturopathy" class="naturopathy">	
			<h2>Naturopathy</h2>
		</a>
		<a href="/services/therapy" class="therapy">	
			<h2>Therapy</h2>
		</a>
		<a href="/services/healthy-seminars" class="seminars">	
			<h2>Healthy Seminars</h2>
		</a>
	</div>

	<div id="landing_page-content">

		<?php the_post(); ?>
		<?php the_content(); ?>    

	</div>

</div>


<script type="text/javascript">

$(document).ready(function(){
	
	/* ACTIVATES SLIDER */
	$('#slider').easySlider(); 

	/* REMOVES CURSOR FOR EMPTY LINKS */
	$('#slider ul li a').each(function(){
		var theLink = $(this).attr('href');
		if (theLink == ""){
			$(this).addClass('no-cursor');
		}
	}); 

	
	var startRego = setTimeout (
	function(){
		showModalWindow();
	}, 3000);

	/* CLOSE SUBSCRIBE FORM */
	$('.subscribe-close').click(function(){
		$('body').css({'overflow':'visible'});
		$('#newsletter-modal').fadeOut(function(){
			$('#newsletter-modal-veil').fadeOut();
		});
		clearInterval(hideModal);
	});

	$('#newsletter-modal-veil').click(function(){
		$('body').css({'overflow':'visible'});
		$('#newsletter-modal').fadeOut(function(){
			$('#newsletter-modal-veil').fadeOut();
		});	
			
	});

	$('#gform_submit_button_6').click(function(){
		if ($('.newsletters-acknowledgement').is(":visible")) {
			//showForm();
		} 

		console.log("submit");
	})
	
	

});
	
</script>
 
<?php get_footer(); ?>