<?php if ( $attributes['show_title'] ) : ?>
    <h3><?php _e( 'Register', 'max-event' ); ?></h3>
<?php endif; ?>

<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
    <?php foreach ( $attributes['errors'] as $error ) : ?>
        <p><?php echo $error; ?></p>
    <?php endforeach; ?>
<?php endif; ?>

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
<ul>
<?php $custom_loop = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => 20, 'category_name' => chanmer )); ?>
<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); ?>
	<li><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></li>
<?php endwhile; ?>
<?php if (function_exists("ccca_pagination")) { ccca_pagination($custom_loop->max_num_pages); } ?>
<?php wp_reset_postdata(); ?>
</ul>
