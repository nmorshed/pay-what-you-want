
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
	$prodigy = get_option('prodigy');

?>

<p>
	<input type='radio' id='all_products' name='pwyw_products' value="0" <?php checked( '0', $pwyw_products ); ?>>
  <label for='all_products'><?php _e('Yes, we want this for all products', 'pwyw'); ?></label>
</p>

<p>
	<input type='radio' id='specific_products' name='pwyw_products' value="1" <?php checked( '1', $pwyw_products ); ?>>
  <label for='specific_products'><?php _e('No, we want this for the products of a few specific categories', 'pwyw'); ?></label>
</p>


<h3>
	<?php _e('Which type of price is your requirement?', 'pwyw'); ?>
</h3>

<p>
	<input type='radio' id='fixed_price' name='pwyw_price' value="0" <?php checked( '0', $pwyw_price ); ?>>
  <label for='fixed_price'><?php _e('We want fixed price', 'pwyw'); ?></label>
</p>

<p>
	<input type='radio' id='diversed_price' name='pwyw_price' value="1" <?php checked( '1', $pwyw_price ); ?>>
  <label for='diversed_price'><?php _e('Depending on regular price, prices may vary', 'pwyw'); ?></label>
</p>

<!-- save button a click krar por save krte hoile ei hidden field must -->
<input type="hidden" name="action" value="pwyw_hidden_input">

<p>
	<?php submit_button('Submit'); ?>
</p>

</form>
