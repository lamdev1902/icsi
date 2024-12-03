<div class="more-post-list">
	<div class="container">
	<h2 class="text-center"><?php echo __('More posts','health_theme'); ?></h2>
		<ul class="news-list list-flex">
			<?php
				$offset = 0;
				$count_post = 0;
				$post_tags = wp_get_post_terms(get_the_ID(),'post_tag');
				if($post_tags) {
				$tagid = array();
				foreach($post_tags as $pt) {
					$tagid[] = $pt->term_id;
				}
				$args = array(
					'posts_per_page' => 4,
					'post_type' => array('post','round_up','single_reviews','informational_posts','interactive-post'),
					'post_status' => 'publish',
					'offset' => $offset,
					'post__not_in' => array(get_the_ID()),
					'tax_query' => array(
						array(
							'taxonomy' => 'post_tag',
							'field'  => 'id',
							'terms' => $tagid
						)
					),
					'meta_query'     => array(
				        'relation' => 'AND',
				        array(
				            'key'     => '_yoast_wpseo_title', 
				            'value'   => 'cbd',
				            'compare' => 'NOT LIKE',
				        ),
			         	array(
				            'key'     => '_yoast_wpseo_title', 
				            'value'   => 'CBD',
				            'compare' => 'NOT LIKE',
				        )
				    ),
				);
			 	$the_query = new WP_Query( $args );
				while ($the_query->have_posts() ) : $the_query->the_post();
				$medically_reviewed = get_field('select_author',$post->ID);
				$count_post += 1;
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
			}
			?>
			<?php
			$count_left = 4 - $count_post;
			if($count_left > 0) {
				$post_terms = wp_get_post_terms(get_the_ID(),'category');
				$args = array(
					'posts_per_page' => $count_left,
					'post_type' => array('post','round_up','single_reviews','informational_posts','interactive-post'),
					'post_status' => 'publish',
					'offset' => $offset,
					'post__not_in' => array(get_the_ID()),
					'meta_query'     => array(
				        'relation' => 'AND',
				        array(
				            'key'     => '_yoast_wpseo_title', 
				            'value'   => 'cbd',
				            'compare' => 'NOT LIKE',
				        ),
			         	array(
				            'key'     => '_yoast_wpseo_title', 
				            'value'   => 'CBD',
				            'compare' => 'NOT LIKE',
				        )
				    ),
				);
				if($post_terms) {
					$args['cat'] = $post_terms[0]->term_id;
				}
			 	$the_query = new WP_Query( $args );
				while ($the_query->have_posts() ) : $the_query->the_post();
				$medically_reviewed = get_field('select_author',$post->ID);
				$count_post += 1;
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
			}
			?>
			<?php
			$count_left = 4 - $count_post;
			if($count_left > 0) {
				$pid = get_the_ID();
				$words = explode(' ', get_the_title(get_the_ID()));
				if($words) {
					$regex = implode('|', $words);
					$keyqr .= "AND post_title REGEXP '".$regex."'";
				}
				$qrLangSQl = "AND post_trans.language_code = '" . ICL_LANGUAGE_CODE . "'";
				global $wpdb; 
				$limit = $count_left; 
				$table = $wpdb->prefix . 'posts';
				$sql = "SELECT *
				FROM wp_posts
				INNER JOIN wp_icl_translations post_trans
				ON ID = post_trans.element_id
				WHERE 
					post_status = 'publish'
					AND post_type IN ('post','round_up','informational_posts','single_reviews','interactive-post')
					$qrLangSQl
					AND ID NOT IN ($pid)
					$keyqr
				ORDER BY post_date_gmt DESC
				LIMIT ".$limit;
				$data_posts = $wpdb->get_results($sql); 
			 	foreach($data_posts as $post) {
				$medically_reviewed = get_field('select_author',$post->ID);
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
				}
			}
			?>
		</ul>
		<div class="crp_clear"></div>
	</div>
</div>