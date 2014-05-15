<?php
// HANDLE EMAIL FROM 
function res_fromemail($email) {
    $wpfrom = get_option('admin_email');
    return $wpfrom;
} 
function res_fromname($email){
    $wpfrom = get_option('blogname');
    return $wpfrom;
}
add_filter('wp_mail_from', 'res_fromemail');
add_filter('wp_mail_from_name', 'res_fromname');
// GET THE PAGE NUMBER
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , 'your-theme') . get_query_var('paged');
    }
}
//
//
//
//
// EXCERPT
//
function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '"> ...read more</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );
//
//
//
//
// SUPPORT THUMBNAILS
//
add_theme_support( 'post-thumbnails' );
//
//
//
//
// LOGIN LOGO
//
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_bloginfo('template_directory').'/images/logo-feeling_healthy-login.png) !important; 
	height: 146px!important; background-size: 150px 146px!important;}
	body, html { background-color: #f7bf2a;!important; }
	body.login {color: #f7bf2a!important; background-color: #f7bf2a;!important;}
	#backtoblog {display: none;}
	.login #nav{ margin-left:-5px;}
	.login #nav a{color: #21759B!important; }
	.login #nav a:hover{color: #BE5B00!important;}
	#nav{ text-shadow:none;}
	form { -moz-border-radius: 0; -moz-box-shadow: none; border: 0!important;}
	.login form {box-shadow: none!important; padding: 23px 8px 20px; margin-left:3px!important;}
	#login{ background-color: #ffffff;
    		border:0;
		color: #777!important;
    		margin: 7em auto;
    		padding: 25px 30px 35px 25px;
    		width: 320px;
		border-radius: 50px;
		-moz-box-shadow: 0 0 10px #888;
		-webkit-box-shadow: 0 0 10px #888;
		box-shadow: 0 0 10px #888;
		}
	.wp-core-ui .button-primary{
		background-color: #f7bf2a;
    		background-image: linear-gradient(to bottom, #f7bf2a, #dcab29);
    		border:  #c89b23 solid 1px;
		color: #444;
		-moz-box-shadow: 0 0 0px #888;
		-webkit-box-shadow: 0 0 0px #888;
		box-shadow: 0 0 0px #888;		
		}
	.wp-core-ui .button-primary:hover{
		background-color: #f7bf2a;
    		background-image: linear-gradient(to bottom, #f9cd59, #dcab29);
    		border: #c89b23 solid 1px;
		color: #777;
		-moz-box-shadow: 0 0 0px #888;
		-webkit-box-shadow: 0 0 0px #888;
		box-shadow: 0 0 0px #888;
		}
    </style>';
}
add_action('login_head', 'my_custom_login_logo');
// CSS ADMIN AREA
function custom_colors() {
   echo '';
}
add_action('admin_head', 'custom_colors');
// REMOVE UPDATE INFO
// Removing the "Please Update Now" notice for non-admin users
if ( !current_user_can( 'edit_users' ) ) {
    add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
    add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
    add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );
}
// CHANGE LOGIN LOGO URL 
function change_wp_login_url() {
        echo bloginfo('index.php');
}
add_filter('login_headerurl', 'change_wp_login_url');
// REMOVE FROM wp-head()
remove_action('wp_head', 'rsd_link');
//
//
//
// INTRO SLIDES - CUSTOM POST TYPE
//
//
//
add_action( 'init', 'my_custom_post_intro_slides' );
function my_custom_post_intro_slides() {
	$labels = array(
		'name'               => _x( 'Intro Slides', 'post type general name' ),
		'singular_name'      => _x( 'Intro Slides', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Slide' ),
		'add_new_item'       => __( 'Add New Slide' ),
		'edit_item'          => __( 'Edit Slide' ),
		'new_item'           => __( 'New Slide' ),
		'all_items'          => __( 'All Slides' ),
		'view_item'          => __( 'View Slides' ),
		'search_items'       => __( 'Search Slides' ),
		'not_found'          => __( 'No slides found' ),
		'not_found_in_trash' => __( 'No slides found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Intro Slides'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the initial slides when you first come to the site.',
		'public'        => true,
		'menu_position' => 7,
		// Not adding thumbnails removes 'featured image' this means we just have 'team photo' - nice
		'supports'      => array( 'title', 'thumbnail'),
		'has_archive'   => true
	);
	register_post_type( 'intro_slides', $args );	
}
add_action( 'init', 'my_custom_post_intro_slides' );
//
//
//
//
//
// CUSTOM META BOX FOR INTRO PAGE SLIDES
//
// ADD IT!
add_action( 'admin_init', 'add_intro_slides_metaboxes' );

function add_intro_slides_metaboxes() {
	add_meta_box('intro_slides_metabox', 'Slide Link', 'intro_slides_metabox_id', 'intro_slides', 'normal', 'high');
}
// ADDS CONTENT!
function intro_slides_metabox_id() { 
	global $post;
	
	// GET DATA IF ALREADY ENTERED
	$slidelink = get_post_meta($post->ID, '_slidelink', true);
	
	// OUT INPUTS & LABELS	
	
	echo '<div class="inside" style="padding: 5px">';
	echo '<label>Slide Link </label>';
	echo '<input type="textarea" name="_slidelink" value="' . $slidelink  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px">Put in the full path to the page - http://feelinghealthy.com.au/...</em>';
	echo '</div>';
}

// SAVE IT!

function save_add_intro_slides_metaboxes($post_id, $post) {
	
	// USER AUTHORISATION
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// THE INPUTS		
	$events_meta['_slidelink'] = $_POST['_slidelink'];
	
	// GRUNT WORK - NO NEED TO MODIFY!
	
	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value); 
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else { 
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'save_add_intro_slides_metaboxes', 1, 2); // save the custom fields
//
//
// TESTIMONIALS - CUSTOM POST TYPE
//
add_action( 'init', 'my_custom_post_testimonials' );
function my_custom_post_testimonials() {
	$labels = array(
		'name'               => _x( 'Testimonials', 'post type general name' ),
		'singular_name'      => _x( 'Testimonial', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'Testimonial' ),
		'add_new_item'       => __( 'Add New Testimonial' ),
		'edit_item'          => __( 'Edit Testimonials' ),
		'new_item'           => __( 'New Testimonial' ),
		'all_items'          => __( 'All Testimonials' ),
		'view_item'          => __( 'View Testimonials' ),
		'search_items'       => __( 'Search Testimonials' ),
		'not_found'          => __( 'No Testimonials found' ),
		'not_found_in_trash' => __( 'No ClTestimonialsients found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Testimonials'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds the initial slides when you first come to the site.',
		'public'        => true,
		'menu_position' => 7,
		'supports'      => array( 'title', 'editor'),
		'has_archive'   => true
	);
	register_post_type( 'the_testimonials', $args );	
}
add_action( 'init', 'my_custom_post_testimonials' );
// CUSTOM META BOX FOR TESTIMONIALS
//
// ADD IT!
add_action( 'admin_init', 'add_testimonials_metaboxes' );

function add_testimonials_metaboxes() {
	add_meta_box('testimonials_metabox', 'Testimonial Details', 'testimonials_metabox_id', 'the_testimonials', 'normal', 'high');
}
// ADDS CONTENT!
function testimonials_metabox_id() { 
	global $post;
	
	// GET DATA IF ALREADY ENTERED
	$testname = get_post_meta($post->ID, '_testname', true);
	
	// OUT INPUTS & LABELS	
	
	echo '<div class="inside" style="padding: 5px">';
	echo '<label>Their Name </label>';
	echo '<input type="textarea" name="_testname" value="' . $testname  . '" class="widefat" />';
	echo '<em class="howto" style="margin-bottom: 25px"></em>';
	echo '</div>';
}

// SAVE IT!

function save_add_testimonials_metaboxes($post_id, $post) {
	
	// USER AUTHORISATION
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// THE INPUTS		
	$events_meta['_testname'] = $_POST['_testname'];
	
	// GRUNT WORK - NO NEED TO MODIFY!
	
	foreach ($events_meta as $key => $value) { 
		if( $post->post_type == 'revision' ) return; 
		$value = implode(',', (array)$value); 
		if(get_post_meta($post->ID, $key, FALSE)) { 
			update_post_meta($post->ID, $key, $value);
		} else { 
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); 
	}
}
add_action('save_post', 'save_add_testimonials_metaboxes', 1, 2); // save the custom fields
//
//
//
//
//SECONDARY FEATURED IMAGE
//
//
if (class_exists('MultiPostThumbnails')) {
	// SETS FOR EACH SIGNIFICANT IMAGES ON THE WORK
	new MultiPostThumbnails(
		array(
			'label' => 'Banner Advert',
			'id' => 'banner1',
			'post_type' => 'page'
		)
	);
}
//
//
//
//
// REMOVE JQUERY
wp_deregister_script('jquery');
//
//
//
//
// KANDAN DASHBOARD BOX
//
add_action('wp_dashboard_setup', 'designed_by_kandan_dashboard'); 
function designed_by_kandan_dashboard() {
global $wp_meta_boxes;
wp_add_dashboard_widget('custom_help_widget', 'Designed by Kandan', 'custom_dashboard_help');
}
function custom_dashboard_help() {
echo '<div style="background-image:url('.get_bloginfo('template_directory').'/images/kandan-logo.jpg); float:right; width: 111px; height: 75px;"></div>';
echo '<p style="padding-top: 5px;">31 Ross Street<br />';
echo 'South Melbourne<br />';
echo 'VIC<br />';
echo '3205</p>';
echo '<p>www.kandan.com.au</p>';
echo '<p>Thanks for using Kandan, for support or any enquiries <a href="http://www.kandan.com.au" target="_blank">please click here</a>.</p>';
}
?>