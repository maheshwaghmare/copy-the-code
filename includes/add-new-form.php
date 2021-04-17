<?php
/**
 * Add new Page
 *
 * @package Copy the Code
 * @since 2.0.0
 */

?>
<div class="wrap copy-the-code">
	<div class="wrap">
		<h1><?php echo esc_html( COPY_THE_CODE_TITLE ); ?> <small>v<?php echo esc_html( COPY_THE_CODE_VER ); ?></small></h1>

		<p class="description"><?php _e( 'Add the new button as per your requirement. See more with <a href="https://maheshwaghmare.com/doc/copy-anything-to-clipboard/" target="_blank">getting started guide</a>', 'copy-the-code' ); ?></p>

		<div id="poststuff">
			<div id="post-body" class="columns-2">
				<div id="post-body-content">

					<form enctype="multipart/form-data" method="post">
						<div class="tabs">
							<div id="tab-general">
								<table class="form-table">
									<tr>
										<th scope="row"><?php _e( 'Selector', 'copy-the-code' ); ?></th>
										<td>
											<fieldset>
												<input type="text" name="selector" class="regular-text" value="<?php echo esc_attr( $data['selector'] ); ?>" />
												<p class="description"><?php _e( 'It is the selector which contain the content  which you want to copy.<br/>Default its &lt;pre&gt; html tag.', 'copy-the-code' ); ?></p>
											</fieldset>
										</td>
									</tr>

									<tr>
										<th scope="row"><?php _e( 'Style', 'copy-the-code' ); ?></th>
										<td>
											<fieldset>
												<select name="style" class="style">
													<option value="button">Button</option>
													<option value="svg-icon">SVG Icon</option>
													<option value="cover">Cover</option>
												</select>

											</fieldset>
											<p class="description"><?php _e( 'Select the button style.', 'copy-the-code' ); ?></p>
										</td>
									</tr>
									<tr>
										<th scope="row"><?php _e( 'Button Position', 'copy-the-code' ); ?></th>
										<td>
											<fieldset>
												<select name="button-position" class="button-position">
													<option value="inside" <?php selected( $data['button-position'], 'inside' ); ?>><?php echo 'Inside'; ?></option>
													<option value="outside" <?php selected( $data['button-position'], 'outside' ); ?>><?php echo 'Outside'; ?></option>
												</select>
												<p class="description"><?php _e( 'Button Position Inside/Outside. Default Inside.', 'copy-the-code' ); ?></p>
											</fieldset>
										</td>
									</tr>									
								</table>
							</div>
							<div id="tab-style">
								<table class="form-table">
									<tr>
										<th scope="row"><?php _e( 'Button Text', 'copy-the-code' ); ?></th>
										<td>
											<fieldset>
												<input type="text" name="button-text" class="regular-text" value="<?php echo esc_attr( $data['button-text'] ); ?>" />
												<p class="description"><?php _e( 'Copy button text. Default \'Copy\'.', 'copy-the-code' ); ?></p>
											</fieldset>
										</td>
									</tr>
									<tr>
										<th scope="row"><?php _e( 'Button Copy Text', 'copy-the-code' ); ?></th>
										<td>
											<fieldset>
												<input type="text" name="button-copy-text" class="regular-text" value="<?php echo esc_attr( $data['button-copy-text'] ); ?>" />
												<p class="description"><?php _e( 'Copy button text which appear after click on it. Default \'Copied!\'.', 'copy-the-code' ); ?></p>
											</fieldset>
										</td>
									</tr>
									<tr>
										<th scope="row"><?php _e( 'Button Title', 'copy-the-code' ); ?></th>
										<td>
											<fieldset>
												<input type="text" name="button-title" class="regular-text" value="<?php echo esc_attr( $data['button-title'] ); ?>" />
												<p class="description"><?php _e( 'It is showing on hover on the button. Default \'Copy to Clipboard\'.', 'copy-the-code' ); ?></p>
											</fieldset>
										</td>
									</tr>
								</table>
							</div>
						</div>

						<input type="hidden" name="message" value="saved" />
						<?php wp_nonce_field( 'copy-the-code-nonce', 'copy-the-code' ); ?>

						<?php submit_button( 'Create' ); ?>
					</form>
				</div>
				<div class="postbox-container" id="postbox-container-1">
					<h3>Preview:</h3>
					<div id="preview"></div>

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

					<div class="postbox">
						<h2 class="hndle"><span><?php _e( 'Donate', 'copy-the-code' ); ?></span></h2>
						<div class="inside">
							<p><?php _e( 'Would you like to support the advancement of this plugin?', 'copy-the-code' ); ?></p>
							<a href="https://www.paypal.me/mwaghmare7/" target="_blank" class="button button-primary"><?php _e( 'Donate Now!', 'copy-the-code' ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
