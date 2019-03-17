<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<style type="text/css">
	.cid-qUC8WLfjwn {
		<?php if ( has_post_thumbnail() ) { ?>
		background-image: url("<?php the_post_thumbnail_url('full'); ?>");
		<?php } else { ?>
		background-image: url("<?php echo get_template_directory_uri(); ?>/assets/images/jumbotron.jpg");
		<?php } ?>
	}
	</style>

	<main role="main" <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<section class="mbr-section content5 cid-qUC8WLfjwn mbr-parallax-background" id="content5-1y">
			<div class="mbr-overlay" style="opacity: 0.4; background-color: rgb(35, 35, 35);"></div>
			<div class="container">
				<div class="media-container-row">
					<div class="title col-12">
						<h2 class="align-center mbr-bold mbr-white mbr-fonts-style display-1"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					</div>
				</div>
			</div>
		</section>

		<section class="features11 cid-qSShVnZyJK" id="content4-p">
			<div class="container">
				<div class="media-container-row">
					<div class="mbr-text col-9 col-md-9 mbr-fonts-style display-7"><?php the_content(); ?></div>
					<div class="mbr-text col-3 col-md-3 mbr-fonts-style display-7"><?php get_sidebar(); ?></div>
				</div>
				<div class="media-container-row">
					<!-- post details -->
					<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
					<span class="author"><?php _e( 'Published by', 'max-mobirise4' ); ?> <?php the_author_posts_link(); ?></span>
					<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'max-mobirise4' ), __( '1 Comment', 'max-mobirise4' ), __( '% Comments', 'max-mobirise4' )); ?></span>
					<!-- /post details -->
				</div>
				<div class="media-container-row">
					<?php the_tags( __( 'Tags: ', 'max-mobirise4' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>
					<p><?php _e( 'Categorised in: ', 'max-mobirise4' ); the_category(', '); // Separated by commas ?></p>
					<p><?php _e( 'This post was written by ', 'max-mobirise4' ); the_author(); ?></p>
					<?php edit_post_link(); // Always handy to have Edit Post Links available ?>
					<?php comments_template(); ?>
				</div>
			</div>
		</section>
	</main>
<?php endwhile; ?>
<?php else: ?>
	<main role="main">
		<section class="mbr-section article content1 cid-qSSbnPkOyI">
			<div class="container">
				<div class="media-container-row">
					<div class="mbr-text col-12 col-md-8 mbr-fonts-style display-7">
						<h2><?php _e( 'Sorry, nothing to display.', 'max-mobirise4' ); ?></h2>
					</div>
				</div>
			</div>
		</section>
	</main>
<?php endif; ?>

<?php get_footer(); ?>
