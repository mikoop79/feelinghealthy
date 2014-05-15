<?php ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8"> 
<title>
<?php
        if ( is_single() ) { bloginfo('name'); print ' | '; single_post_title(); }       
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { bloginfo('name'); print ' | '; single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ', Not Found'; }
        else { bloginfo('name'); wp_title(' | '); get_page_number(); }
?>
</title>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/print.css" media="print" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts.js"></script>

<?php wp_head(); ?>
 
</head> 

<body> 

<div id="frame">

<div id="wrapper">   
	
	<div id="header">	
		<div id="primary_nav">
			<?php wp_nav_menu( $args ); ?> 
		</div>

		<div id="social-media-icons">			
			<a href="http://www.facebook.com/pages/Feeling-Healthy-Wellness-Centre/162907937082671" target="_blank" class="facebook"></a>
			
			<!-- <a href="" class="twitter"></a>
			<a href="" target="_blank" class="linkedin"></a>
			<a href="" class="rss"></a>
			<a href="" class="flickr"></a>
			<a href="" class="youtube"></a> -->
		</div>
	</div>