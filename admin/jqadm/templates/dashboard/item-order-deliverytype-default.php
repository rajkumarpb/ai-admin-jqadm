<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016
 */

$enc = $this->encoder();

?>

<div class="order-deliverytype card panel col-lg-6">
	<div id="order-deliverytype-head" class="header card-header">
		<?php echo $enc->html( $this->translate( 'admin', 'Payment types' ) ); ?>
	</div>
	<div id="order-deliverytype-data" class="content card-block">
	</div>
</div>
<?php echo $this->get( 'orderdeliverytypeBody' ); ?>
