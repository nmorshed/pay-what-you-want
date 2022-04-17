<?php

	$pwyw_enable_plugin = get_option( 'pwyw_enable_plugin', PWYW_ENABLE_PLUGIN );
	$plugin_enabled = ( $pwyw_enable_plugin != 'disabled' ) ? 'checked' : '';
	
	$pwyw_allow_own_price = get_option( 'pwyw_allow_own_price', PWYW_ALLOW_OWN_PRICE );
	$allow_own_price = ( $pwyw_allow_own_price != 'disabled' ) ? 'checked' : '';
	
	$pwyw_products_area = get_option( 'pwyw_products_area', 1 );
	$pwyw_price_group = get_option( 'pwyw_price_group', 1 );
	
	$pwyw_product_categories = get_option( 'pwyw_product_categories' );
	$pwyw_price_fraction = get_option( 'pwyw_price_fraction', PWYW_PRICE_FRACTION );
	$pwyw_predefined_price_set = get_option( 'pwyw_predefined_price_set' );
	$pwyw_min_price = get_option( 'pwyw_min_price', PWYW_MIN_PRICE );
	
	$all_products = '';
	$specific_categories = '';
	$based_on_product_price = '';
	$predefined_price = '';

	if ( 1 == $pwyw_products_area ) {
		$all_products = 'checked';
	}else{
		$specific_categories = 'checked';
	}

	if ( 1 == $pwyw_price_group ) {
		$based_on_product_price = 'checked';
	}else{
		$predefined_price = 'checked';
	}
?>

<div id="bw-pwyw">

	<h1> <?php _e('Pay What You Want', 'pwyw'); ?> </h1>
	<hr />

	<form id="pwyw-settings-form" method='POST' action="<?php echo admin_url('admin-post.php'); ?>">

		<?php wp_nonce_field('pwyw'); ?>

		<input type="hidden" name="action" value="pwyw_admin_settings">

		<table class="form-table" role="presentation">

			<tbody>

				<tr>
					<th scope="row">
						<label for="pwyw_enable_plugin"> <?php _e( 'Enable This Plugin', 'pwyw' ); ?> </label>
					</th>
					<td>
						<input name="pwyw_enable_plugin" type="checkbox" id="pwyw_enable_plugin" value="enabled" <?php echo $plugin_enabled; ?> />
						<label for="pwyw_enable_plugin"> Enable </label>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label><?php _e('Set this option for:', 'pwyw'); ?></label>
					</th>
					<td>
						<div>
							<input type='radio' id='pwyw_all_products' name='pwyw_products_area' value="1" <?php echo $all_products; ?> >
							<label for='pwyw_all_products'><?php _e('All products', 'pwyw'); ?></label>
						</div>

						<div class="<?php echo $specific_categories; ?>" >
							<input type='radio'id='pwyw_specific_categories' name='pwyw_products_area' value="0" <?php echo $specific_categories; ?>>
							<label for='pwyw_specific_categories'><?php _e('Some specific categories', 'pwyw'); ?></label>
							
							<div class="pwyw_product_categories pwyw-open">
								<?php pwyw_product_categories_checkbox(); ?>
							</div>
						</div>
						
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label><?php _e('Price set will depend on:', 'pwyw'); ?></label>
					</th>
					<td>
						<div class="<?php echo $based_on_product_price; ?>">
							<input type='radio' id='pwyw-product-price' name='pwyw_price_group' value="1" <?php echo $based_on_product_price; ?>>
							<label for='pwyw-product-price'><?php _e('Product price (How many pieces it will be?)', 'pwyw'); ?></label>
							
							<div id="pwyw_price_fraction" class="pwyw-open">
								<input type="number" name="pwyw_price_fraction" value="<?php echo $pwyw_price_fraction; ?>">
							</div>
						</div>

						<div class="<?php echo $predefined_price; ?>">
							<input type='radio' id='pwyw_predefined_price' name='pwyw_price_group' value="0" <?php echo $predefined_price; ?>>
							<label for='pwyw_predefined_price'><?php _e('A predefined set of price', 'pwyw'); ?></label>
							
							<div class="pwyw-open">
								<div id="pwyw_predefined_price_set">
									<?php pwyw_predefined_price_set(); ?>
								</div>
								<div id="pwyw-add-price">
									Add More Price +
								</div>
							</div>
						</div>
						
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="pwyw-allow-own-price"> <?php _e( 'Allow Custmer To Enter Own Price', 'pwyw' ); ?> </label>
					</th>
					<td>
						<input name="pwyw_allow_own_price" type="checkbox" id="pwyw-allow-own-price" value="enabled" <?php echo $allow_own_price; ?> />
						<label for="pwyw-allow-own-price"> Enable </label>
					</td>
				</tr>

				<tr>
					<th scope="row">
						<label for="pwyw-allow-own-price"> <?php _e( 'Minimun Price', 'pwyw' ); ?> </label>
					</th>
					<td>
						<input type="number" pattern='[0-9]+(\\.[0-9][0-9]?)?' name="pwyw_min_price" value="<?php echo $pwyw_min_price; ?>">
					</td>
				</tr>

			</tbody>

		</table>

		<div>
			<?php submit_button('Submit'); ?>
		</div>

	</form>
</div>