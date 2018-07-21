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
			"title"   => "Contacts block in footer",
			"slug"    => "contacts-in-footer",
			"content" => json_encode([
				"en" => "<ul><li>Information</li><li>Gallery BeArte</li><li>Hoejtoften 12</li><li>2690 Karlslunde</li><li>VAT number:&nbsp;DK34129894</li><li>Bankoplysninger: Sparekassen Sj&aelig;lland</li></ul>",
				"da" => "<ul><li>Information</li><li>Gallery BeArte</li><li>Hoejtoften 12</li><li>2690 Karlslunde</li><li>VAT number:&nbsp;DK34129894</li><li>Bankoplysninger: Sparekassen Sj&aelig;lland</li></ul>"
			]),
			"active"  => 1,
		] );

		DB::table( 'pages' )->insert( [
			"title"   => "Terms and Conditions",
			"slug"    => "terms-and-conditions",
			"content" => json_encode([
				"en" => "<header><h1>Terms and conditions</h1></header><p><strong><span lang=\"EN-US\">General</span></strong></p><p><span lang=\"EN-US\">Handling art on the internet can have its challenges, for colors and even sizes may vary depending on the screen and the eyes of a person. At BeArte we would like you to feel safe and secure, and to get good service when you make your purchase. Naturally, we comply with the Buying Act and the guidelines for online retailers. Feel free to contact us via email or phone, regardless of what your inquiry is about.</span></p><p><span lang=\"EN-US\">Should you have any doubts or questions, keep in mind that we are just a call or an e-mail away and that we are always at your disposal.</span></p><p>jkljklj</p>",
				"da" => "<header><h1>Handelsbetingelser</h1></header><p><strong>Generelt</strong><br><br>At handle kunst p&aring; internettet kan have sine udfordringer, for farver og selv st&oslash;rrelser kan variere afh&aelig;ngig af sk&aelig;rme og &oslash;jet der kigger. Hos BeArte vil vi gerne have, at du f&oslash;ler dig tryg og sikker, og at du f&aring;r samme gode service b&aring;de n&aring;r du k&oslash;ber, som hvis du fortryder dit k&oslash;b. Vi overholder naturligvis k&oslash;beloven og de retningslinjer, som findes for god nethandel, og &oslash;nsker derudover at give dig tryghed ved altid at kunne kontakte os via e-mail eller telefon uanset hvad dit opkald drejer sig om.<br><br>Er du i tvivl eller har sp&oslash;rgsm&aring;l, s&aring; husk at vi kun er en opringning eller e-mail v&aelig;k og at vi altid st&aring;r til din r&aring;dighed.</p>"
			]),
			"active"  => 1,
		] );

		DB::table( 'pages' )->insert( [
			"title"   => "Right of cancellation",
			"slug"    => "right-of-cancellation",
			"content" => json_encode([
				"en" => "Right of Cancellation
When you shop at Gallery BeArte, you have 14 days of withdrawal from the day you receive the shipment. The following rules apply:
It is the duty of the gallery to specify where exactly you must send the item to. Under usual circumstances, the return address is Hoejtoften 12, 2690 Karlslunde, Denmark. However, this may differ.
You must notify the gallery that you wish to return it within 14 days of receipt of your order. You can do this by sending an e-mail to us. We will confirm your right of withdrawal by answering your inquiry.
After this you have 14 days to return the item.
Take care of the item. The product should appear as new at a return point and be able to be sold to another customer. However, you must unpack it, examine it and rate it. If the product is characterized as used or damaged, you will not lose your right of withdrawal for that reason, but you should expect to pay for the impairment. If the product is worthless, you are not entitled to your money back. You must therefore consider whether you will use your right of withdrawal in that situation. It is the gallery that assesses the possible depreciation of the product.
For safety reasons, keep the instructions, labels, molded plastic, and so on, so that we can get it back if you return your purchase.
When you return a purchase, you are responsible for the item until it returns to the gallery. This means that you should expect to pay if the product gets damaged or disappears during its transportation back to the gallery.
You must pay the return shipment yourself. Get a receipt from the postal service or courier you use.
You will get all your money back - including the original delivery costs. The gallery has a period of 14 days for the refund to be valid, starting from the date mentioned in the receipt of the returned item.
You have no return right in the following case:
Items specially made for you - so-called purchase orders (the items that are made based on your original ideas).",
				"da" => ""
			]),
			"active"  => 1,
		] );

	}
}
