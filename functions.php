<?php 
add_action( 'woocommerce_check_cart_items', 'auto_update_cart_total' );
function auto_update_cart_total() {
    // Only run in the Cart
    if( is_cart()) {
    global $woocommerce;
	 ?>
        <script>
            jQuery(function($){
			   var 	currency = '<?php echo get_woocommerce_currency_symbol(); ?>';
			   $('input[name*="qty"]').change(function(){
					var quantity_number = $(this).val();
					var prices = $(this).closest('.cart_item').find('.product-price').find('.amount').html().replace(/[^0-9\.]+/g,"");
					var sub_total = quantity_number*prices;
					$(this).closest('.cart_item').find('.product-subtotal').find('.amount').html(currency+sub_total.toFixed(2));				
					var sum = 0;
					setTimeout(function(){
						$('.product-subtotal .amount').each(function(){
							var $amt = $(this);
							sum += parseFloat($amt.html().replace(/[^0-9\.]+/g,""));
							$('.cart-subtotal .amount').html(currency+sum.toFixed(2));
							$('.order-total .amount').html(currency+sum.toFixed(2));		
						})
					}, 300);					
				})
            });
        </script>
    <?php
        
    }
}
?>
