<?php 
include(TEMPLATEPATH.'/include/menus.php');
include(TEMPLATEPATH.'/include/json-custom.php');
include(TEMPLATEPATH.'/include/shortcode-custom.php');
include(TEMPLATEPATH.'/sitemap/sitemap-loader.php');
include(TEMPLATEPATH.'/hcfunction/update-modifile-be.php');
add_theme_support( 'post-thumbnails', array('post','page','article','round_up','single_reviews','informational_posts','coupon' ) );
/* Script Admin */
function my_script() { ?>
	<style type="text/css">
		#dashboard_primary,#icl_dashboard_widget,
		#dashboard_right_now #wp-version-message,#wpfooter{
			display:none;
		}
		#menu-pages {
			border-top:2px solid #fff !important;
			margin-top:20px !important;
		}
		#menu-posts-coupon {
			border-bottom:2px solid #fff !important;
			margin-bottom:20px !important;
		}
	</style>
	<script>
	jQuery(function($) {
		
	});
	</script>
<?php }
add_action( 'admin_footer', 'my_script' );
function custom_style_login() {
	?>
    <style type="text/css">
		.login h1 a {
			background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/logo.png");
			background-size: 100% auto;
			height: 60px;
			width: 200px;
		}
		.wp-social-login-provider-list img {
			max-width:100%;
		}
	</style>
<?php }
add_action( 'login_head', 'custom_style_login' );
/* add css, jquery */
function theme_mcs_scripts() {
	/* general css */
	wp_enqueue_style( 'style-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome.css','','1.2.1' );
	wp_enqueue_style( 'style-main', get_template_directory_uri() . '/assets/scss/main.css','','2.5.7' );
	wp_enqueue_style( 'style-custom', get_template_directory_uri() . '/assets/css/custom.css','','2.0.6' );
	wp_enqueue_style( 'main-style', get_stylesheet_uri(),'','1.1.4' );
}
add_action( 'wp_enqueue_scripts', 'theme_mcs_scripts' );
/* register page option ACF */
if( function_exists('acf_add_options_page') ) {
	$parent = acf_add_options_page( array(
		'page_title' => 'Website Option',
		'menu_title' => 'Website Option',
		'icon_url' => 'dashicons-image-filter',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Option',
		'menu_title' 	=> 'Option',
		'parent_slug' 	=> $parent['menu_slug'],
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Sitemap',
		'menu_title' 	=> 'Sitemap',
		'parent_slug' 	=> $parent['menu_slug'],
	));
}
//add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	show_admin_bar(false);
}
function remove_admin_login_margin() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_margin');
/* Hide editor not use */
add_action( 'admin_init', 'hide_editor_not_use' );
function hide_editor_not_use() {
	if(isset($_GET['post']) && $_POST['post_ID']) {
		$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
		if( !isset( $post_id ) ) return;

		$template_file = get_post_meta($post_id, '_wp_page_template', true);

		if($template_file == 'template/home.php'){
			remove_post_type_support('page', 'editor');
		}
	}
}
/* avatar default */
function avatar_show($img) {
	if(!$img || $img == '' || $img == null) $img = get_field('avatar_default','option');
	return $img;
}

/* Order post menu admin */
function leea_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;

    return array(
        'index.php',
        'edit.php?post_type=page',
        'edit.php',
        'edit.php?post_type=news',
        'edit.php?post_type=comparison',
        'edit.php?post_type=single_reviews',
        'edit.php?post_type=round_up',
        'edit.php?post_type=informational_posts',
        'edit.php?post_type=coupon',
		'edit.php?post_type=coupon_code',
		'edit.php?post_type=interactive-post',
		'edit.php?post_type=feed_custom',
        'edit.php?post_type=article',
        'edit.php?post_type=verified_sources',
        'edit.php?post_type=gp_elements',
        'edit.php?post_type=wpcd_coupons',
    );
}
add_filter( 'custom_menu_order', 'leea_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'leea_custom_menu_order', 10, 1 );
/* Update date when publish post */
function post_unpublished( $new_status, $old_status, $post ) {
    if ( $old_status == 'future'  &&  $new_status == 'publish' ) {
       $update_post = array(
	        'ID' => $post->ID,
	        'post_modified' => $post->post_date
	    );
	    wp_update_post( $update_post );
    }
}
add_action( 'transition_post_status', 'post_unpublished', 10, 3 );
?>