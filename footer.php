		<!-- footer -->
		<footer class="footer" role="contentinfo">
		<?php if (is_front_page()) { ?>
			<section class="cid-qSSux2pEJq" id="social-buttons2-l">
				<div class="container">
					<div class="media-container-row">
						<div class="col-md-8 align-center">
							<h2 class="pb-3 mbr-fonts-style display-2"><?php _e('Follow Us!', 'max-mobirise4'); ?></h2>
							<div class="social-list pl-0 mb-0">
								<a data-toggle="modal" data-target="#wechat-modal" href="#" target="_blank">
									<span class="px-2 socicon-wechat socicon mbr-iconfont mbr-iconfont-social"></span>
								</a>
								<a href="https://twitter.com/cccaauinfo" target="_blank">
									<span class="px-2 socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span>
								</a>
								<a href="https://www.linkedin.com/company/cccaorg" target="_blank">
									<span class="px-2 socicon-linkedin socicon mbr-iconfont mbr-iconfont-social"></span>
								</a>
								<a href="https://www.youtube.com/channel/UCQ1iiTC1OMlU_NGvkRZrUDw" target="_blank">
									<span class="px-2 socicon-youtube socicon mbr-iconfont mbr-iconfont-social"></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
			<section class="cid-qSY72lL7qN" id="footer1-1g">
				<div class="container">
					<div class="media-container-row content text-white">
						<div class="col-12 col-md-3">
							<div class="media-wrap">
								<a href="<?php echo get_home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/topbg-1-66x69.png" alt="Mobirise" title=""></a>
							</div>
						</div>
						<div class="col-12 col-md-3 mbr-fonts-style display-7">
							<h5 class="pb-3"><?php _e('Address', 'max-mobirise4'); ?></h5>
							<p class="mbr-text">Level 3, 39-41 York Street, Sydney NSW 2000 Australia</p>
						</div>
						<div class="col-12 col-md-3 mbr-fonts-style display-7">
							<h5 class="pb-3"><?php _e('Contact', 'max-mobirise4'); ?></h5>
							<p class="mbr-text">
								<?php _e('Email: ', 'max-mobirise4'); ?>info@cccaau.org<br>
								<?php _e('Phone: ', 'max-mobirise4'); ?>(02) 8235 5925;<br>(02) 8299 8010
							</p>
						</div>
						<div class="col-12 col-md-3 mbr-fonts-style display-7">
							<h5 class="pb-3"><?php _e('World Clock', 'max-mobirise4'); ?></h5>
							<p class="mbr-text">
								<?php _e('Sydney: ', 'max-mobirise4'); ?><span id="audatetime">SYD</span><br>
								<?php _e('Beijing: ', 'max-mobirise4'); ?><span id="cndatetime">PK</span><br>
								<?php _e('New York: ', 'max-mobirise4'); ?><span id="usdatetime">US</span>
							</p>
						</div>
					</div>
					<div class="media-container-row mbr-white">
						<div class="col-md-6 copyright">
						</div>
						<div class="col-md-3">
							<p class="mbr-text mbr-fonts-style display-7"><span><?php _e('Visitor Count: ', 'max-mobirise4'); ?><?php echo ccca_vcounter_get('counter'); ?><span></p>
						</div>
						<div class="col-md-3">
							<div class="social-list align-right">
								<div class="soc-item">
									<a data-toggle="modal" data-target="#wechat-modal" href="#" target="_blank"><span class="socicon-wechat socicon mbr-iconfont mbr-iconfont-social"></span></a>
								</div>
								<div class="soc-item">
									<a href="https://twitter.com/cccaauinfo" target="_blank"><span class="socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span></a>
								</div>
								<div class="soc-item">
									<a href="https://www.linkedin.com/company/cccaorg" target="_blank"><span class="socicon-linkedin socicon mbr-iconfont mbr-iconfont-social"></span></a>
								</div>
								<div class="soc-item">
									<a href="https://www.youtube.com/channel/UCQ1iiTC1OMlU_NGvkRZrUDw" target="_blank"><span class="socicon-youtube socicon mbr-iconfont mbr-iconfont-social"></span></a>
								</div>
							</div>
						</div>
					</div>
					<div class="footer-lower">
						<div class="media-container-row mbr-white">
							<div class="col-sm-12">
								<hr>
								<p class="mbr-text mbr-fonts-style display-7">
									<?php _e('© Copyright 2018 China Chamber of Commerce in Australia - All Rights Reserved', 'max-mobirise4'); ?><span style="float: right"><?php _e('Powered by ', 'max-mobirise4'); ?><a href="https://au.alibabacloud.com" style="color: white ;" target="_blank">Alibaba Cloud</a></span>
								</p>
							</div>
						</div>
					</div>
				</div>
			</section>
		</footer>
		<!-- /footer -->

		<div id="scrollToTop" class="scrollToTop mbr-arrow-up" style="right: 25px; bottom: 100px;">
			<a style="text-align: center;"><i></i></a>
		</div>
		<div id="sidebarTrigger" class="scrollToTop mbr-arrow-up" style="right: 25px; transform: rotate(0); -webkit-transform: rotate(0);">
			<a data-toggle="modal" data-target="#sidebar-modal" style="text-align: center;"><span class="mbri-search mbr-iconfont mbr-iconfont-btn" style="line-height: 60px;"></span></a>
		</div>
		<!-- input name="animation" type="hidden" -->

		<!-- Modal -->
		<?php if (is_front_page()) { ?>
			<?php $upload_dir = wp_upload_dir(); ?>
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
		<?php } ?>

		<div class="modal fade" id="sidebar-modal" tabindex="-1" role="dialog" aria-labelledby="sidebarModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<h2 class="mbr-section-title align-center mbr-fonts-style display-2 modal-title" id="sidebarModalLabel"><?php _e('Utilities', 'max-mobirise4'); ?></h2>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="wechat-modal" tabindex="-1" role="dialog" aria-labelledby="wechatModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<figure style="margin: 0; text-align: center;">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true" style="position: absolute; top: 5px; right: 5px;">&times;</span>
							</button>
							<img class="wp-image-6813 size-medium" src="https://www.cccaau.org/wp-content/uploads/2018/08/qrcode_for_gh_ce8f8df112db_344-250x250.jpg" alt="澳大利亚中国总商会微信公众号" width="250" height="250" />
							<figcaption><?php _e('CCCA WeChat Offcial Account', 'max-mobirise4'); ?></figcaption>
						</figure>
					</div>
				</div>
			</div>
		</div>

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		ga('send', 'pageview');
		</script>

		<script>
			var audatetime = null, audate = null;
			var cndatetime = null, cndate = null;
			var usdatetime = null, usdate = null;
			var update = function () {
					audate = moment().tz('Australia/Sydney').format('DD-MM-YYYY h:mm A');
					audatetime.html(audate);
			    cndate = moment().tz('Asia/Shanghai').format('DD-MM-YYYY h:mm A');
			    cndatetime.html(cndate);
			    usdate = moment().tz('America/New_York').format('DD-MM-YYYY h:mm A');
			    usdatetime.html(usdate);
			};
			$(document).ready(function(){
					audatetime = $('#audatetime')
					cndatetime = $('#cndatetime')
			    usdatetime = $('#usdatetime')
			    update();
			    setInterval(update, 1000);
			});
		</script>

		<script>
		var isBuilder=$('html').hasClass('is-builder');if(!isBuilder){if(typeof window.initPopupBtnPlugin==='undefined'){window.initPopupBtnPlugin=true;$('section.popup-btn-cards .card-wrapper').each(function(index,el){$(this).addClass('popup-btn');});}}
		</script>

	</body>
</html>
