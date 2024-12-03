<?php 
$pageid = get_the_ID();
get_header();
the_post(); 
?>
<main class="privacy-container">
		<div class="container">
			<div class="privacy-content">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		</div>
	</main>
<?php get_footer(); ?>