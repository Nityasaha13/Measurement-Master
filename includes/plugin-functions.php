<?php

// Add custom form after add to cart button
add_action('woocommerce_after_add_to_cart_button', 'custom_measurement_form');
function custom_measurement_form()
{
	
?>
	<div class="measurement-form" id="measurement-form" style="top:-100%">
		<div id="measurement-modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Measurement Details</h5>
					</div>
					<div class="modal-body">
						<div class="me-form">
							<!-- Measurement Form -->
							<form id="measurement-form">
								<!-- Add your measurement fields here -->
								<div class="form-group">
									<label for="sleeves">Sleeves</label>
									<input type="text" class="form-control" id="sleeves" name="sleeves" value="<?php echo esc_attr($_POST['sleeves'] ?? ''); ?>">
								</div>
								<div class="form-group">
									<label for="chest">Chest</label>
									<input type="text" class="form-control" id="chest" name="chest" value="<?php echo esc_attr($_POST['chest'] ?? ''); ?>">
								</div>
								<div class="form-group">
									<label for="waist">Waist</label>
									<input type="text" class="form-control" id="waist" name="waist" value="<?php echo esc_attr($_POST['waist'] ?? ''); ?>">
								</div>
								<!-- Add more fields as needed -->
								<button type="submit" class="mesurement-related">save & close</button>
							</form>
						</div>
						<!-- Human Body Image -->
						<div class="human-body">
							<img id="head-img" class="body-part head" src="http://fashion-fire.test/wp-content/uploads/2024/04/head.png" alt="Head">

							<div class="shoulder-div">
								<img id="shoulder-img" class="body-part shoulder" src="http://fashion-fire.test/wp-content/uploads/2024/04/sholder.png" alt="Shoulder">
							</div>

							<div class="arms">					
								<img id="arm-img" class="body-part left-arm" src="http://fashion-fire.test/wp-content/uploads/2024/04/left-arm.png" alt="Left Arm">
								<img id="arm-img-2" class="body-part right-arm" src="http://fashion-fire.test/wp-content/uploads/2024/04/right-arm.png" alt="Right Arm">
							</div>

							<img id="chest-img" class="body-part chest" src="http://fashion-fire.test/wp-content/uploads/2024/04/chest.png" alt="Chest">
							<img id="waist-img" class="body-part waist" src="http://fashion-fire.test/wp-content/uploads/2024/04/waist.png" alt="Waist">
							<img id="legs-img" class="body-part legs" src="http://fashion-fire.test/wp-content/uploads/2024/04/legs.png" alt="Legs">
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

<?php
}


add_action('woocommerce_before_add_to_cart_quantity','display_measurement_form',10);
function display_measurement_form(){
	?>
		
	<div class="mesurement-related">
		<input type="checkbox" class="mesurement-related" id="show-measurement-form">
		<input type="button" class="mesurement-related2" id="show-measurement-form2" value="Start Customization (for $10)">
	</div>

	<?php
}


add_action('woocommerce_before_add_to_cart_quantity','display_entered_values_in_product_page',5);
function display_entered_values_in_product_page(){
	?>

<div class="entered-values">
        <?php 
		
            $sleeves_value = isset($_POST['sleeves']) ? sanitize_text_field($_POST['sleeves']) : '';
            if (!empty($sleeves_value)) {
                echo 'Sleeves: <span id="displayed-sleeves">' . $sleeves_value . '</span><br>';
            }
            $chest_value = isset($_POST['chest']) ? sanitize_text_field($_POST['chest']) : '';
            if (!empty($chest_value)) {
                echo 'Chest: <span id="displayed-chest">' . $chest_value . '</span><br>';
            }
            $waist_value = isset($_POST['waist']) ? sanitize_text_field($_POST['waist']) : '';
            if (!empty($waist_value)) {
                echo 'Waist: <span id="displayed-waist">' . $waist_value . '</span><br>';
            }
        ?>
    </div>

	<?php
}


// Add measurements to cart item data

add_filter('woocommerce_add_cart_item_data', 'add_measurement_to_cart_item_data', 10, 3);
function add_measurement_to_cart_item_data($cart_item_data, $product_id, $variation_id)
{
    if (isset($_POST['sleeves']) && isset($_POST['chest']) && isset($_POST['waist'])) {
        // Get the measurements entered by the customer
        $sleeves = sanitize_text_field($_POST['sleeves']);
        $chest = sanitize_text_field($_POST['chest']);
        $waist = sanitize_text_field($_POST['waist']);

        // Append the measurements to the cart item data
        $cart_item_data['measurement_data'] = array(
            'sleeves' => $sleeves,
            'chest' => $chest,
            'waist' => $waist,
        );
    }
    return $cart_item_data;
}


// Display measurements on the cart and checkout page

add_filter('woocommerce_cart_item_name', 'display_measurement_on_cart', 10, 2);
add_filter('woocommerce_checkout_cart_item_quantity', 'display_measurement_on_cart', 10, 2);
function display_measurement_on_cart($item_name, $cart_item)
{
    if (isset($cart_item['measurement_data'])) {
        $measurement_data = $cart_item['measurement_data'];
		$sleeves= sanitize_text_field($measurement_data['sleeves']);
		$chest = sanitize_text_field($measurement_data['chest']);
		$waist = sanitize_text_field($measurement_data['waist']);

		if(!empty($sleeves)){
        	$item_name .= ' - Sleeves: ' . $sleeves ;
		}
		if(!empty($chest)){
        	$item_name .= ', Chest: ' . $chest;
		}
		if(!empty($waist)){
        	$item_name .= ', Waist: ' . $waist;
		}
    }
    return $item_name;
}


// Calculate and add extra cost for measurements

add_action('woocommerce_cart_calculate_fees', 'add_measurement_cost', 10, 1);
function add_measurement_cost($cart)
{
    if (is_admin() && !defined('DOING_AJAX'))
        return;

    $measurement_extra_cost = 10; // Fixed cost for measurements

    foreach ($cart->get_cart() as $cart_item) {
        if (isset($cart_item['measurement_data'])) {
            $quantity = $cart_item['quantity']; // Get the quantity of the item
			
            // Add the fee for each item
            $cart->add_fee(__('Extra Cost', 'text-domain'), $measurement_extra_cost * $quantity, false);
        }
    }
}


add_action('wp_footer','custom_js_in_footer');
function custom_js_in_footer(){
	global $product;
	?>

	<script>

		jQuery(document).ready(function($) {
			// Function to update the product price
			function updateProductPrice() {
				var price = parseFloat(<?php echo $product->get_price(); ?>); 
				var extraPrice = 0; 

				var sleevesValue = parseFloat($('#sleeves').val()) || 0; 
				var chestValue = parseFloat($('#chest').val()) || 0;
				var waistValue = parseFloat($('#waist').val()) || 0;

				if (sleevesValue > 0 || chestValue > 0 || waistValue > 0) {
					extraPrice = 10;
					inputBoxChecked();
				}

				var totalPrice = price + extraPrice;

				// Update the displayed price
				$('.price .woocommerce-Price-amount').html('<span class="woocommerce-Price-currencySymbol">' + '<?php echo get_woocommerce_currency_symbol(); ?>' + '</span>' + totalPrice.toFixed(2));
			}

			// Call the updateProductPrice function when any measurement field value changes
			$('#sleeves, #chest, #waist').on('input', function() {
				updateProductPrice();
			});
			updateProductPrice();

		});

	</script>

	<?php
}