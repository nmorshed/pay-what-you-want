(function($) {

	$(document).ready( function() {

		let various_price = $('#pwyw_various_price');

		various_price.click( function() {
			$('#pwyw_various_price_dropdown').slideToggle();
			$('#pwyw_fixed_price_dropdown').slideUp();
		});

		// console.log(various_price);

		/* $('#pwyw_fixed_price').on( 'click', function() {
			$("label[for='pwyw_fixed_price'], #pwyw_fixed_price").hide();
		}); */

    let fixed_price_slider = $('#pwyw_fixed_price');

		// if( fixed_price_slider.is(':checked') ) {
			fixed_price_slider.click( function() {
				$('#pwyw_fixed_price_dropdown').slideToggle();
				$('#pwyw_various_price_dropdown').slideUp();
			});
		// } else {
		// 	fixed_price_slider.click( function() {
		// 	$('#pwyw_fixed_price_dropdown').slideUp();
		// 	});
		// }

    let fixed_price_value = $('.pwyw_fixed_price');
    let pwyw_append = $('#pwyw_append');
    let pwyw_remove = $('.pwyw_remove');
		
    let wrapper = $('.wrapper');
		let input_parent = $('.input_parent');
		let fieldHTML = "<div><input type='number' class='pwyw_fixed_price' name='pwyw_fixed_price_name[]' placeholder='Enter a Price' value='' /><a href='javascript:void(0);' class='pwyw_remove' style='background-color: #dd4021; color: #fff; text-decoration: none;'>x</a></div>";

    pwyw_append.click(function() {
			wrapper.append(fieldHTML);
		});

		/* pwyw_remove.click(function() {
			$(this).parent().remove();
		}); */

		input_parent.on('click', '.pwyw_remove', function(e) {
			e.preventDefault();
			// console.log(this);
			$(this).parent('div').remove();
		});

    /* pwyw_remove.on('click', function() {
			// console.log(this);
			$(this).remove();
		}); */

  });

})(jQuery);