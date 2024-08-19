<?php

if ( ! defined( 'ABSPATH' ) ) exit;

// Add custom form after add to cart button
add_action('woocommerce_after_add_to_cart_button', 'custom_measurement_form');
function custom_measurement_form()
{

?>	
	<div class="overlay" id="overlay"></div>
	<div class="measurement-details-form" id="measurement-details-form" style="display:none">
		<div class="measurement-popup-content">

			<div class="measurement-popup-header">
				<h5 class="measurement-popup-title">Measurement Details</h5>
			</div>

			<div class="measurement-popup-body">
				<div class="measurement-popup form">
					<!-- Measurement Form -->
					<form id="measurement-form">
						<!-- Add your measurement fields here -->
						<div class="form-group">
							<label for="sleeves">Sleeves</label>
							<input type="number" class="form-control" id="sleeves" name="sleeves" value="<?php echo esc_attr($_POST['sleeves'] ?? ''); ?>">
						</div>
						<div class="form-group">
							<label for="chest">Chest</label>
							<input type="number" class="form-control" id="chest" name="chest" value="<?php echo esc_attr($_POST['chest'] ?? ''); ?>">
						</div>
						<div class="form-group">
							<label for="waist">Waist</label>
							<input type="number" class="form-control" id="waist" name="waist" value="<?php echo esc_attr($_POST['waist'] ?? ''); ?>">
						</div>
						<!-- Add more fields as needed -->
						<button type="submit" class="mesurement-form-submit">Ok</button>
						<button class="mesurement-form-close" id="close-form-btn">X</button>
					</form>
				</div>

				<!-- Human Body Image -->
				<?php do_shortcode('[human_body]') ?>

			</div>
		</div>
	</div>

<?php
}


add_action('woocommerce_before_add_to_cart_quantity', 'display_measurement_form', 10);
function display_measurement_form()
{
?>

	<div class="mesurement-form-triggers">
		<input type="checkbox" id="show-form-btn1">
		<input type="button" id="show-form-btn2" value="Start Customization (for $10)">
	</div>

<?php
}