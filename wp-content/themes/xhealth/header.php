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
			<div class="header-top">
				<?php $socials = get_field('socials', 'option');
				if ($socials) {
					?>
					<div class="list-social-header">
						<ul>
							<?php foreach ($socials as $so) { ?>
								<li>
									<a href="<?php echo $so['link']; ?>" target="_blank" rel="nofollow">
										<img src="<?php echo $so['icon']; ?>" alt="Social" />
									</a>
								</li>
							<?php } ?>
						</ul>
						<a href="#" class="contact-header">Contact</a>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="container-header">
			<div class="header-bottom">
				<a href="<?php echo home_url(); ?>" class="logo">
					<img src="<?php the_field('logo', 'option'); ?>" alt="Xhealth" />
				</a>
				<div class="header-right">
					<nav class="list-menu-header">
						<?php wp_nav_menu(array('theme_location' => 'menu_main')); ?>
					</nav>
					<a href="" class="menu-toggle"></a>
				</div>
			</div>
		</div>

	</header>