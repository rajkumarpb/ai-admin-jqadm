<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2016
 */

$enc = $this->encoder();
$items = $this->get( 'physicalItems', [] );

$value = function( $type ) use ( $items ) {
	return ( isset( $items[$type] ) ? $items[$type]->getValue() : '' );
};


?>
<div id="physical" class="row item-physical tab-pane fade" role="tabpanel" aria-labelledby="physical">
	<div class="col-xl-6">
		<div class="form-group row optional">
			<label class="col-lg-4 form-control-label"><?= $enc->html( $this->translate( 'admin', 'Length' ) ); ?></label>
			<div class="col-lg-8">
				<input class="form-control item-package-length" type="text" name="<?= $enc->attr( $this->formparam( array( 'physical', 'package-length' ) ) ); ?>"
					placeholder="<?= $enc->attr( $this->translate( 'admin', 'Product length, e.g. 30.0 (in yard, inch, etc.)' ) ); ?>"
					value="<?= $enc->attr( $this->param( 'physical/package-length', $value( 'package-length' ) ) ); ?>" >
			</div>
		</div>
		<div class="form-group row optional">
			<label class="col-lg-4 form-control-label"><?= $enc->html( $this->translate( 'admin', 'Width' ) ); ?></label>
			<div class="col-lg-8">
				<input class="form-control item-package-width" type="text" name="<?= $enc->attr( $this->formparam( array( 'physical', 'package-width' ) ) ); ?>"
					placeholder="<?= $enc->attr( $this->translate( 'admin', 'Product width, e.g. 17.5 (in yard, inch etc.)' ) ); ?>"
					value="<?= $enc->attr( $this->param( 'physical/package-width', $value( 'package-width' ) ) ); ?>" >
			</div>
		</div>
		<div class="form-group row optional">
			<label class="col-lg-4 form-control-label"><?= $enc->html( $this->translate( 'admin', 'Height' ) ); ?></label>
			<div class="col-lg-8">
				<input class="form-control item-package-height" type="text" name="<?= $enc->attr( $this->formparam( array( 'physical', 'package-height' ) ) ); ?>"
					placeholder="<?= $enc->attr( $this->translate( 'admin', 'Product height, e.g. 20.0 (in yard, inch, etc.)' ) ); ?>"
					value="<?= $enc->attr( $this->param( 'physical/package-height', $value( 'package-height' ) ) ); ?>" >
			</div>
		</div>
		<div class="form-group row optional">
			<label class="col-lg-4 form-control-label"><?= $enc->html( $this->translate( 'admin', 'Weight' ) ); ?></label>
			<div class="col-lg-8">
				<input class="form-control item-package-weight" type="text" name="<?= $enc->attr( $this->formparam( array( 'physical', 'package-weight' ) ) ); ?>"
					placeholder="<?= $enc->attr( $this->translate( 'admin', 'Product weight, e.g. 1.25 (in pound, ounce, etc.)' ) ); ?>"
					value="<?= $enc->attr( $this->param( 'physical/package-weight', $value( 'package-weight' ) ) ); ?>" >
			</div>
		</div>
	</div>

	<?= $this->get( 'physicalBody' ); ?>
</div>
