<?php get_header(); ?>
<?php $upload_dir = wp_upload_dir(); ?>

	<main role="main">

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<section class="carousel slide cid-qVZi7qPycz" data-interval="false" id="slider1-2l">
					<div class="full-screen">'
				  <div class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="4000">
						<div class="carousel-inner" role="listbox">'
							<?php $count = 0; ?>
							<?php $custom_loop = new WP_Query(array( 'post_type' => 'slider-items', 'posts_per_page' => 5 )); ?>
							<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); ?>
								<div class="carousel-item slider-fullscreen-image <?php if ( $count == 0 ) { echo 'active';} ?>" data-bg-video-slide="false" style="background-image: url(<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url('full'); } else { echo get_template_directory_uri() . '/assets/images/1.jpg'; }  ?>);">
									<div class="container container-slide">
										<div class="image_wrapper">
											<div class="mbr-overlay"></div>
											<img src="<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url('full'); } else { echo get_template_directory_uri() . '/assets/images/1.jpg'; } ?>">
											<div class="carousel-caption justify-content-center">
												<div class="col-10 align-center">
													<?php $meta = get_post_meta($post-> ID, 'advanced_options_destination_link'. $field ['id'], true); ?>
													<h2 class="mbr-fonts-style display-1"><a class="text-white" href="<?php echo $meta; ?>" title="<?php the_title(); ?>" target="_blank" rel="noopener"><?php the_title(); ?></a></h2>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php $count = $count + 1; ?>
							  <?php endwhile; wp_reset_postdata(); ?>
							</div>
							<?php if ( $count > 1 ) { ?>
								<a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#slider1-2l"><span aria-hidden="true" class="mbri-left mbr-iconfont"></span><span class="sr-only">Previous</span></a>
								<a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#slider1-2l"><span aria-hidden="true" class="mbri-right mbr-iconfont"></span><span class="sr-only">Next</span></a>
						  <?php } ?>
						</div>
						<div class="mbr-arrow hidden-sm-down" aria-hidden="true">
							<a href="#features13-1k"><i class="mbri-down mbr-iconfont"></i></a>
						</div>
					</div>
				</section>

				<style type="text/css">
					.wprss-feed-meta {
		        		display: none;
		      		}
					.text-white.feed-item-link a {
		          		color: #ffffff;
		        	}
				</style>

				<section class="features13 cid-qSYbT5BsHU" id="features13-1k">
				    <div class="container">
				        <div class="media-container-row">
				            <div class="card col-12 col-md-6 p-5 mx-3 align-center col-lg-4">
				                <div class="card-img">
													<div class="mbr-overlay"></div>
				                    <a href="#" data-toggle="modal" data-target="#today-headline"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/mbr-1-1200x800.jpg" alt="<?php _e('Today\'s Headline', 'max-mobirise4'); ?>" title="<?php _e('Today\'s Headline', 'max-mobirise4'); ?>"></a>
				                </div>
				                <h4 class="card-title py-2 mbr-fonts-style display-5 text-white"><a href="#" class="text-white" data-toggle="modal" data-target="#today-headline"><?php _e('Today\'s Headline', 'max-mobirise4'); ?></a></h4>
				            </div>
				            <div class="card col-12 col-md-6 p-5 mx-3 align-center col-lg-4">
				                <div class="card-img">
													<div class="mbr-overlay"></div>
				                    <a href="#" data-toggle="modal" data-target="#finance-figure"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/mbr-1200x771.jpg" alt="<?php _e('Finance Figures', 'max-mobirise4'); ?>" title="<?php _e('Finance Figures', 'max-mobirise4'); ?>"></a>
				                </div>
				                <h4 class="card-title py-2 mbr-fonts-style display-5"><a href="#" class="text-white" data-toggle="modal" data-target="#finance-figure"><?php _e('Finance Figures', 'max-mobirise4'); ?></a></h4>
				            </div>
				            <div class="card col-12 col-md-6 p-5 mx-3 align-center col-lg-4">
				                <div class="card-img">
													<div class="mbr-overlay"></div>
				                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mbr-3-1200x800.jpg" alt="<?php _e('Event Registration', 'max-mobirise4'); ?>" title="<?php _e('Event Registration', 'max-mobirise4'); ?>">
				                </div>
				                <h4 class="card-title py-2 mbr-fonts-style display-5"><a href="https://www.cccaau.org/up-coming-events/" class="text-white"><?php _e('Event Registration', 'max-mobirise4'); ?></a></h4>
				            </div>
				        </div>
				    </div>

						<!-- Modal -->
						<?php $fileName = $upload_dir['basedir'] . '/forex_ratios.php'; ?>
						<?php include $fileName;?>

						<div class="modal fade" id="today-headline" tabindex="-1" role="dialog" aria-labelledby="HeadlinesToday" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="mbr-section-title align-center mbr-fonts-style display-2 modal-title" id="HeadlinesToday"><?php _e('Today\'s Headline', 'max-mobirise4'); ?></h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="<?php _e('Close', 'max-mobirise4'); ?>">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<?php echo do_shortcode('[' . __('wp-rss-aggregator source="2891"', 'max-mobirise4') . ' limit="20" pagination="off" links_before=\'<ul class="mbr-text mbr-fonts-style display-7 rss-aggregator">\' link_before=\'<li class="feed-item-link">\']'); ?>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-md btn-primary display-4" data-dismiss="modal"><?php _e('Close', 'max-mobirise4'); ?></button>
									</div>
								</div>
							</div>
						</div>
				</section>

				<section class="features18 popup-btn-cards cid-qSS90kYbjZ" id="features18-7">
					<div class="container">
						<h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2"><?php _e('Chamber News', 'max-mobirise4'); ?></h2>
						<div class="media-container-row pt-5 ">
							<?php $custom_loop = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => 3, 'category_name' => 'chamber', 'tag' => 'news')); ?>
							<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); ?>
								<div class="card px-3 col-12 col-md-6 col-lg-4">
									<div class="card-wrapper ">
										<div class="card-img">
											<div class="mbr-overlay"></div>
											<div class="mbr-section-btn text-center">
												<a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-primary display-4"><?php _e('View More', 'max-mobirise4'); ?></a>
											</div>
											<?php if ( has_post_thumbnail() ) { ?>
												<?php the_post_thumbnail(); ?>
											<?php } else { ?>
												<img src="<?php echo get_template_directory_uri() . '/assets/images/mbr-1-1200x800.jpg'; ?>" alt="<?php the_title(); ?>" title="">
											<?php } ?>
										</div>
										<div class="card-box">
											<h4 class="card-title mbr-fonts-style display-7"><?php the_title(); ?></h4>
											<p class="mbr-text mbr-fonts-style align-left display-7 fixed-height"><?php ccca_the_excerpt('ccca_excerpt'); ?></p>
											<p class="mbr-text mbr-fonts-style align-left display-7 view-more">......<a href="<?php echo esc_url(get_permalink()); ?>"><?php _e('View More', 'max-mobirise4'); ?></a></p>
										</div>
									</div>
								</div>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					</div>
				</section>

				<section class="mbr-section info1 cid-qSSa4PGlfl" id="info1-8">
					<div class="container">
						<div class="row py-3 justify-content-center content-row">
							<div class="media-container-column title col-12 col-md-8">
								<h2 class="align-center mbr-bold mbr-fonts-style display-2"><?php _e('Want more interaction with us?', 'max-mobirise4'); ?></h2>
							</div>
							<div class="media-container-column col-12 col-md-4">
								<div class="mbr-section-btn align-center py-4">
			  						<a class="btn btn-primary display-4" href="#form1-k" style="font-size: 1.5rem;"><?php _e('Contact Us Now!', 'max-mobirise4'); ?></a>
			  					</div>
							</div>
						</div>
					</div>
				</section>

				<section class="features11 mbr-section content4 cid-qSShVnZyJK" id="content4-p">
					<div class="event_loop container">
						<div class="media-container-row py-3">
							<div class="title col-12 col-md-8">
								<h2 class="mbr-section-title align-center mbr-fonts-style display-2"><?php _e('Recent Events', 'max-mobirise4'); ?></h2>
							</div>
						</div>
						<?php $custom_loop = new WP_Query(array( 'post_type' => 'event', 'posts_per_page' => 5, 'meta_key' => 'event_begin', 'orderby' => 'meta_value_num', 'order' => 'DESC')); ?>
						<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); ?>
							<div class="event_item media-container-row pt-5 pb-3">
								<div class="mbr-figure" style="width: 40%;">
									<a href="<?php echo esc_url(get_permalink()); ?>"> <?php the_post_thumbnail(); ?></a>
								</div>
								<div class="align-left aside-content">
									<h2 class="mbr-title mbr-fonts-style display-3"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>
									<div class="mbr-section-text">
										<p class="mbr-text mt-3 mbr-light mbr-fonts-style display-5 fixed-height"><?php ccca_the_excerpt('ccca_excerpt'); ?></p>
										<p class="mbr-text mbr-light mbr-fonts-style display-5 view-more">...<a href="<?php echo esc_url(get_permalink()); ?>"><?php _e('View More', 'max-mobirise4'); ?></a></p>
									</div>
								</div>
							</div>
						<?php endwhile; wp_reset_postdata(); ?>
					 </div>
				 </section>

				<section class="mbr-section form1 cid-qSSuaa33xs" id="form1-k">
					<div class="container">
						<div class="row justify-content-center">
							<div class="title col-12 col-lg-8">
								<h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2"><?php _e('Contact Us', 'max-mobirise4'); ?></h2>
								<h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5"><?php _e('Thank you for viewing our site. We would be grateful if your great idea can be left.', 'max-mobirise4'); ?></h3>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="row justify-content-center">
							<div class="media-container-column col-lg-10">
								<?php echo do_shortcode(__('[contact-form-7 id="125" title="Home Contact Form English" html_class="mbr-form"]', 'max-mobirise4')); ?>
							</div>
						</div>
					</div>
				</section>

				<section class="clients cid-qUC8WQ4dl8" id="clients-1n">
					<div class="container mb-5">
						<div class="media-container-row">
							<div class="col-12 align-center">
								<h2 class="mbr-section-title pb-3 mbr-fonts-style display-2"><?php _e('Our Partners', 'max-mobirise4'); ?></h2>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="carousel slide" data-ride="carousel" role="listbox">
							<?php $fileName = $upload_dir['basedir'] . '/partner_block.php'; ?>
							<?php include $fileName; ?>
							<div class="carousel-controls">
								<a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev">
									<span aria-hidden="true" class="mbri-left mbr-iconfont"></span>
									<span class="sr-only"><?php _e('Previous', 'max-mobirise4'); ?></span>
								</a>
								<a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next">
									<span aria-hidden="true" class="mbri-right mbr-iconfont"></span>
									<span class="sr-only"><?php _e('Next', 'max-mobirise4'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</section>

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>
				<h2><?php _e( 'Sorry, nothing to display.', 'max-mobirise4' ); ?></h2>
			</article>
			<!-- /article -->

		<?php endif; ?>

	</main>

<?php get_footer(); ?>
