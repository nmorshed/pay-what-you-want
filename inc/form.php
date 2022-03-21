
<h1>
	<?php _e('Price Variation', 'pwyw'); ?>
</h1>

<?php
	// wp_nonce_field('pwyw');
?>

<h3>
	<?php _e('Do you want to enable this for all products?', 'pwyw'); ?>
</h3>

<form method='POST' action="<?php echo admin_url('admin-post.php'); ?>">

	<?php
		wp_nonce_field('pwyw');

		$pwyw_products = get_option('pwyw_products');
		$pwyw_price = get_option('pwyw_price');
		$pwyw_various_price_name = get_option('pwyw_various_price_name');
		$pwyw_fixed_price_name = get_option('pwyw_fixed_price_name');
		// $pwyw_each_category = get_option('pwyw_each_category');

	?>

	<p>
		<input type='radio' id='pwyw_all_products' name='pwyw_products' value="0" <?php checked( '0', $pwyw_products ); ?>>
	  <label for='pwyw_all_products'><?php _e('Yes, we want this for all products', 'pwyw'); ?></label>
	</p>

	<p>
		<input type='radio' id='pwyw_categorized_products' name='pwyw_products' value="1" <?php $category_checked = checked( '1', $pwyw_products ); ?>>
	  <label for='pwyw_categorized_products'><?php _e('No, we want this for the products of a few specific categories', 'pwyw'); ?></label>
	</p>

	<?php
		// Different categories' products
		$all_product_categories = get_categories( ['taxonomy' => 'product_cat'] );
		/* echo '<pre>';
		print_r($all_product_categories);
		echo '</pre>'; */

		// global $wp_roles;

		/* echo '<pre>';
		print_r($wp_roles);
		echo '</pre>'; */
	?>

	<div class="pwyw_product_categories<?php if($category_checked) echo '_active'; ?>">
		<?php

			$selected = '';
			$selected_category = get_option('pwyw_each_category');

			foreach($all_product_categories as $category) {
				// print_r($category->cat_name);
				$each_category = $category->cat_name;
				
				/* echo '<pre>';
				print_r($category);
				echo '</pre>'; */

				// echo $each_category;
				$category = (array) $category;

				$selected = ( in_array( $each_category, $selected_category ) ) ? 'checked' : '';

				echo "<input type='checkbox' name='pwyw_each_category[]' value='$each_category' id='pwyw_$each_category' $selected /> <label for='pwyw_$each_category'>$each_category </label>";
				echo '<br>';

				// value='%s' er porer %s is PLACEHOLDER (see html form placeholder for details)
				/* printf("<input type='checkbox' name='pwyw_each_category[]' value='%s' %s /> %s <br/>", $each_category, $selected, $each_category);
				echo '<br>'; */
			}
		?>
	</div>	

	<h3>
		<?php _e('Which type of price is your requirement?', 'pwyw'); ?>
	</h3>

	<p>
		<input type='radio' id='pwyw_various_price' name='pwyw_price' value='0' <?php $various_checked = checked( '0', $pwyw_price ); ?>>
	  <label for='pwyw_various_price'><?php _e('Depending on product price, prices may vary', 'pwyw'); ?></label>
	</p>

	<!-- various price dropdown field -->
	<!-- $various_checked == true hoile, class change to pwyw_various_price_dropdown_active -->
	<div class = "pwyw_various_price_dropdown<?php if($various_checked) echo '_active'; ?>">
		<p>
			<label for='pwyw_various_price'><?php _e('How many options will the prices vary', 'pwyw'); ?></label>
		</p>
		<p>
			<input type='number' id='pwyw_various_price_id' name='pwyw_various_price_name' value="<?php echo esc_attr($pwyw_various_price_name); ?>" min='2' max='10'>
		</p>
	</div>	<!-- End of various price dropdown field -->

	<p>
		<input type='radio' id='pwyw_fixed_price' name='pwyw_price' value='1' <?php $fixed_checked = checked( '1', $pwyw_price ); ?>>
	  <label for='pwyw_fixed_price'><?php _e('We want fixed price', 'pwyw'); ?></label>
	</p>

	<!-- fixed price dropdown field -->
	<!-- $fixed_checked == true hoile, class change to pwyw_fixed_price_dropdown_active; else a kisu thakle, "echo '_active'; ?>" er pore lekhte hbey -->
	<div class = "pwyw_fixed_price_dropdown<?php if($fixed_checked) echo '_active'; ?>">
		<!-- pwyw_fixed_price_values -->
		<div class='wrapper'>

			<?php foreach ($pwyw_fixed_price_name as $single_price): ?>
				
				<div class='input_parent'>
					<input type='number' class='pwyw_fixed_price' name='pwyw_fixed_price_name[]' placeholder='Enter a Price' value="<?php echo esc_attr($single_price); ?>" min='1' />
					<a href='' class='pwyw_remove'>x</a>
					<!-- javascript:void(0) is equivalent to script e.preventDefault() -->
				</div>

			<?php endforeach; ?>

		</div>	<!-- End of wrapper -->
			
		<div>
			<p>
				<input type='button' value='+ Add More' id='pwyw_append' />
			</p>
		</div>


	</div>	<!-- End of fixed price dropdown field -->

	<!-- submit button a click krar por save krte hoile ei hidden field must -->
	<input type="hidden" name="action" value="pwyw_hidden_input">

	<p>
		<?php submit_button('Submit'); ?>
	</p>

</form>