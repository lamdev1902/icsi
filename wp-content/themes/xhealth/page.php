<?php
$pageid = get_the_ID();
get_header();
the_post();
?>
<main class="privacy-container">
	<section class="hero-section single-left">
		<div class="container">
			<div class="content">
				<h1 class="single-title"><?php the_title(); ?></h1>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="privacy-content">
			<?php the_content(); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>