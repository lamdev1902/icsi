<?php
/* Template Name: Home */
global $sitepress;
$all_lang = false;
$current_code = ICL_LANGUAGE_CODE;
if (ICL_LANGUAGE_CODE == 'en')
  $all_lang = false;
$pageid = get_the_ID();
$img_default = get_field('image_default', 'option');
get_header(); ?>
<main id="home-main">
  <section class="home hero-section single-left">
    <div class="container">
      <div class="content">
        <p class="single-title no-color">Activate. Collaborate.</p>
        <h1 class="single-title">Impact.</h1>
      </div>
    </div>
  </section>
  <?php $grid = get_field('grid_block', $pageid);
  if ($grid):
    ?>
    <div class="list-block list-flex">
      <?php foreach ($grid as $itGrid): ?>
        <div class="it-block">
          <h3>
            <a href="<?= $itGrid['link'] ?>"><?= $itGrid['label'] ?></a>
          </h3>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php $headingIntro = get_field('heading_intro', $pageid);
  $intros = get_field('introduction', $pageid);
  if ($intros):
    ?>
    <section class="intro">
      <div class="container">
        <?php if ($headingIntro): ?>
          <h3><strong><?= $headingIntro ?></strong></h3>
        <?php endif; ?>
      </div>
      <?php if ($intros): ?>
        <div class="intro-list list-flex">
          <?php foreach ($intros as $intro): ?>
            <div class="intro--item list-flex">
              <div class="intro--item__img">
                <img src="<?=$intro['icon']?>" alt="">
              </div>
              <div class="intro--item__content">
                <h4><a href="<?=$intro['link']?>"><?=$intro['title']?></a></h4>
                <p><?=$intro['description']?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>
  <?php endif; ?>
  <div class="container">
    <section class="home-section-news">
      <div class="section-block-title">
        <h2 class="section-title"><?php echo __('News', 'health_theme'); ?></h2>
      </div>
      <div class="home-list-feature grid grid-post">
        <?php
        $args = array(
          'post_type' => array('post', 'informational_posts', 'round_up', 'single_reviews', 'coupon', 'interactive-post'),
          'posts_per_page' => 4,
          'offset' => 3,
          'suppress_filters' => $all_lang
        );
        $the_query = new WP_Query($args);
        while ($the_query->have_posts()):
          $the_query->the_post();
          $post_terms = wp_get_post_terms($post->ID, 'category');
          $upid = $post->post_author;
          $img = get_the_post_thumbnail();
          if (!$img)
            $img = '<img src="' . $img_default . '" alt="Image default">';
          $plink = get_permalink($post->ID);
          $plinkc = explode('p=', $plink);
          if (count($plinkc) > 1)
            $sitepress->switch_lang('de');
          ?>
          <div class="post-item home-list-feature-item">
            <a href="<?php the_permalink(); ?>">
              <?php echo $img; ?>
            </a>
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

    <!-- <?php if ($hco_categories) { ?>
      <section class="home-section-your-choices">
        <div class="section-block-title section-block-title-your-choices-custom">
          <h2 class="section-title"><?php echo __('Your Choices', 'health_theme'); ?></h2>
          <div class="home-your-choices-list-category">
            <?php foreach ($hco_categories as $h => $hc) { ?>
              <div class="home-your-choices-category-item <?php if ($h == 0)
                echo 'home-your-choices-category-item-active'; ?>">
                <h3><?php echo $hc['cat']->name; ?></h3>
                <input type="hidden" value="<?php echo $hc['cat']->term_id; ?>">
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="the-your-choices">
          <?php
          $args = array(
            'post_type' => array('post', 'informational_posts', 'round_up', 'single_reviews', 'coupon', 'interactive-post'),
            'posts_per_page' => 6,
            'cat' => $hco_categories[0]['cat']->term_id,
            'suppress_filters' => $all_lang
          );
          $the_query = new WP_Query($args);
          if ($the_query->have_posts()) {
            ?>
            <div class="home-list-your-choices">
              <?php
              while ($the_query->have_posts()):
                $the_query->the_post();
                $post_terms = wp_get_post_terms($post->ID, 'category');
                $upid = $post->post_author;
                $img = get_the_post_thumbnail();
                if (!$img)
                  $img = '<img src="' . $img_default . '" alt="Image default">';
                $plink = get_permalink($post->ID);
                $plinkc = explode('p=', $plink);
                if (count($plinkc) > 1)
                  $sitepress->switch_lang('de');
                ?>
                <div class="post-item home-list-your-choices-item">
                  <a href="<?php the_permalink(); ?>">
                    <?php echo $img; ?>
                  </a>
                  <div class="post-info">
                    <p><a href="<?php echo get_author_posts_url($upid); ?>"><?php the_author(); ?></a></p>
                    <div class="post-time">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg"
                        alt="" />
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
            <a href="<?php echo get_term_link($hco_categories[0]['cat'], 'category'); ?>" class="button-blue-shadow-black">
              See all post
              <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/your-choices-icon-arrow.svg"
                alt="" />
            </a>
          <?php } ?>
        </div>
      </section>
    <?php } ?> -->
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
        url: '<?php echo get_option('home') ?>/',
        type: 'GET',
        cache: false,
        dataType: "json",
        data: {
          keyid: id,
          'get_cat_post': true
        },
        success: function (data) {
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