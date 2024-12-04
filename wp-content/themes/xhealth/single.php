<?php
$postid = get_the_ID();
$pview_count = get_field('pview_count', $postid);
if (!$pview_count)
	$pview_count = 0;
$pview_count += 1;
if ($pview_count > 0)
	update_field('field_6423eb3d24b1f', $pview_count, $postid);
$post_terms = wp_get_post_terms($postid, 'category');
get_header();
the_post();
?>
<main id="content" class="content-single">
	<section class="hero-section single-left">
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
				<h1 class="single-title"><?php the_title(); ?></h1>
				<?php
				$upid = $post->post_author;
				$avt_img = get_field('favicon', 'option');
				$avt = get_field('user_avatar', 'user_' . $upid);
				if ($avt) {
					$avt_img = avatar_show($avt['url']);
				}
				$medically_reviewed = get_field('select_author', $postid);
				?>
				<div class="single-author list-flex flex-inline">
					<div class="author-article item-flex">
						<div class="list-flex flex-inline flex-middle">
							<a class="avatar image-fit" href="<?php echo get_author_posts_url($upid); ?>"><img
									src="<?php echo $avt_img; ?>" alt="<?php echo get_the_author(); ?>"></a>
							<div class="info">
								<span itemprop="author" itemtype="https://schema.org/Person" itemscope=""><a
										href="<?php echo get_author_posts_url($upid); ?>"
										title="<?php echo __('View all posts by', 'health_theme'); ?> <?php echo get_the_author(); ?>"
										rel="author" itemprop="url"><span class="ncustom"
											itemprop="name"><?php echo get_the_author(); ?></span></a></span>
								<time class="updated time-of-post" datetime="<?php the_modified_date('c'); ?>"
									itemprop="dateModified"><?php echo __('Update at', 'health_theme'); ?>
									<?php the_modified_date(); ?></time>
							</div>
						</div>
					</div>
					<?php if ($medically_reviewed) {
						foreach ($medically_reviewed as $m => $mr) {
							$avt = get_field('user_avatar', 'user_' . $mr['ID']);
							?>
							<div class="review-article item-flex">
								<div class="list-flex flex-inline flex-middle">
									<a class="avatar image-fit" href="<?php echo get_author_posts_url($mr['ID']); ?>"><img
											src="<?php echo avatar_show($avt['url']); ?>"
											alt="<?php echo $mr['display_name']; ?>"></a>
									<div class="info">
										<span itemprop="author" itemtype="https://schema.org/Person" itemscope=""><a
												href="<?php echo get_author_posts_url($mr['ID']); ?>"
												title="<?php echo __('Medically reviewed the article by', 'health_theme'); ?> <?php echo $mr['display_name']; ?>"
												rel="author" itemprop="url"><span class="ncustom"
													itemprop="name"><?php echo $mr['display_name']; ?></span></a></span>
										<time class="updated" datetime="<?php the_modified_date('c'); ?>"
											itemprop="dateModified"><?php echo __('Medically reviewed the article', 'health_theme'); ?></time>
									</div>
								</div>
							</div>
						<?php }
					} ?>
				</div>
			</div>
		</div>
	</section>
	<div class="primary-content">
		<div class="container">
			<div class="single-inner list-flex">
				<div class="single-left">
					<?php
					$pty = get_post_type();
					$adcontent_cpt = get_field('adcontent_cpt', 'option');
					if (in_array($pty, $adcontent_cpt) && get_field('adcontent', 'option') != '') {
						?>
						<div class="avd-block"><?php the_field('adcontent', 'option'); ?></div>
					<?php }
					$pmetades = get_post_meta($postid, '_yoast_wpseo_metadesc', true);
					if ($pmetades) {
						$pmetades = str_replace("%%currentyear%%", date('Y'), $pmetades);
						?>
						<div class="pdes-meta"><?php echo $pmetades; ?></div>
					<?php } ?>
					<!-- <?php if (get_field('disible_featured_image', $postid) != true) { ?>
						<div class="pdetail-fimage">
							<?php if (get_the_post_thumbnail($postid, 'full')) {
								the_post_thumbnail('full');
								echo '<figcaption class="caption-image">' . get_the_post_thumbnail_caption($postid) . '</figcaption>';
							} else { ?>
								<img src="<?php echo get_field('image_default', 'option'); ?>" alt="Default Image">
							<?php } ?>

						</div>
					<?php } ?> -->
					<div class="extra-content">
						<?php the_content(); ?>
					</div>
					<?php
					if (get_field('source_content', $postid) != '') { ?>
						<div class="csource-more">
							<h3><?php echo __('Resources', 'health_theme'); ?></h3>
							<?php echo get_field('source_content', $postid); ?>
						</div>
					<?php } ?>
				</div>
				<?php echo get_sidebar(); ?>
			</div>
		</div>
	</div>
	<!-- <?php if ($post_terms) { ?>
		<div class="more-post-list">
			<div class="container">
				<h2 class="text-center">Related Posts</h2>
				<ul class="news-list list-flex">
					<?php
					$args = array(
						'post_type' => array('post', 'informational_posts', 'round_up', 'single_reviews', 'coupon', 'interactive-post'),
						'posts_per_page' => 4,
						'cat' => $post_terms[0]->term_id
					);
					$the_query = new WP_Query($args);
					while ($the_query->have_posts()):
						$the_query->the_post();
						$post_terms = wp_get_post_terms($post->ID, 'category');
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
											<img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg"
												alt="" />
											<span><?php echo get_the_date('F d, Y'); ?></span>
										</div>
									</div>
									<div class="des"><?php echo wp_trim_words(get_the_excerpt($post->ID), 21); ?></div>
									<a href="<?php the_permalink(); ?>"
										class="read-more"><?php echo __('Read more', 'health_theme'); ?></a>
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
	<?php } ?> -->
</main>
<?php get_footer(); ?>