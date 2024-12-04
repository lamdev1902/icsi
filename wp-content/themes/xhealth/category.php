<?php
$term_current = get_queried_object();
$termid = $term_current->term_id;
$caticon = get_field('image_default_cat', 'option');
if (get_field('cat_icon', $term_current))
	$caticon = get_field('cat_icon', $term_current);
$img_default = get_field('image_default', 'option');
get_header();
?>
<!-- <div class="cat-banner">
	<div class="container">
		<div class="relative-section">
			<div class="breadcrumbs-nav">
				<?php
				if (function_exists('yoast_breadcrumb')) {
					yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
				}
				?>
			</div>
			<h1><?php echo $term_current->name; ?></h1>
			<div class="des"><?php echo $term_current->description; ?></div>
			<img src="<?php echo $caticon; ?>" alt="<?php echo $term_current->slug; ?>">
		</div>
	</div>
</div> -->
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
			<h1 class="single-title"><?php echo $term_current->name; ?></h1>
			<div class="des"><?php echo $term_current->description; ?></div>
		</div>
	</div>
</section>
<main id="content" class="cat-content">
	<div class="container">
		<div class="category-content">
			<div class="featured-list list-flex">
				<?php
				$args = array(
					'post_type' => array('post', 'informational_posts', 'round_up', 'single_reviews', 'coupon', 'interactive-post'),
					'posts_per_page' => 1,
					'cat' => $termid
				);
				$the_query = new WP_Query($args);
				while ($the_query->have_posts()):
					$the_query->the_post();
					$post_terms = wp_get_post_terms($post->ID, 'category');
					$upid = $post->post_author;
					$img = get_the_post_thumbnail();
					if (!$img)
						$img = '<img src="' . $img_default . '" alt="Image default">';
					?>
					<div class="post-item hightlight-item">
						<a href="<?php the_permalink(); ?>"><?php echo $img; ?></a>
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
							<?php if ($post_terms) { ?>
								<div class="post-tag">
									<a href="<?php echo $term_link; ?>"><?php echo $post_terms[0]->name; ?></a>
								</div><?php } ?>
							<div class="des"><?php echo wp_trim_words(get_the_excerpt($post->ID), 21); ?></div>
							<a href="<?php the_permalink(); ?>"
								class="read-more"><?php echo __('Read more', 'health_theme'); ?></a>
						</div>
					</div>
					<?php
				endwhile;
				wp_reset_query();
				?>
				<div class="right-list">
					<ul class="news-list">
						<?php
						$args = array(
							'post_type' => array('post', 'informational_posts', 'round_up', 'single_reviews', 'coupon', 'interactive-post'),
							'posts_per_page' => 2,
							'cat' => $termid,
							'offset' => 1
						);
						$the_query = new WP_Query($args);
						while ($the_query->have_posts()):
							$the_query->the_post();
							$post_terms = wp_get_post_terms($post->ID, 'category');
							$upid = $post->post_author;
							$img = get_the_post_thumbnail();
							if (!$img)
								$img = '<img src="' . $img_default . '" alt="Image default">';
							?>
							<li>
								<div class="post-item news-item">
									<a href="<?php the_permalink(); ?>"><?php echo $img; ?></a>
									<div class="info">
										<div class="post-info">
											<p><a
													href="<?php echo get_author_posts_url($upid); ?>"><?php the_author(); ?></a>
											</p>
											<div class="post-time">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg"
													alt="" />
												<span><?php echo get_the_date('F d, Y'); ?></span>
											</div>
										</div>
										<?php if ($post_terms) { ?>
											<div class="post-tag">
												<a href="<?php echo $term_link; ?>"><?php echo $post_terms[0]->name; ?></a>
											</div><?php } ?>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
			<!-- <?php echo get_sidebar(); ?> -->
		</div>
		<div class="all-post">
			<h2 class="text-uppercase"><?php echo __('All post', 'health_theme'); ?></h2>
			<ul class="news-list list-flex">
				<?php
				$args = array(
					'post_type' => array('post', 'informational_posts', 'round_up', 'single_reviews', 'coupon', 'interactive-post'),
					'posts_per_page' => 12,
					'cat' => $termid,
					'paged' => max($page, $paged),
					'offset' => 3
				);
				$the_query = new WP_Query($args);
				while ($the_query->have_posts()):
					$the_query->the_post();
					$post_terms = wp_get_post_terms($post->ID, 'category');
					$upid = $post->post_author;
					$img = get_the_post_thumbnail();
					if (!$img)
						$img = '<img src="' . $img_default . '" alt="Image default">';
					?>
					<li>
						<div class="post-item news-item">
							<a href="<?php the_permalink(); ?>"><?php echo $img; ?></a>
							<div class="info">
								<div class="post-info">
									<p><a href="<?php echo get_author_posts_url($upid); ?>"><?php the_author(); ?></a></p>
									<div class="post-time">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg"
											alt="" />
										<span><?php echo get_the_date('F d, Y'); ?></span>
									</div>
								</div>
								<?php if ($post_terms) { ?>
									<div class="post-tag">
										<a href="<?php echo $term_link; ?>"><?php echo $post_terms[0]->name; ?></a>
									</div><?php } ?>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>
						</div>
					</li>
					<?php
				endwhile;
				wp_reset_query();
				?>
			</ul>
		</div>
		<?php
		$big = 999999999;
		$mcs_paginate_links = paginate_links(array(
			'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format' => '?paged=%#%',
			'current' => max(1, get_query_var('paged')),
			'total' => $the_query->max_num_pages,
			'prev_text' => __('<img src="' . get_template_directory_uri() . '/assets/images/arrow-left.svg" alt="Prev">', 'yup'),
			'next_text' => __('<img src="' . get_template_directory_uri() . '/assets/images/arrow-right.svg" alt="Next">', 'yup')
		));
		if ($mcs_paginate_links):
			?>
			<div class="pagi-custom">
				<?php echo $mcs_paginate_links ?>
			</div>
		<?php endif; ?>
	</div>

</main>
<?php get_footer(); ?>