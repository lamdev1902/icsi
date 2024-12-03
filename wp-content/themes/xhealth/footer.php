<footer id="footer">
  <section class="section-contact-footer">
    <div class="container">
      <a class="link-logo-footer" href="<?php echo home_url(); ?>">
        <img class="logo-footer" src="<?php the_field('logo_footer','option'); ?>" alt="Xhealth" />
      </a>
		<div class="contact-form-footer">
			<?php echo do_shortcode(get_field('subscribe_form','option')); ?>
		</div>
	  
       <?php $socials = get_field('socials','option');
      if($socials) { 
      ?>
      <div class="list-social-footer">
        <h3 class="text-social-footer">FOLLOW US</h3>
        <ul>
         <?php foreach($socials as $so) { ?>
  <li>
    <a href="<?php echo $so['link']; ?>" target="_blank" rel="nofollow">
      <?php if (strpos($so['link'], 'linkedin.com') !== false) { ?>
        <!-- Change LinkedIn Icon -->
        <img src="https://www.icsi.org/wp-content/uploads/2024/12/Linkedin-icon-footer.png" alt="LinkedIn" />
      <?php } else { ?>
        <img src="<?php echo $so['icon']; ?>" alt="Social" />
      <?php } ?>
    </a>
  </li>
<?php } ?>
        </ul>
      </div>
     <?php } ?>
    </div>
  </section>


  <section class="section-policy">
    <?php wp_nav_menu(array('theme_location' => 'menu_footer_bottom')); ?>
    <div>
      <p><?php the_field('copyright','option'); ?></p>
    </div>
  </section>
</footer>
<?php 
// $post_type = get_field('customer_review_active_with_cpt','option');
// if(in_array( get_post_type(), $post_type) == true) include "hcfunction/customer-feedback.php";
?>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery-3.5.0.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/rating.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/custom.js?ver=1.0.5"></script>
<?php wp_footer();?>
</body>
</html>