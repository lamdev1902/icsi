<?php get_header(); ?>
<main>
  <section class="section-one">
    <div class="col-one">
		<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 2
			);
			 $the_query = new WP_Query( $args );
			while ($the_query->have_posts() ) : $the_query->the_post();
			$post_terms = wp_get_post_terms($post->ID,'category');
		?>
	      <div class="new-item">
	        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
	        <p class="new-item-author"><a href=""><?php the_author(); ?></a></p>
	        <?php if($post_terms) { ?><div class="new-item-tag">
	        	<?php foreach($post_terms as $pt) { 
	        	$term_link = get_term_link($pt, 'category' );
	        	?>
	        	<a href="<?php echo $term_link; ?>"><?php echo $pt->name; ?></a>
	       	 	<?php } ?>
	        </div><?php } ?>
	        <h3 class="new-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	      </div>
		<?php
			endwhile;
			wp_reset_query();
		?>
    </div>
    <div class="col-two">
    	<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 1,
				'offset' => 2
			);
			$the_query = new WP_Query( $args );
			while ($the_query->have_posts() ) : $the_query->the_post();
			$post_terms = wp_get_post_terms($post->ID,'category');
		?>
      <div class="new-item">
         <?php the_post_thumbnail(); ?>
	        <p class="new-item-author"><a href=""><?php the_author(); ?></a></p>
	        <?php if($post_terms) { ?><div class="new-item-tag">
	        	<?php foreach($post_terms as $pt) { 
	        	$term_link = get_term_link($pt, 'category' );
	        	?>
	        	<a href="<?php echo $term_link; ?>"><?php echo $pt->name; ?></a>
	       	 	<?php } ?>
	        </div><?php } ?>
	        <h3 class="new-item-title"><?php the_title(); ?></h3>
        <p class="new-item-description">A recent clinical study suggests that a "morning after" antibiotic could diminish the risk of common STIs for high-risk individuals.</p>
      </div>
      <?php
			endwhile;
			wp_reset_query();
		?>
    </div>
    <div class="col-three">
    	<?php
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 2,
				'offset' => 3
			);
			$the_query = new WP_Query( $args );
			while ($the_query->have_posts() ) : $the_query->the_post();
			$post_terms = wp_get_post_terms($post->ID,'category');
		?>
      <div class="new-item">
	        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
	        <p class="new-item-author"><a href=""><?php the_author(); ?></a></p>
	        <?php if($post_terms) { ?><div class="new-item-tag">
	        	<?php foreach($post_terms as $pt) { 
	        	$term_link = get_term_link($pt, 'category' );
	        	?>
	        	<a href="<?php echo $term_link; ?>"><?php echo $pt->name; ?></a>
	       	 	<?php } ?>
	        </div><?php } ?>
	        <h3 class="new-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	      </div>
      <?php
			endwhile;
			wp_reset_query();
		?>
    </div>
  </section>
  <section class="section-two">
    <div class="section-block-title">
      <h1 class="section-title">Collections</h1>
    </div>
    <div class="list-collection">
      <a class="collection-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/collection-icon-1.svg" alt="" />
        <p class="collection-title">Reproductive health</p>
      </a>
      <a class="collection-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/collection-icon-2.svg" alt="" />
        <p class="collection-title">Nutritions</p>
      </a>
      <a class="collection-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/collection-icon-3.svg" alt="" />
        <p class="collection-title">Mental Health</p>
      </a>
      <a class="collection-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/collection-icon-4.svg" alt="" />
        <p class="collection-title">Fitness & Workout</p>
      </a>
      <a class="collection-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/collection-icon-5.svg" alt="" />
        <p class="collection-title">Diet</p>
      </a>
      <a class="collection-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/collection-icon-6.svg" alt="" />
        <p class="collection-title">Coupon</p>
      </a>
    </div>
  </section>
  <section class="section-three">
    <div class="section-block-title">
      <h1 class="section-title">Features</h1>
    </div>
    <div class="list-feature">
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-image-1.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-image-2.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-image-3.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-image-4.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-image-5.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-image-6.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
    </div>
  </section>
  <section class="section-four">
    <div class="section-block-title">
      <h1 class="section-title">Trending</h1>
    </div>
    <div class="list-trending">
      <div class="trending-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-image-1.png" alt="" />
        <div class="trending-item-right">
          <p class="news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</p>
          <a href="#">
            <span class="news-title">Read more</span>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-icon-arrow.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="trending-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-image-2.png" alt="" />
        <div class="trending-item-right">
          <p class="news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</p>
          <a href="#">
            <span class="news-title">Read more</span>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-icon-arrow.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="trending-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-image-3.png" alt="" />
        <div class="trending-item-right">
          <p class="news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</p>
          <a href="#">
            <span class="news-title">Read more</span>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-icon-arrow.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="trending-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-image-4.png" alt="" />
        <div class="trending-item-right">
          <p class="news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</p>
          <a href="#">
            <span class="news-title">Read more</span>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-icon-arrow.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="trending-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-image-5.png" alt="" />
        <div class="trending-item-right">
          <p class="news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</p>
          <a href="#">
            <span class="news-title">Read more</span>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-icon-arrow.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="trending-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-image-6.png" alt="" />
        <div class="trending-item-right">
          <p class="news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</p>
          <a href="#">
            <span class="news-title">Read more</span>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-icon-arrow.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="trending-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-image-7.png" alt="" />
        <div class="trending-item-right">
          <p class="news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</p>
          <a href="#">
            <span class="news-title">Read more</span>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-icon-arrow.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="trending-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-image-8.png" alt="" />
        <div class="trending-item-right">
          <p class="news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</p>
          <a href="#">
            <span class="news-title">Read more</span>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-icon-arrow.svg" alt="" />
          </a>
        </div>
      </div>
      <div class="trending-item">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-image-9.png" alt="" />
        <div class="trending-item-right">
          <p class="news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</p>
          <a href="#">
            <span class="news-title">Read more</span>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-icon-arrow.svg" alt="" />
          </a>
        </div>
      </div>
    </div>
  </section>
  <section class="section-five">
    <div class="section-block-title section-block-title-custom">
      <h1 class="section-title">Your Choices</h1>
      <div class="list-category">
        <div class="category-item active">
          <p>All Post</p>
        </div>
        <div class="category-item">
          <p>Family Health</p>
        </div>
        <div class="category-item">
          <p>Longevity</p>
        </div>
        <div class="category-item">
          <p>Sleep</p>
        </div>
        <div class="category-item">
          <p>Mental health</p>
        </div>
        <div class="category-item">
          <p>Beauty</p>
        </div>
        <div class="category-item">
          <p>Nutrition</p>
        </div>
        <div class="category-item">
          <p>Health conditions</p>
        </div>
        <div class="category-item">
          <p>Longevity</p>
        </div>
        <div class="category-item">
          <p>Sleep</p>
        </div>
      </div>
    </div>
    <div class="list-feature">
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/your-choices-image-1.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/your-choices-image-2.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/your-choices-image-3.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/your-choices-image-4.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/your-choices-image-5.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
      <a class="feature-item" href="#">
        <img class="feature-item-image" src="<?php echo get_template_directory_uri(); ?>/assets/images/home/your-choices-image-6.png" alt="" />
        <div class="feature-item-info news-author">
          <span>Rhiannon John, MSexol</span>
          <div>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span>April 10, 2023</span>
          </div>
        </div>
        <div class="feature-item-tag news-tag">Vitamins and supplements</div>
        <div class="feature-item-title news-title">Endless Scrolling on Social Media May Disrupt Your Mental Health</div>
      </a>
    </div>
    <a href="#" class="button-custom">
      See all post
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/your-choices-icon-arrow.svg" alt="" />
    </a>
  </section>
</main>
<?php get_footer(); ?>
<script>
	jQuery(function($) {
		$(".category-item").click(function () {
	      $(".category-item").removeClass("active");
	      $(this).addClass("active");
	    });
	});
</script>