<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<fieldset id="<?php echo $this->id; ?>-payment-form">
	<?php if ( 'all' == $this->methods ) : ?>
		<p class="form-row form-row-wide">
			<label><input id="<?php echo esc_attr( $this->id ); ?>-payment-method-credit-cart" type="radio" name="<?php echo esc_attr( $this->id ); ?>_payment_method" value="credit-card" checked="checked" /> <?php _e( 'Credit Card', 'woocommerce-pagarme' ); ?></label>
			<label><input id="<?php echo esc_attr( $this->id ); ?>-payment-method-banking-ticket" type="radio" name="<?php echo esc_attr( $this->id ); ?>_payment_method" value="banking-ticket" /> <?php _e( 'Banking Ticket', 'woocommerce-pagarme' ); ?></label>
		</p>
	<?php else : ?>
		<input id="<?php echo esc_attr( $this->id ); ?>-payment-method-credit-cart" type="hidden" name="<?php echo esc_attr( $this->id ); ?>_payment_method" value="credit-card" />
	<?php endif; ?>

	<div id="<?php echo esc_attr( $this->id ); ?>-credit-cart-form">
		<p class="form-row form-row-first">
			<label for="<?php echo esc_attr( $this->id ); ?>-card-holder-name"><?php _e( 'Card Holder Name', 'woocommerce-pagarme' ); ?> <small>(<?php _e( 'as recorded on the card', 'woocommerce-pagarme' ); ?>)</small> <span class="required">*</span></label>
			<input id="<?php echo esc_attr( $this->id ); ?>-card-holder-name" class="input-text" type="text" autocomplete="off" style="font-size: 1.5em; padding: 8px;" />
		</p>
		<p class="form-row form-row-last">
			<label for="<?php echo esc_attr( $this->id ); ?>-card-number"><?php _e( 'Card Number', 'woocommerce-pagarme' ); ?> <span class="required">*</span></label>
			<input id="<?php echo esc_attr( $this->id ); ?>-card-number" class="input-text wc-credit-card-form-card-number" type="text" maxlength="20" autocomplete="off" placeholder="•••• •••• •••• ••••" style="font-size: 1.5em; padding: 8px;" />
		</p>
		<div class="clear"></div>
		<p class="form-row form-row-first">
			<label for="<?php echo esc_attr( $this->id ); ?>-card-expiry"><?php _e( 'Expiry (MM/YY)', 'woocommerce-pagarme' ); ?> <span class="required">*</span></label>
			<input id="<?php echo esc_attr( $this->id ); ?>-card-expiry" class="input-text wc-credit-card-form-card-expiry" type="text" autocomplete="off" placeholder="<?php _e( 'MM / YY', 'woocommerce-pagarme' ); ?>" style="font-size: 1.5em; padding: 8px;" />
		</p>
		<p class="form-row form-row-last">
			<label for="<?php echo esc_attr( $this->id ); ?>-card-cvc"><?php _e( 'Card Code', 'woocommerce-pagarme' ); ?> <span class="required">*</span></label>
			<input id="<?php echo esc_attr( $this->id ); ?>-card-cvc" class="input-text wc-credit-card-form-card-cvc" type="text" autocomplete="off" placeholder="<?php _e( 'CVC', 'woocommerce-pagarme' ); ?>" style="font-size: 1.5em; padding: 8px;" />
		</p>
		<div class="clear"></div>
		<?php if ( 1 < $this->max_installment ) : ?>
			<p class="form-row form-row-wide">
				<label for="<?php echo esc_attr( $this->id ); ?>-card-installments"><?php _e( 'Installments', 'woocommerce-pagarme' ); ?> <span class="required">*</span></label>
				<select name="<?php echo esc_attr( $this->id ); ?>_installments" id="<?php echo esc_attr( $this->id ); ?>-installments" style="font-size: 1.5em; padding: 8px; width: 100%;">
					<?php
						$smallest_installment = ( 5 > $this->smallest_installment ) ? 500 : number_format( $this->smallest_installment, 2, '', '' );

						for ( $i = 1; $i <= $this->max_installment; $i++ ) :
							$total = $cart_total / $i;

							if ( $smallest_installment > number_format( $total, 2, '', '' ) ) {
								break;
							}
					?>
						<option value="<?php echo $i; ?>"><?php echo sprintf( __( '%dx of %s (interest-free)', 'woocommerce-pagarme' ), $i, strip_tags( wc_price( $total ) ) ); ?></option>
					<?php endfor; ?>
				</select>
			</p>
		<?php endif; ?>
	</div>
</fieldset>
