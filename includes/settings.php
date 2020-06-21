<div class="postbox-container" id="postbox-container-1">
							<div id="side-sortables" style="">
								<div class="postbox">
									<h2 class="hndle"><span><?php _e( 'Getting Started', 'copy-the-code' ); ?></span></h2>
									<div class="inside">
										<ul class="items">
											<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#how-does-it-work"><?php esc_html_e( 'How does it work?', 'copy-the-code' ); ?></a></li>
											<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#what-is-the-selector"><?php esc_html_e( 'What is the selector?', 'copy-the-code' ); ?></a></li>
											<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#example-1-using-html-tag-as-a-selector"><?php esc_html_e( 'Example 1 - Using HTML tag as a selector', 'copy-the-code' ); ?></a></li>
											<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#example-2-using-class-as-a-selector"><?php esc_html_e( 'Example 2 - Using class as a selector', 'copy-the-code' ); ?></a></li>
											<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#example-3-using-id-as-a-selector"><?php esc_html_e( 'Example 3 - Using ID as a selector', 'copy-the-code' ); ?></a></li>
											<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#example-4-using-nested-selector"><?php esc_html_e( 'Example 4 - Using nested selector', 'copy-the-code' ); ?></a></li>
											<li>» <a style="text-decoration: none;" target="_blank" href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/#example-5-copy-content-as-html-as-text"><?php esc_html_e( 'Example 5 - Copy content as HTML as Text', 'copy-the-code' ); ?></a></li>
										</ul>
									</div>
								</div>

								<div class="postbox">
									<h2 class="hndle"><span><?php _e( 'Support', 'copy-the-code' ); ?></span></h2>
									<div class="inside">
										<p><?php _e( 'Do you have any issue with this plugin? Or Do you have any suggessions?', 'copy-the-code' ); ?></p>
										<p><?php _e( 'Please don\'t hesitate to <a href="http://maheshwaghmare.wordpress.com/?p=999" target="_blank">send request »</a>.', 'copy-the-code' ); ?></p>
									</div>
								</div>

								<?php
								$response = wp_dev_remote_request_get( 'https://maheshwaghmare.com/wp-json/wp/v2/posts/?_fields=id,title,link&per_page=5' );
								if( $response['success'] ) {
								?>
									<div class="postbox">
										<h2 class="hndle"><span><?php _e( 'Latest News', 'copy-the-code' ); ?></span></h2>
										<div class="inside">
											<ul>
												<?php foreach ($response['data'] as $key => $item) { ?>
													<li data-id="<?php echo esc_attr( $item['id'] ); ?>">
														» <a style="text-decoration: none;" href="<?php echo esc_attr( $item['link'] ); ?>?utm_source=copy-the-code&utm_medium=plugin&utm_campaign=wp.org" target="_blank"><?php echo esc_html( $item['title']['rendered'] ); ?>
														</a>
													</li>
												<?php } ?>
											</ul>
											<p><a href="https://maheshwaghmare.com/blog/?utm_source=copy-the-code&utm_medium=plugin&utm_campaign=wp.org" target="_blank"><?php esc_html_e( 'Read More »', 'copy-the-code' ); ?></a></p>
										</div>
									</div>
								<?php } ?>

								<div class="postbox">
									<h2 class="hndle"><span><?php _e( 'Donate', 'copy-the-code' ); ?></span></h2>
									<div class="inside">
										<p><?php _e( 'Would you like to support the advancement of this plugin?', 'copy-the-code' ); ?></p>
										<a href="https://www.paypal.me/mwaghmare7/" target="_blank" class="button button-primary"><?php _e( 'Donate Now!', 'copy-the-code' ); ?></a>
									</div>
								</div>
							</div>
						</div>