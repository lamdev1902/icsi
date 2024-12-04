<footer id="footer">
  <section class="section-contact-footer">
    <div class="container">
      <div class="footer-logo">
        <a class="link-logo-footer" href="<?php echo home_url(); ?>">
          <img class="logo-footer" src="<?php the_field('logo_footer', 'option'); ?>" alt="Xhealth" />
        </a>
        <?php
        $footerDes = get_field('footer_description', 'option');
        if ($footerDes):
          ?>
          <p><?= $footerDes ?></p>
        <?php endif; ?>
      </div>

      <div class="contact">
        <h5>Contact Us</h5>
        <?php 
        $infoContact = get_field('contact_us_info', 'option');
        if($infoContact):
        ?>
        <?= $infoContact ?>
        <?php endif;?>
        <div class="social mr-bottom-20">
          <?php
          $socials = get_field('socials', 'option');
          if ($socials) {
            foreach ($socials as $social) {
              ?>
              <a target="_blank" href="<?php echo $social['link']; ?>"><img alt="<?= $social['icon']['alt']; ?>"
                  src="<?= $social['icon']['url']; ?>" /></a>
            <?php }
          } ?>
        </div>
      </div>
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
<?php wp_footer(); ?>
</body>

</html>