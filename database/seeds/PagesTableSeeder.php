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

	}
}
