<?php
$term_current = get_queried_object();
$termid = $term_current->term_id;
$caticon = get_field('image_default_cat', 'option');
if (get_field('cat_icon', $term_current))
	$caticon = get_field('cat_icon', $term_current);
$img_default = get_field('image_default', 'option');
$customDes = '';
if (get_field('custom_description', $term_current))
	$customDes = get_field('custom_description', $term_current);
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
		</div>
	</div>
</section>
<main id="content" class="cat-content content-single">
	<div class="container">
		<div class="single-inner list-flex">
			<div class="single-left">
				<div class="category-content list-flex">
					<div class="des extra-content">
						<?php if (!$customDes): ?>
							<?php if ($term_current->description): ?>
								<?php echo $term_current->description; ?>
							<?php endif; ?>
						<?php else: ?>
							<?php echo $customDes; ?>
						<?php endif; ?>
					</div>
					<div class="featured-list list-flex">
						<?php
						$args = array(
							'post_type' => array('post', 'informational_posts', 'round_up', 'single_reviews', 'coupon', 'interactive-post'),
							'posts_per_page' => 14,
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
							<div class="post-item">
								<div class="info">
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<div class="post-info">
										<div class="post-time">
											<span><?php echo get_the_date('F d, Y'); ?></span>
										</div>
									</div>
									<div class="des">
										<?php echo wp_trim_words(get_the_excerpt($post->ID), num_words: 100); ?>
									</div>
								</div>
							</div>
							<?php
						endwhile;
						wp_reset_query();
						?>
					</div>
				</div>
			</div>
			<?php echo get_sidebar(); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>