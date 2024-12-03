<?php get_header(); ?>
<main class="error-container">
<div class="error-content">
	<div class="error-img">
		<img class="img-left" src="https://www.icsi.org/wp-content/uploads/2024/12/404-icsi-left.svg" alt="">
		<img class="img-right" src="https://www.icsi.org/wp-content/uploads/2024/12/404-icsi-right.svg" alt="">	
	</div>
	<h1>Oops! <span>That page can’t be found.</span> </h1>
	<p>The page requested couldn’t be found.<span>This could be a spelling error in the URL or a revoved page</span></p>
	<a href="<?php echo home_url(); ?>" class="button-blue-shadow-black error-button">SEE ALL POST</a>
</div>
</main>
<?php get_footer(); ?>