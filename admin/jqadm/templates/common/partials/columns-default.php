<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017
 */

$checked = function( array $list, $code ) {
	return ( in_array( $code, $list ) ? 'checked="checked"' : '' );
};

/**
 * Renders the drop down for the available columns in the list views
 *
 * Available data:
 * - data: Associative list of keys (e.g. "product.id") and translated names (e.g. "ID")
 * - fields: List of columns that are currently shown
 */

$fields = $this->get( 'fields', [] );

$enc = $this->encoder();


?>
<div class="dropdown filter-columns">
	<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
		data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<?= $enc->html( $this->translate( 'admin', 'Columns' ) ); ?>
	</button>
	<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<?php foreach( $this->get( 'data', [] ) as $key => $name ) : ?>
			<li class="dropdown-item">
				<label>
					<input type="checkbox"
						name="<?= $enc->attr( $this->formparam( ['fields', ''] ) ); ?>"
						value="<?= $enc->attr( $key ); ?>" <?= $checked( $fields, $key ); ?> />
					<?= $enc->html( $name ); ?>
				</label>
			</li>
		<?php endforeach; ?>
	</ul>
</div>