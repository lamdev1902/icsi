<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$curauth = $curauth->data;
$userid = $curauth->ID;
$disible_ap = get_field('disible_ap','user_'.$userid);
$deactivate_author = get_field('deactivate_author','user_'.$userid);
if($deactivate_author == true) {
	global $wp_query;
	$wp_query->set_404();
	status_header( 404 );
	get_template_part( 404 ); 
	exit();	
}
if($disible_ap == true) wp_redirect(get_permalink(905));
$check = false;
if(get_field('user_exl','user_'.$userid) !='' || get_field('user_memberships','user_'.$userid) !=''  || get_field('user_anp','user_'.$userid) !='') $check = true;
get_header(); ?>
<main class="author-container">
	<div class="breadcrumbs-nav">
		<div class="container">
		<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
		?>
		</div>
	</div>
	<div class="container">
		<div class="author-content">
			<div class="author-info">
				<?php $avt = get_field('user_avatar','user_'.$userid); 
				?>
				<img src="<?php echo avatar_show($avt['url']); ?>" alt="<?php echo $curauth->display_name; ?>" class="author-img">
				<h1><?php echo $curauth->display_name; ?></h1>
				<?php 
				function socials_link($link) {
					if (str_contains($link, 'https')) return $link;
					else return 'https://'.$link;
				}
				$usocials_list = get_field('usocials_list_copy','user_'.$userid);
				if($usocials_list) { ?>
				<ul>
					<?php foreach($usocials_list as $us) { ?>
					<li>
						<a href="<?php echo socials_link($us['link']); ?>" target="_blank"><img src="<?php echo $us['icon']['url']; ?>" alt="<?php echo $us['icon']['alt']; ?>"></a>
					</li>
					<?php } ?>
				</ul>
				<?php } ?>
			</div>
			<?php if(get_field('user_exl','user_'.$userid)) { ?>
			<div class="author-content-link">
				<ul>
					<?php $user_exl = get_field('user_exl','user_'.$userid);
					if($user_exl) { 
					foreach($user_exl as $ue) { ?>
					<li><a class="button-blue-shadow-black"><?php echo $ue['expertise']; ?></a></li>
					<?php } } ?>
				</ul>
			</div>
			<?php } ?>
			<p class="des"><?php echo get_user_meta($userid,'description',true); ?></p>
			<?php $uscl = get_field('user_content_list','user_'.$userid);
			if($uscl) { 
			foreach($uscl as $us) {
			?>
			<div class="exp-edu">
				<div class="title">
					<h2><?php echo $us['title']; ?></h2>
				</div>
				<?php echo $us['cont']; ?>
			</div>
			<?php } } ?>
		</div>
	</div>
	<div class="more-post-list">
		<div class="container">
			<h2 class="text-center"><?php echo __('More Post By Author','health_theme'); ?></h2>
			<ul class="news-list list-flex">
				<?php
		          $args = array(
		            'post_type' => array('post','informational_posts','round_up','single_reviews','coupon','interactive-post'),
		            'posts_per_page' => 4,
		            'author' => $userid
		          );
		          $the_query = new WP_Query( $args );
		          while ($the_query->have_posts() ) : $the_query->the_post();
		          $post_terms = wp_get_post_terms($post->ID,'category');
		          $upid = $post->post_author
		        ?>
				<li>
					<div class="post-item news-item">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						<div class="info">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="post-info">
					            <p><a href="<?php echo get_author_posts_url($upid); ?>"><?php the_author(); ?></a></p>
					            <div class="post-time">
					              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
					              <span><?php echo get_the_date('F d, Y'); ?></span>
					            </div>
				          	</div>
				          	<div class="des"><?php echo wp_trim_words(get_the_excerpt($post->ID), 21); ?></div>
				          	<a href="<?php the_permalink(); ?>" class="read-more"><?php echo __('Read more','health_theme'); ?></a>
						</div>
					</div>
				</li>
				<?php
		          endwhile;
		          wp_reset_query();
		        ?>
			</ul>
		</div>
	</div>
</main>
<?php get_footer(); ?>