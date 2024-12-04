<?php
/* Template Name: About - Skeep Out */
$pageid = get_the_ID();
get_header();
function socials_link($link)
{
	if (str_contains($link, 'https'))
		return $link;
	else
		return 'https://' . $link;
}
?>

<main class="aboutus-container">
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
				<h1 class="single-title"><?php the_title(); ?></h1>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="aboutus-content">
			<h3 class="holder">Fragmentation of our health care system isn’t working. We believe that the most powerful, practical solutions to major health care issues are found when we courageously collaborate—stepping out of silos and often challenging the status quo.</h3>
			<div class="general-intro">
				<div class="left">
					<?php the_content(); ?>
				</div>
				<div class="right">
					<div class="divider">
						<img src="<?=get_template_directory_uri()."/assets/images/divider.png"?>" alt="">
						<h3>We aim to improve care and reduce costs for our patients, families and communities.</h3>
					</div>
				</div>
			</div>
			<?php $abteam_list = get_field('abteam_list', $pageid);
			if ($abteam_list) {
				foreach ($abteam_list as $ab) {
					?>
					<h2><?php echo $ab['ttitle']; ?></h2>
					<div class="gallery">
						<?php if ($ab['member_list']) {
							foreach ($ab['member_list'] as $st) {
								$avt = get_field('user_avatar', 'user_' . $st['ID']);
								?>
								<div class="author-card">
									<a href="<?php echo get_author_posts_url($st['ID']); ?>" class="image-fit"><img
											src="<?php echo $avt['url']; ?>" alt="<?php echo $avt['alt']; ?>"></a>
									<h4><a href="<?php echo get_author_posts_url($st['ID']); ?>"><?php echo $st['display_name']; ?></a>
									</h4>
									<p><?php echo get_field('user_position', 'user_' . $st['ID']); ?></p>
									<ul>
										<?php
										$usocials_list = get_field('usocials_list_copy', 'user_' . $st['ID']);
										if ($usocials_list) {
											foreach ($usocials_list as $us) {
												?>
												<li>
													<a href="<?php echo socials_link($us['link']); ?>" target="_blank" rel="nofollow noopener">
														<img src="<?php echo $us['icon']['url']; ?>" alt="<?php echo $us['icon']['alt']; ?>">
													</a>
												</li>
											<?php }
										} ?>
									</ul>
								</div>
							<?php }
						} ?>
					</div>
				<?php }
			} ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>