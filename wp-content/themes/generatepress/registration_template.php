<?php
/**
 * Template Name: Registration Template
 *
 * @package GeneratePress
 */

get_header(); ?>
	
	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?>>
			<?php do_action('generate_before_main_content'); ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) : ?>
					<div class="comments-area">
						<?php comments_template(); ?>
					</div>
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>
			<?php do_action('generate_after_main_content'); ?>
		</main><!-- #main -->
	</div><!-- #primary -->
	
	<script src="/wp-content/themes/generatepress/js/form.js"></script>
	<script src="/wp-content/themes/generatepress/js/camp-registration.js"></script>
<?php 
do_action('generate_sidebars');
get_footer();
