<?php get_header(); ?>
<main class="error-container">
	<div class="container">
		<div class="error-content">
			<h1>Oops! <span style="display: block;">That page can't be found.</span> </h1>
			<p>The page requested couldn't be found. This could be a spelling error in the URL or a removed page</span>
			</p>
			<div class="error-img">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/error.svg" alt="" />
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>