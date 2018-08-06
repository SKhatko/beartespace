<?php

namespace App;

class Cart {
	public $items;
	public $totalQuantity;
	public $totalPrice;

	public function __construct( $oldCart ) {

		if ( $oldCart ) {
			$this->items         = $oldCart->items;
			$this->totalQuantity = $oldCart->totalQuantity;
			$this->totalPrice    = $oldCart->totalPrice;
		} else {
			$this->items         = [];
			$this->totalQuantity = 0;
			$this->totalPrice    = 0;
		}
	}

	public function add( $artwork, $id ) {
		$storedItem = [ 'qty' => 1, 'price' => $artwork->price, 'item' => $artwork ];

		if ( $this->items ) {
			if ( array_key_exists( $id, $this->items ) ) {
				$storedItem = $this->items[ $id ];
			}
		}
		$this->items[ $id ] = $storedItem;
		$this->totalQuantity ++;
		$this->totalPrice += $artwork->price;
	}

	public function remove( $artwork, $id ) {

		if ( array_key_exists( $id, $this->items ) ) {
			unset( $this->items[ $id ] );

			$this->totalQuantity --;
			$this->totalPrice -= $artwork->price;
		}
	}

	public function toggle( $artwork, $id ) {
		if ( $this->items && array_key_exists( $id, $this->items ) ) {
			$this->remove( $artwork, $id );
		} else {
			$this->add( $artwork, $id );
		}
	}
}
