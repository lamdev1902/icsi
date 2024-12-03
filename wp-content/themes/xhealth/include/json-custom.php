<?php
function is_ajax_cat_post(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
add_action('init', 'get_cat_post');
function get_cat_post() {
	if(isset($_GET['get_cat_post']) && is_ajax_cat_post()){
		$keyid = $_GET['keyid'];
		$catc = get_category($keyid);
		ob_start();
		$args = array(
        'post_type' => array('post','informational_posts','round_up','single_reviews','coupon','interactive-post'),
        'posts_per_page' => 6,
        'cat' => $keyid
      );
      $the_query = new WP_Query( $args );
      if($the_query->have_posts()) {
    ?>
    <div class="home-list-your-choices">
      <?php
        while ($the_query->have_posts() ) : $the_query->the_post();
        $post_terms = wp_get_post_terms($post->ID,'category');
        $upid = $post->post_author
      ?>
      <div class="post-item home-list-your-choices-item">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail(); ?>
        </a>
        <div class="post-info">
          <p><a href="<?php echo get_author_posts_url($upid); ?>"><?php the_author(); ?></a></p>
          <div class="post-time">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/feature-icon-clock.svg" alt="" />
            <span><?php echo get_the_date('F d, Y'); ?></span>
          </div>
        </div>
        <?php if($post_terms) { ?><div class="post-tag">
            <a href="<?php echo get_category_link($catc); ?>"><?php echo $catc->name; ?></a>
        </div><?php } ?>
        <a href="<?php the_permalink(); ?>">
          <h3 class="post-title"><?php the_title(); ?></h3>
        </a>
      </div>
      <?php
        endwhile;
        wp_reset_query();
      ?>
    </div>
    <a href="<?php echo get_category_link($catc); ?>" class="button-blue-shadow-black">
      See all post
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/home/your-choices-icon-arrow.svg" alt="" />
    </a>
    <?php }
		$data_return = ob_get_clean();
		echo json_encode($data_return);
		exit;
	}
}
/* Update coupon rating */
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function is_ajax_coupon_rating(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
add_action('init', 'update_coupon_rating');
function update_coupon_rating() {
  if(isset($_POST['update_coupon_rating']) && is_ajax_coupon_rating()){
    $postid = $_POST['keyid'];
    $keyval = $_POST['keyval'];
    
    $votes_number = get_field('votes_number',$postid);
    if(!$votes_number || $votes_number == '') $votes_number = 0; 
    $votes_number += 1;
    update_field('field_62022cd96e40a',$votes_number,$postid);
    $cprating_total = get_field('cprating_total',$postid);
    if(!$cprating_total || $cprating_total == '') $cprating_total = 0; 
    $cprating_total += $keyval;
    update_field('field_62441e22f3342',$cprating_total,$postid);
    $rating_tb = 0;
    if($cprating_total > 0) $rating_tb = round(($cprating_total/$votes_number),1);
    update_field('field_62022cc06e409',$rating_tb,$postid);
    /* Save Ip */
    $ip = get_client_ip();
    $cp_ip_list = get_field('cp_ip_list',$postid);
    $ip_list_return = '';
    $save_ip = $ip.'-'.$keyval;
    if($cp_ip_list) {
      $ip_list_return = $cp_ip_list.$save_ip.',';
    } else {
      $ip_list_return = $save_ip.',';
    }
    update_field('field_62441916ede04',$ip_list_return,$postid);
    ob_start();
    ?>
    <div class="rating-info">
      Average rating of <b><?php echo $votes_number; ?></b> votes:
      <div class="rating-tb list-flex">
        <div class="rating-star"><input type="hidden" disabled="disabled" class="rating" value="<?php echo $rating_tb; ?>" data-empty="fa fa-star-o" data-filled="fa fa-star" data-fractions="2" /></div> <b><?php echo $rating_tb; ?><sub>/5</sub></b>
      </div>
    </div>
    <?php
    $array_return = ob_get_clean();
    echo json_encode($array_return);
    exit;
  }
}
