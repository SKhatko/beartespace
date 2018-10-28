<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		DB::table( 'pages' )->insert( [
			[
				"name"   => "Contacts block in footer",
				"slug"    => "contacts-in-footer",
				"content" => json_encode( [
					"en" => "<p>Information</p><p>Gallery BeArte</p><p>Hoejtoften 12</p><p>2690 Karlslunde</p><p>VAT number:&nbsp;DK34129894</p><p>Bankoplysninger: Sparekassen Sj&aelig;lland</p>",
					"da" => "<p>Information</p><p>Gallery BeArte</p><p>Hoejtoften 12</p><p>2690 Karlslunde</p><p>VAT number:&nbsp;DK34129894</p><p>Bankoplysninger: Sparekassen Sj&aelig;lland</p>"
				] )
			],
			[
				"name"   => "Terms and Conditions",
				"slug"    => "terms-and-conditions",
				"content" => json_encode( [
					"en" => "Terms and Conditions",
					"da" => "Terms and Conditions DK"
				] )
			],
			[
				"name"   => "Right of cancellation",
				"slug"    => "right-of-cancellation",
				"content" => json_encode( [
					"en" => "Right of Cancellation
When you shop at Gallery BeArte, you have 14 days of withdrawal from the day you receive the shipment. The following rules apply:
It is the duty of the gallery to specify where exactly you must send the item to. Under usual circumstances, the return address is Hoejtoften 12, 2690 Karlslunde, Denmark. However, this may differ.
You must notify the gallery that you wish to return it within 14 days of receipt of your order. You can do this by sending an e-mail to us. We will confirm your right of withdrawal by answering your inquiry.
After this you have 14 days to return the item.
Take care of the item. The product should appear as new at a return point and be able to be sold to another customer. However, you must unpack it, examine it and rate it. If the product is characterized as used or damaged, you will not lose your right of withdrawal for that reason, but you should expect to pay for the impairment. If the product is worthless, you are not ennamed to your money back. You must therefore consider whether you will use your right of withdrawal in that situation. It is the gallery that assesses the possible depreciation of the product.
For safety reasons, keep the instructions, labels, molded plastic, and so on, so that we can get it back if you return your purchase.
When you return a purchase, you are responsible for the item until it returns to the gallery. This means that you should expect to pay if the product gets damaged or disappears during its transportation back to the gallery.
You must pay the return shipment yourself. Get a receipt from the postal service or courier you use.
You will get all your money back - including the original delivery costs. The gallery has a period of 14 days for the refund to be valid, starting from the date mentioned in the receipt of the returned item.
You have no return right in the following case:
Items specially made for you - so-called purchase orders (the items that are made based on your original ideas).",
					"da" => ""
				] )
			],
			[
				"name"   => "Warranty",
				"slug"    => "warranty",
				"content" => json_encode( [
					"en" => "Warranty",
					"da" => "Warranty"
				] )
			],
			[
				"name"   => "Taxes",
				"slug"    => "taxes",
				"content" => json_encode( [
					"en" => "Taxes",
					"da" => "Taxes"
				] )
			],
			[
				"name"   => "Freight",
				"slug"    => "freight",
				"content" => json_encode( [
					"en" => "Freight",
					"da" => "Freight"
				] )
			],
			[
				"name"   => "Cookies and Privacy",
				"slug"    => "cookies-and-privacy",
				"content" => json_encode( [
					"en" => "Cookies and Privacy",
					"da" => "Cookies and Privacy DK"
				] )
			],

			//region About
			[
				"name"   => "About BearteSpace",
				"slug"    => "about-beartespace",
				"content" => json_encode( [
					"en" => "About BearteSpace",
					"da" => "About BearteSpace DK"
				] )
			],

			[
				"name"   => "About BearteGallery",
				"slug"    => "about-BearteGallery",
				"content" => json_encode( [
					"en" => "About BearteGallery",
					"da" => "About BearteGallery DK"
				] )
			],

			[
				"name"   => "About BeArte Design",
				"slug"    => "about-BeArte Design",
				"content" => json_encode( [
					"en" => "About BeArte Design",
					"da" => "About BeArte Design DK"
				] )
			],
			//endregion

			//region Agreements
			[
				"name"   => "User Agreement",
				"slug"    => "user-agreement",
				"content" => json_encode( [
					"en" => "User agreement",
					"da" => "User agreement DK"
				] )
			],

			[
				"name"   => "Artist Agreement",
				"slug"    => "artist-agreement",
				"content" => json_encode( [
					"en" => "Artist agreement",
					"da" => "Artist agreement DK"
				] )
			],

			[
				"name"   => "Gallery Agreement",
				"slug"    => "gallery-agreement",
				"content" => json_encode( [
					"en" => "Gallery agreement",
					"da" => "Gallery agreement DK"
				] )
			],
			//endregion

		] );


	}
}
