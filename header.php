<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="China Chamber of Commerce in Australia (or CCCA for short) was founded in 2006 and is a non-profit national organisation jointly formed by trade associations representing Chinese investors across Australia.">
		<meta name="msvalidate.01" content="AF0094EE12AE7FDE7206CB4E22C5FBF7" />
		<meta name="keywords" content="China Chamber of Commerce in Australia,CCCA,CCCAAU,澳大利亚中国总商会">
		<meta http-equiv="content-language" content="CN,EN">
		<meta name="revisit-after" content="7 days">
		<meta name="robots" content="index, follow">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>

			<!-- header -->
			<header class="header clear" role="banner">

				<section class="menu cid-qSS4YBbhlJ" once="menu" id="menu1-0">
						<nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm" <?php if ( is_admin_bar_showing() ) echo 'style=" margin-top: 32px;"';?>>
							<div class="media-container-row">
								<div class="menu-logo">
				        		<div class="navbar-brand">
				        				<span class="navbar-logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/topbg-1-66x69.png" alt="China Chamber of Commerce in Australia" title="China Chamber of Commerce in Australia" style="height: 4.6rem;"></a></span>
				        				<span class="navbar-caption-wrap"><a class="navbar-caption text-white display-4" href="<?php echo home_url(); ?>"><?php _e('澳大利亚中国总商会<br>China Chamber of Commerce in Australia'); ?></a></span>
										</div>
				        </div>
							</div>
							<div class="media-container-row">
								<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#header-menu" aria-controls="header-menu" aria-expanded="false" aria-label="Toggle navigation">
		        				<div class="hamburger">
		        						<span></span>
		        						<span></span>
		        						<span></span>
		        						<span></span>
		        				</div>
		        		</button>
								<?php if ( is_user_logged_in() ) { ?>
										<?php ccca_create_mbr_menu('header-menu-logged-in'); ?>
				        <?php } else { ?>
									<?php ccca_create_mbr_menu('header-menu'); ?>
								<?php } ?>
							</div>
						</nav>
				</section>

			</header>
			<!-- /header -->
