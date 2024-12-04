<?php 
$postid = get_the_ID();
$cprating_number = get_field('cprating_number',$postid);
if(!$cprating_number) $cprating_number = 0;
$votes_number = get_field('votes_number',$postid);
if(!$votes_number) $votes_number = 0;
$couponid = $_GET['couponid'];

$pview_count = get_field('pview_count',$postid);
if(!$pview_count) $pview_count = 0;
$pview_count += 1;
if($pview_count > 0) update_field('field_6423eb3d24b1f',$pview_count,$postid);
$post_terms = wp_get_post_terms($postid,'category');
get_header();
the_post(); 
?>
<main id="content" class="coupon-single content-single">
	<div class="breadcrumbs-nav">
		<div class="container">
		<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
			}
		?>
		</div>
	</div>
	<div class="primary-content">
		<div class="container">
			<div class="single-inner list-flex">
				<div class="single-left">
					<h1 class="single-title"><?php the_title(); ?></h1>
					<?php
					$upid = $post->post_author; 
					$avt_img = get_field('favicon','option');
					$avt = get_field('user_avatar','user_'.$upid);
					if($avt) {
						$avt_img = avatar_show($avt['url']);
					}
					$medically_reviewed = get_field('select_author',$postid);
					?>
					<div class="single-author list-flex flex-inline">
						<div class="author-article item-flex">
							<div class="list-flex flex-inline flex-middle">
								<a class="avatar image-fit" href="<?php echo get_author_posts_url($upid); ?>"><img src="<?php echo $avt_img; ?>" alt="<?php echo get_the_author(); ?>"></a>
								<div class="info">
									<span itemprop="author" itemtype="https://schema.org/Person" itemscope=""><a href="<?php echo get_author_posts_url($upid); ?>"  title="<?php echo __('View all posts by','health_theme'); ?> <?php echo get_the_author(); ?>" rel="author" itemprop="url"><span class="ncustom" itemprop="name"><?php echo get_the_author(); ?></span></a></span>
									<time class="updated time-of-post" datetime="<?php the_modified_date('c'); ?>" itemprop="dateModified"><?php echo __('Update at','health_theme'); ?> <?php the_modified_date(); ?></time>
								</div>
							</div>
						</div>
						<?php if($medically_reviewed) { 
						foreach($medically_reviewed as $m=>$mr) {
						$avt = get_field('user_avatar','user_'.$mr['ID']);
						?>
						<div class="review-article item-flex">
							<div class="list-flex flex-inline flex-middle">
								<a class="avatar image-fit" href="<?php echo get_author_posts_url($mr['ID']); ?>"><img src="<?php echo avatar_show($avt['url']); ?>" alt="<?php echo $mr['display_name']; ?>"></a>
								<div class="info">
									<span itemprop="author" itemtype="https://schema.org/Person" itemscope=""><a href="<?php echo get_author_posts_url($mr['ID']); ?>" title="<?php echo __('Medically reviewed the article by','health_theme'); ?> <?php echo $mr['display_name']; ?>" rel="author" itemprop="url"><span class="ncustom" itemprop="name"><?php echo $mr['display_name']; ?></span></a></span>
									<time class="updated" datetime="<?php the_modified_date('c'); ?>" itemprop="dateModified"><?php echo __('Medically reviewed the article','health_theme'); ?></time>
								</div>
							</div>
						</div>
						<?php } } ?>
					</div>
					<?php 
					$pty = get_post_type();
					$adcontent_cpt = get_field('adcontent_cpt','option'); 
					if(in_array($pty,$adcontent_cpt) && get_field('adcontent','option') != '') {
					?>
					<div class="avd-block"><?php the_field('adcontent','option'); ?></div>
					<?php } $pmetades = get_post_meta($postid,'_yoast_wpseo_metadesc',true); 
					if($pmetades) { 
					$pmetades = str_replace("%%currentyear%%",date('Y'),$pmetades);
					?>
					<div class="pdes-meta"><?php echo $pmetades; ?></div>
					<?php } ?>
					<!--<div class="coupon-brand">
						<div class="brand-coupon list-flex flex-middle">
							<img src="<?php echo get_field('coupon_brand_featured', $postid); ?>" alt="">
							<div class="rating-total">
								<div class="rating-val">
									<input type="hidden" class="rating"  disabled="disabled" value="<?php echo $cprating_number; ?>" data-empty="fa fa-star-o" data-filled="fa fa-star" data-fractions="1" />
								</div>
								<div class="static"><?php echo $cprating_number; ?> stars - <span><?php echo $votes_number; ?> votes</span></div>
							</div>
						</div>
						<div class="share-post">
							<?php $po_socials = get_field('socials','option');
							if($po_socials) {
							foreach($po_socials as $ps) { ?>
							<a href="<?php echo $ps['link']; ?>" target="_blank"><img src="<?php echo $ps['icon']; ?>" alt="Social"></a>
							<?php } } ?>
						</div>
					</div>-->
					<?php 
					$coupon_list = get_field('coupon_list',$postid);  
					$cpc = 0;
					$dealc = 0;
					if($coupon_list) {
						foreach($coupon_list as $cp) {
							$ctype = wp_get_post_terms($cp,'coupon_type');
							if($ctype) {
								foreach($ctype as $ct) {
									if($ct->slug == 'coupon') $cpc++;
									if($ct->slug == 'deal') $dealc++;
								}
							}
						}
					?>
					<div class="coupon-the-filter">
						<div class="filter-nav">
							<a href="" class="active"><input type="hidden" value="all">All Offers <span>(<?php echo count($coupon_list); ?>)</span></a>
							<?php $terms = get_terms('coupon_type',array('hide_empty' => 0));
								if($terms ) {
							  	foreach ( $terms as $term ) {
							?>
							<a href=""><input type="hidden" value="<?php echo $term->slug; ?>"><?php echo $term->name; ?><span>(<?php if($term->slug == 'coupon') echo $cpc; else echo $dealc; ?>)</span></a>
							<?php } } ?>
						</div>
						<div class="filter-content">
							<?php
								foreach($coupon_list as $cp) {
								$ctype = wp_get_post_terms($cp,'coupon_type');
								$date_type = get_field('date_type',$cp);
								$date_ex = get_field('coupon_date',$cp);
								if($date_ex) {
									$date_change = new DateTime($date_ex);
									$date_current = strtotime(date('Y-m-d'));
									$date_ex = strtotime($date_ex);
								}
							?>
							<div class="coupon-item-detail all <?php if($ctype) foreach($ctype as $ct) echo ' '.$ct->slug; ?>">
								<div class="coupon-top">
									<div class="list-flex">
										<div class="info">
											<div class="relative-section">
												<h3><?php echo get_the_title($cp); ?></h3>
											</div>
											<div class="des"><?php echo get_field('coupon_description',$cp); ?></div>
										</div>
										<div class="hightlight relative-section font700">
											<div class="coupon-percent"><?php echo get_field('coupon_text', $cp); ?></div>
											<?php if($ct->slug == 'coupon') { ?>
											<a href="<?php echo get_field('coupon_link',$cp); ?>" class="get-code text-uppercase" data-id="<?php echo $cp; ?>" data-link="<?php echo get_field('coupon_link',$cp); ?>"><span><?php echo get_field('coupon_btn',$cp); ?></span></a>
											<?php } else { ?>
											<a href="<?php echo get_field('coupon_link',$cp); ?>" class="get-code text-uppercase" target="_blank"><span><?php echo get_field('coupon_btn',$cp); ?></span></a>
											<?php } ?>
											<div class="date <?php if($date_type == 1 && $date_current > $date_ex) echo 'has-expired'; ?>">Expired: <?php if($date_ex) echo $date_change->format('d F, Y'); else echo "Doesn't expire"; ?></div>
										</div>
									</div>
								</div>
								<a href="mailto:?subject=<?php echo get_permalink($postid); ?>" class="send-mail">Send to my email</a>
							</div>
							<?php } ?>
						</div>		
					</div>
					<?php } ?>
					<div class="extra-content">
						<?php the_content(); ?>
					</div>
					<?php 
					if(get_field('source_content',$postid) != '') { ?>
					<div class="csource-more">
					<h3><?php echo __('Resources','health_theme'); ?></h3>
						<?php echo get_field('source_content',$postid); ?>
					</div>
					<?php } ?>
				</div>
				<div id="sidebar">
					<div class="counpon-rating">
						<?php 
						$check = false;
						$ip = get_client_ip();
						$number = 0;
						$votes_number = get_field('votes_number',$postid);
						if(!$votes_number) $votes_number = 0; 
						$rating_tb = get_field('cprating_number',$postid);
						if(!$rating_tb) $rating_tb = 0;
						$cp_ip_list = get_field('cp_ip_list',$positd);
						if($cp_ip_list) {
							$ip = get_client_ip();
							$cp_ip_list = explode(',',$cp_ip_list);
							foreach($cp_ip_list as $cp) {
								$cp_ip = explode('-',$cp);
								if($ip == $cp_ip[0]) {
									$check = true;
									$number = $cp_ip[1];
								}
							}
						}
						?>
						<h2 class="font600 text-uppercase">Rate The Coupon</h2>
						<div class="rating-star rating-large <?php if($check == true) echo 'has-rating'; ?>">
							<input type="hidden" class="rating" id="couponRating" <?php if($check == true) echo 'disabled="disabled"'; ?> name="coupon_rating" value="<?php echo $number; ?>" data-empty="fa fa-star-o" data-filled="fa fa-star" data-fractions="1" />
						</div>
						<div class="rating-info">
							Average rating of <b><?php echo $votes_number; ?></b> votes:
							<div class="rating-tb list-flex">
								<div class="rating-star"><input type="hidden" disabled="disabled" class="rating" value="<?php echo $rating_tb; ?>" data-empty="fa fa-star-o" data-filled="fa fa-star" data-fractions="1" /></div> <b><?php echo $rating_tb; ?><sub>/5</sub></b>
							</div>
						</div>
					</div>
					<div class="widget-coupon-related">
						<h2>See more Coupon</h2>
						<ul>
							<?php
							$post_terms = wp_get_post_terms(get_the_ID(),'coupon_category');
							$args = array(
								'posts_per_page' => 3,
								'post_type' => 'coupon',
								'post__not_in' => array(get_the_ID()),
							    'tax_query' => array(
									array(
										'taxonomy' => 'coupon_category',
										'field' => 'id',
										'terms' => $post_terms[0]->term_id
									)
								)
							);
						 	$the_query = new WP_Query( $args );
							while ($the_query->have_posts() ) : $the_query->the_post();
							$medically_reviewed = get_field('select_author',$post->ID);
							$count_post += 1;
							$post_terms = wp_get_post_terms($post->ID,'coupon_category');
				          	$upid = $post->post_author;
					        ?>
					       <li class="post-item">
								<div class="info">
									<?php if($post_terms) { ?><div class="post-tag">
						              <a href="<?php echo get_category_link($post_terms[0]->term_id); ?>"><?php echo $post_terms[0]->name; ?></a>
						          </div><?php } ?>
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<div class="post-info">
							            <div class="post-time">
							              <span><?php echo get_the_date('F d, Y'); ?></span>
							            </div>
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
			</div>
		</div>
	</div>
	<?php if($post_terms) { ?>
	<div class="more-post-list">
		<div class="container">
			<h2 class="text-center"><?php echo __('More from','health_theme'); ?> <?php echo $post_terms[0]->name; ?></h2>
			<ul class="news-list list-flex">
				<?php
		          $args = array(
		            'post_type' => array('post','informational_posts','round_up','single_reviews','coupon','interactive-post'),
		            'posts_per_page' => 4,
		            'cat' => $post_terms[0]->term_id
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
	<?php } ?>
</main>
<?php get_footer(); 
if(isset($couponid)  && $couponid != '') {
?>
<?php 
$keyid = $postid;
$brandid = $_GET['couponid'];
$post_brand = wp_get_post_terms($brandid,'coupon_brand');
$brand_link = get_field('brand_link',$post_brand[0]);
$date_ex = get_field('coupon_date',$brandid);
if($date_ex) {
	$date_change = new DateTime($date_ex);
	$date_current = strtotime(date('Y-m-d'));
	$date_ex = strtotime($date_ex);
}
?>
<div class="modal-custom" id="couponModal">
  <div class="modal-custom-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<div class="relative-section">
				<!--<?php #echo get_the_post_thumbnail($keyid); ?>-->
				<a href="<?php echo $brand_link; ?>" target="_blank"><?php echo $brand_link; ?></a>
				<div class="date">Exp: <?php if($date_ex) echo $date_change->format('d F, Y'); else echo "Doesn't expire"; ?></div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
			</div>
      </div>
      <div class="modal-body">
   		<h2 class="font700"><?php echo get_the_title($brandid); ?></h2>
   		<ol>
   			<li>Coppy this promo code 
   				<div class="coupon-copy">
   					<input class="coupon-code" id="couponCode" value="<?php echo get_field('coupon_code',$brandid); ?>" disabled />
   					<a href="" class="copy ">Copy</a>
   				</div>
   			</li>
   			<li>Paste the code when you checkout at <a href="<?php echo $brand_link; ?>" target="_blank"><?php echo $brand_link; ?></a></li>
   			<li>Let us know if <a href="" class="coupon-rate coupon-worked">it worked</a> or <a href="" class="coupon-rate coupon-dontworked">didn’t work</a></li>
   		</ol>
   		<div class="text-center"><a href="<?php echo get_field('coupon_link',$brandid); ?>" target="_blank" class="btn-green btn-goto">Go To Offer</a></div>
      </div>
    </div>
  </div>
</div>
<script>
jQuery(function($) {
	
});
</script>
<?php } ?>
<script>
jQuery(function($) {
	$('.get-code').on('click',function() {
		var id = $(this).attr('data-id');
		if(id) window.open('<?php echo get_permalink($postid); ?>?couponid='+id, '_blank');
	});
	$('.filter-nav a').on('click',function() {
		$('.filter-nav a').removeClass('active');
		$(this).addClass('active');
		$claa = $(this).find('input').val();
		if($claa == 'all') $('.primary-content .coupon-item-detail').show();
		else {
			$('.primary-content .coupon-item-detail').hide();
			$('.primary-content .coupon-item-detail').each(function() {
				if($(this).hasClass($claa)) $(this).show();	
			});
		}
		return false;
	});
	$('body').on('click','.copy',function() {
	    var copyText = document.getElementById("couponCode");
	    copyText.select();
	    copyText.setSelectionRange(0, 99999);
	    navigator.clipboard.writeText(copyText.value);
	    alert("Copied the text: " + copyText.value);
	    return false;
	  });
	$('#couponRating').on('change',function() {
			$.ajax({
				url:'<?php echo get_option('home') ?>/',
				type: 'POST', 
				cache: false,
				dataType: "json",
				data: {
					keyid: <?php echo $postid; ?>,  
					keyval: $(this).val(),  
					'update_coupon_rating':true 
				},
				success: function(data) {
					$('.rating-info').html(data);
					$('.rating-info input.rating').rating();
					$('.rating-large').addClass('has-rating');
				}
			});
	});
	$('#ratingForm').on('submit',function() {
		$('#ratingForm .loading-json').show();
		$.ajax({
			url:'<?php echo get_option('home') ?>/',
			type: 'GET', 
			cache: false,
			dataType: "json",
			data: {
				keyid: <?php echo $postid; ?>,  
				keyname: $('#ratingName').val(),  
				keyrate: $('#ratingNumber').val(),  
				keycomt: $('#ratingCmt').val(),  
				'get_rating2':true 
			},
			success: function(data) {
				$('#ratingForm .loading-json').hide();
				$('#ratingForm .alert').show();
			}
		});
		return false;
	});
});
</script>