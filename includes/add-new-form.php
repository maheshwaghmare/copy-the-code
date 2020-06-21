<?php

$current_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';
$tabs = array(
	'general' => 'General',
	'add-new' => 'Add new',
);

?>
<div class="wrap copy-the-code" id="sync-post">
	<div class="wrap">
		<h1><?php echo esc_html( COPY_THE_CODE_TITLE ); ?> <small>v<?php echo esc_html( COPY_THE_CODE_VER ); ?></small></h1>

		<div id="poststuff">
			<div id="post-body" class="columns-2">
				<div id="post-body-content">

					<style type="text/css">

						#preview {
						    position: relative;
						}
						#preview .inner pre {
						    border: 2px solid #ccd0d4;
						    margin-bottom: 2em;
						}

						/** <pre> tag */
						#preview pre {
						    padding: 1em 2em 1em 2em;
						    margin: 0;
							position: relative;
						}

						/** 'Copy' button and JS. */
						.copy-the-code-inside-wrap .copy-the-code-button {
						    position: absolute;
						    right: 0;
						    top: 0;
						}

						.copy-the-code-inside .copy-the-code-button {
							position: absolute;
							right: 0;
							top: 0;
						}
						.copy-the-code-wrap {
						    display: block;
						    position: relative;
						}

						.copy-the-code-button {
						    background: #e1e3e8;
						    padding: 10px 20px;
						    cursor: pointer;
						    box-shadow: none;
						    color: #424242;
						    font-size: 14px;
						    font-weight: normal;
						    border-radius: 0;
						    text-transform: capitalize;
						    border: none;
						    outline: none;
						}

						.copy-the-code-button:hover {
						    background: #d0d1d6;
						}

						.copy-the-code-outside + * {
						    margin-top: 0;
						}

						.copy-the-code-outside {
						    text-align: right;
						}

						/** Styles */
						.copy-the-code-button[style="svg-icon"] {
						    background: transparent;
						    padding: 0;
						    height: 25px;
						}
						.copy-the-code-button[style="svg-icon"] svg {
						    height: auto;
						    width: 20px;
						    fill: #23282d;
						}
						.copy-the-code-button[style="cover"] {
						    position: absolute;
						    left: 0;
						    right: 0;
						    top: 0;
						    bottom: 0;
						    width: 100%;
						    opacity: 0;
						    background: rgba(0, 0, 0, 0.5);
						    font-weight: bold;
						    color: #fff;
						    transition: all 0.3s ease-in-out;
						}

						pre:hover .copy-the-code-button[style="cover"] {
						    opacity: 1;
						}

						.copy-the-code-inside-wrap .copy-the-code-button[style="svg-icon"] {
						    padding: 10px;
						}

					</style>

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

									<!-- <tr>
										<th scope="row"><?php _e( 'Copy Content As', 'copy-the-code' ); ?></th>
										<td>
											<fieldset>
												<select name="copy-as">
													<option value="html" <?php selected( $data['copy-as'], 'html' ); ?>><?php echo 'HTML'; ?></option>
													<option value="text" <?php selected( $data['copy-as'], 'text' ); ?>><?php echo 'Text'; ?></option>
												</select>
												<p class="description"><?php _e( 'Copy the content as Text or HTML.', 'copy-the-code' ); ?></p>
											</fieldset>
										</td>
									</tr> -->
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
				</div>
			</div>
		</div>
	</div>
</div>
<?php