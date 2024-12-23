<!DOCTYPE HTML>
<html lang="en-US">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php
	global $page, $paged;
	wp_title('|', true, 'right');
	$site_description = get_bloginfo('description', 'display');
	if ($site_description && (is_home() || is_front_page()))
		echo " | $site_description";
	if ($paged >= 2 || $page >= 2)
		echo ' | ' . sprintf(__('Page %s', 'twentyeleven'), max($paged, $page));
	?></title>
	<?php
	if (is_singular() && get_option('thread_comments'))
		wp_enqueue_script('comment-reply');
	wp_head();
	?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-3WELCMLD2H"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'G-3WELCMLD2H');
	</script>
	<link rel="shortcut icon" type="image/x-icon" href="<?php the_field('favicon', 'option'); ?>" />
</head>

<body <?php body_class(); ?>>
	<header id="header">
		<div class="container">
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
				<p class="pri-color-2" style="margin-bottom: 0">CONTACT</p>
			</div>
		</div>
		<div class="container-header">
			<a href="<?php echo home_url(); ?>" class="logo">
				<img src="<?php the_field('logo', 'option'); ?>" alt="Xhealth" />
			</a>

			<div class="header-right">
				<a href="" class="menu-toggle"></a>
				<nav class="list-menu-header">
					<?php wp_nav_menu(array('theme_location' => 'menu_main')); ?>
				</nav>
			</div>
		</div>

	</header>