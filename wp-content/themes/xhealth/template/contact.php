<?php
/* Template Name: Contact - Skeep Out */
// $args = array(
// 	'post_type' => array('page','post','article'),
// 	'posts_per_page' => 500,
// 	'author' => 1,
// 	'offset' => 500
// );
// $the_query = new WP_Query( $args );
// while ($the_query->have_posts() ) : $the_query->the_post();
// 	$data = array(
// 	  'ID' => $post->ID,
// 	  'post_author' => 6
// 	 );

// 	var_dump(wp_update_post( $data ));
// endwhile;
// wp_reset_query();
$pageid = get_the_ID();
get_header(); ?>
<main class="contact-container">
	<section class="home hero-section single-left">
		<div class="container">
			<div class="breadcrumbs-nav">
				<div class="container">
					<?php
					if (function_exists('yoast_breadcrumb')) {
						yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
					}
					?>
				</div>
			</div>
			<div class="content">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="contact-content">
			<div class="contact-info">
				<div class="office-info">
					<?php echo get_field('us_office', $pageid); ?>
				</div>

				<div class="social-info">
					<h2><?php echo get_field('follow_title', $pageid); ?></h2>
					<ul>
						<?php
						$follow_social = get_field('follow_social', $pageid);
						if ($follow_social) {
							foreach ($follow_social as $social) {
								?>
								<li>
									<a href="<?php echo $social['link']; ?>" target="_blank" rel="nofollow noopener">
										<img src="<?php echo $social['icon']; ?>" alt="">
										<span><?php echo $social['title']; ?></span>
									</a>
								</li>
							<?php }
						} ?>
					</ul>
				</div>
			</div>
			<div class="contact-form">
				<?php the_content(); ?>
				<div class="form-group">
					<?php echo do_shortcode(get_field('contact_form', $pageid)); ?>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>