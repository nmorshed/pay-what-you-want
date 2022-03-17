<?php

global $product;
	/* echo '<pre>';
	print_r($product);	// product er ID theke price access krbo
	// print_r($product->category_ids);
	echo '</pre>'; */

	// $all_product_categories = get_categories( ['taxonomy' => 'product_cat'] );
	$all_product_categories = get_categories( ['taxonomy' => 'product_cat'] );
	/* echo '<pre>';
	print_r($all_product_categories);
	// echo $all_product_categories['cat_name'];
	echo '</pre>'; */

	foreach($all_product_categories as $category) {
		// echo '<pre>';
		print_r($category->cat_name);
		echo '<br>';
		// echo '</pre>';
	}

	// $product is an object; so, we get $regular_price as following
	$base_price = $product->regular_price;
	$one_fourth_price = $base_price / 4;

	$one_fourth_price_1 = round($one_fourth_price);
	$one_fourth_price_2 = round($one_fourth_price * 2);
	$one_fourth_price_3 = round($one_fourth_price * 3);
	$one_fourth_price_4 = round($one_fourth_price * 4);

	foreach((get_the_category()) as $category) { 
    echo $category->cat_name . ' '; 
	}

	?>
	
	<div class='bw-single-price-area'>
		<input type="hidden" name="bw-price" class="bw-price" value="0">
		<div class="bw-select-price">
			<button id="one-fourth-1" data-price = <?php echo $one_fourth_price_1; ?> class="bw-btn-price">৳<?php echo $one_fourth_price_1; ?></button>
			<button id="one-fourth-2" data-price = <?php echo $one_fourth_price_2; ?> class="bw-btn-price">৳<?php echo $one_fourth_price_2; ?></button>
			<button id="one-fourth-3" data-price = <?php echo $one_fourth_price_3; ?> class="bw-btn-price">৳<?php echo $one_fourth_price_3; ?></button>
			<button id="one-fourth-4" data-price = <?php echo $one_fourth_price_4; ?> class="bw-btn-price">৳<?php echo $one_fourth_price_4; ?></button>

			<!-- <p>
				<label for=""></label>
			</p>
			<p>
				<input type="text" id="one-fourth-1" data-price = <?php //echo $one_fourth_price_1; ?> class="bw-btn-price" value="৳<?php //echo $one_fourth_price_1; ?>" />
			</p> -->
		</div>
	</div>

<?php
// submit_button('Save');
?>


