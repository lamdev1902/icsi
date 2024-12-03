<?php 
/* Template Name: Home */
global $sitepress;
$all_lang = false;
$current_code = ICL_LANGUAGE_CODE;
if(ICL_LANGUAGE_CODE == 'en') $all_lang = false;
$pageid = get_the_ID();
$img_default = get_field('image_default','option');
get_header(); ?>
<main id="home-main">
  <div class="home-container">
    <section class="home-section-top-news">
      <div class="home-top-news-left">
        <?php
          $args = array(
            'post_type' => array('post','informational_posts','round_up','single_reviews','coupon','interactive-post'),
            'posts_per_page' => 2,
            'suppress_filters' => $all_lang
          );
          $the_query = new WP_Query( $args );
          while ($the_query->have_posts() ) : $the_query->the_post();
          $post_terms = wp_get_post_terms($post->ID,'category');
          $upid = $post->post_author;
          $img = get_the_post_thumbnail();
          if(!$img) $img = '<img src="'.$img_default.'" alt="Image default">';
          $plink = get_permalink($post->ID);
          $plinkc = explode('p=',$plink);
          if(count($plinkc) > 1) $sitepress->switch_lang('de');
        ?>
        <div class="home-top-new-item">
          <a href="<?php the_permalink(); ?>"><?php echo $img; ?></a>
          <p class="home-new-item-author part-opacity"><a href="<?php echo get_author_posts_url($upid); ?>"><?php the_author(); ?></a></p>
          <a href="<?php the_permalink(); ?>">
            <h3 class="home-new-item-title"><?php the_title(); ?></h3>
          </a>
        </div>
        <?php
          $sitepress->switch_lang($current_code);
          endwhile;
          wp_reset_query();
        ?>
      </div>
      <div class="home-top-news-center">
        <?php
          $args = array(
            'post_type' => array('post','informational_posts','round_up','single_reviews','coupon','interactive-post'),
            'posts_per_page' => 1,
            'offset' => 2,
            'suppress_filters' => $all_lang
          );
          $the_query = new WP_Query( $args );
          while ($the_query->have_posts() ) : $the_query->the_post();
          $post_terms = wp_get_post_terms($post->ID,'category');
          $upid = $post->post_author;
          $img = get_the_post_thumbnail();
          if(!$img) $img = '<img src="'.$img_default.'" alt="Image default">';
          $plink = get_permalink($post->ID);
          $plinkc = explode('p=',$plink);
          if(count($plinkc) > 1) $sitepress->switch_lang('de');
        ?>
        <div class="home-top-new-item home-top-new-item-center">
          <a href="<?php the_permalink(); ?>"><?php echo $img; ?></a>
          <a href="<?php the_permalink(); ?>">
            <h3 class="home-new-item-title"><?php the_title(); ?></h3>
          </a>
          <p class="home-new-item-author part-opacity"><a href="<?php echo get_author_posts_url($upid); ?>"><?php the_author(); ?></a></p>
          
          <div class="home-new-item-description"><?php echo wp_trim_words(get_the_excerpt($post->ID), 21); ?></div>
        </div>
         <?php
          $sitepress->switch_lang($current_code);
          endwhile;
          wp_reset_query();
        ?>
      </div>
      <div class="home-top-news-right">
        <?php
          $args = array(
            'post_type' => array('post','informational_posts','round_up','single_reviews','coupon','interactive-post'),
            'posts_per_page' => 2,
            'offset' => 3,
            'suppress_filters' => $all_lang
          );
          $the_query = new WP_Query( $args );
          while ($the_query->have_posts() ) : $the_query->the_post();
          $post_terms = wp_get_post_terms($post->ID,'category');
          $upid = $post->post_author;
          $img = get_the_post_thumbnail();
          if(!$img) $img = '<img src="'.$img_default.'" alt="Image default">';
          $plink = get_permalink($post->ID);
          $plinkc = explode('p=',$plink);
          if(count($plinkc) > 1) $sitepress->switch_lang('de');
        ?>
        <div class="home-top-new-item">
          <a href="<?php the_permalink(); ?>"><?php echo $img; ?></a>
          <p class="home-new-item-author part-opacity"><a href="<?php echo get_author_posts_url($upid); ?>"><?php the_author(); ?></a></p>
          <?php if($post_terms) { ?><div class="home-new-item-tag">
           
          </div><?php } ?>
          <a href="<?php the_permalink(); ?>">
            <h3 class="home-new-item-title"><?php the_title(); ?></h3>
          </a>
        </div>
        <?php
          $sitepress->switch_lang($current_code);
          endwhile;
          wp_reset_query();
        ?>
      </div>
    </section>

    <section class="home-section-features">
      <div class="section-block-title">
        <h2 class="section-title"><?php echo __('Features','health_theme'); ?></h2>
      </div>
      <div class="home-list-feature">
        <?php
          $args = array(
            'post_type' => array('post','informational_posts','round_up','single_reviews','coupon','interactive-post'),
            'posts_per_page' => 6,
            'offset' => 5,
            'suppress_filters' => $all_lang
          );
          $the_query = new WP_Query( $args );
          while ($the_query->have_posts() ) : $the_query->the_post();
          $post_terms = wp_get_post_terms($post->ID,'category');
          $upid = $post->post_author;
          $img = get_the_post_thumbnail();
          if(!$img) $img = '<img src="'.$img_default.'" alt="Image default">';
          $plink = get_permalink($post->ID);
          $plinkc = explode('p=',$plink);
          if(count($plinkc) > 1) $sitepress->switch_lang('de');
        ?>
        <div class="post-item home-list-feature-item">
          <a href="<?php the_permalink(); ?>">
            <?php echo $img; ?>
          </a>
          <div class="post-info">
            <p class="home-new-item-author"><a href="<?php echo get_author_posts_url($upid); ?>"><?php the_author(); ?></a></p>
            <div class="post-time">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
              <span><?php echo get_the_date('m/d/Y'); ?></span>
            </div>
          </div>

          <a href="<?php the_permalink(); ?>">
            <h3 class="post-title"><?php the_title(); ?></h3>
          </a>
        </div>
        <?php
          $sitepress->switch_lang($current_code);
          endwhile;
          wp_reset_query();
        ?>
      </div>
    </section>

    <section class="home-section-trending">
      <div class="section-block-title">
        <h2 class="section-title"><?php echo __('Trending','health_theme'); ?></h2>
      </div>
      <div class="home-list-trending">
        <?php
          $args = array(
            'post_type' => array('post'),
            'posts_per_page' => 6,
            'meta_key' => 'pview_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'suppress_filters' => $all_lang
          );
          $the_query = new WP_Query( $args );
          while ($the_query->have_posts() ) : $the_query->the_post();
          $post_terms = wp_get_post_terms($post->ID,'category');
          $upid = $post->post_author;
          $img = get_the_post_thumbnail_url();
          if(!$img) $img = $img_default;
          $plink = get_permalink($post->ID);
          $plinkc = explode('p=',$plink);
          if(count($plinkc) > 1) $sitepress->switch_lang('de');
        ?>
        <div class="home-trending-item">
          <a href="<?php the_permalink(); ?>" class="image-fit"><img src="<?php echo $img; ?>" alt="<?php the_title(); ?>" class="home-trending-item-image"></a>
          <div class="home-trending-item-right">
            <a href="<?php the_permalink(); ?>">
              <h3 class="home-trending-item-title"><?php the_title(); ?></h3>
            </a>
            <a href="<?php the_permalink(); ?>">
              <span class="home-trending-item-read-more"><?php echo __('Read more','health_theme'); ?></span>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/trending-icon-arrow.svg" alt="" />
            </a>
          </div>
        </div>
        <?php
          $sitepress->switch_lang($current_code);
          endwhile;
          wp_reset_query();
        ?>
      </div>
    </section>
    <?php if($hco_categories) { ?>
    <section class="home-section-your-choices">
      <div class="section-block-title section-block-title-your-choices-custom">
        <h2 class="section-title"><?php echo __('Your Choices','health_theme'); ?></h2>
        <div class="home-your-choices-list-category">
          <?php foreach($hco_categories as $h=>$hc) { ?>
          <div class="home-your-choices-category-item <?php if($h == 0) echo 'home-your-choices-category-item-active'; ?>">
            <h3><?php echo $hc['cat']->name; ?></h3>
            <input type="hidden" value="<?php echo $hc['cat']->term_id; ?>">
          </div>
          <?php } ?>
        </div>
      </div>
      <div class="the-your-choices">
         <?php
          $args = array(
            'post_type' => array('post','informational_posts','round_up','single_reviews','coupon','interactive-post'),
            'posts_per_page' => 6,
            'cat' => $hco_categories[0]['cat']->term_id,
            'suppress_filters' => $all_lang
          );
          $the_query = new WP_Query( $args );
          if($the_query->have_posts()) {
        ?>
        <div class="home-list-your-choices">
          <?php
            while ($the_query->have_posts() ) : $the_query->the_post();
            $post_terms = wp_get_post_terms($post->ID,'category');
            $upid = $post->post_author;
            $img = get_the_post_thumbnail();
            if(!$img) $img = '<img src="'.$img_default.'" alt="Image default">';
            $plink = get_permalink($post->ID);
            $plinkc = explode('p=',$plink);
            if(count($plinkc) > 1) $sitepress->switch_lang('de');
          ?>
          <div class="post-item home-list-your-choices-item">
            <a href="<?php the_permalink(); ?>">
              <?php echo $img; ?>
            </a>
            <div class="post-info">
              <p><a href="<?php echo get_author_posts_url($upid); ?>"><?php the_author(); ?></a></p>
              <div class="post-time">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
                <span><?php echo get_the_date('m/d/Y'); ?></span>
              </div>
            </div>
         
            <a href="<?php the_permalink(); ?>">
              <h3 class="post-title"><?php the_title(); ?></h3>
            </a>
          </div>
          <?php
            $sitepress->switch_lang($current_code);
            endwhile;
            wp_reset_query();
          ?>
        </div>
        <a href="<?php echo get_term_link($hco_categories[0]['cat'], 'category' ); ?>" class="button-blue-shadow-black">
          See all post
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/your-choices-icon-arrow.svg" alt="" />
        </a>
        <?php } ?>
      </div>
    </section>
     <?php } ?>
  </div>
</main>
<?php get_footer(); ?>
<script>
  jQuery(function () {
    $(".home-your-choices-category-item").click(function () {
      $(".home-your-choices-category-item").removeClass("home-your-choices-category-item-active");
      $(this).addClass("home-your-choices-category-item-active");
      var id = $(this).find('input').val();
        $.ajax({
            url:'<?php echo get_option('home') ?>/',
            type: 'GET', 
            cache: false,
            dataType: "json",
            data: {
              keyid: id,  
              'get_cat_post':true 
            },
            success: function(data) {
              $('.the-your-choices').html(data);
            }
        });
    });

    $("#header .header-icon").click(function () {
      $("#header .header-icon-close").toggle();
      $("#header .header-icon-search").toggle();
      $("#header .header-search-form").slideToggle("slow");
    });
  });
</script>