<?php

use Illuminate\Database\Seeder;

class TranslationsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$translations = [
			'portal'    => [
				[ 'Login', '' ],
				[ 'Signup', '' ],
				[ 'Artists', '' ],
				[ 'Artworks', '' ],
				[ 'Auction', '' ],
				[ 'About Us', '' ],
				[ 'Information', '' ],
				[ 'Contact', '' ],
				[ 'Category', '' ],
				[ 'Direction', '' ],
				[ 'Medium', '' ],
				[ 'Theme', '' ],
				[ 'Color', '' ],
				[ 'Technique', '' ]
			],
			'category'  => [
				[ 'Painting', 'Maleri' ],
				[ 'Sculpture', 'Skulptur' ]
			],
			'direction' => [
				[ 'Abstract', 'Abstrakt' ],
				[ 'Camp', 'Camp' ],
				[ 'Decorative figurism', 'Dekorativ figurisme' ],
				[ 'Expressionism', 'Ekspressionisme' ],
				[ 'Color-field painting', 'Farvefeltsmaleri' ],
				[ 'Fauvism', 'Fauvisme' ],
				[ 'Figurativ', 'Figurativt' ],
				[ 'Geometric', 'Geometrisk' ],
				[ 'Geometric abstraction', 'Geometrisk abstraktion' ],
				[ 'Impressionism', 'Impressionisme' ],
				[ 'Colourism', 'Kolorisme' ],
				[ 'Constructionism', 'Konstruktionisme' ],
				[ 'Cubism', 'Kubistisk' ],
				[ 'Les Nabis', 'Les Nabis' ],
				[ 'Lyrical Abstraction', 'Lyrisk abstraktion' ],
				[ 'Maritime theme', 'Maritimt tema' ],
				[ 'Naive Art', 'Naive Art' ],
				[ 'Pop Art', 'Pop Art' ],
				[ 'Realism', 'Realisme' ],
				[ 'Romanticism', 'Romantikken' ],
				[ 'Sensualism', 'Sensualisme' ],
				[ 'Spontaneous realism', 'Spontan realisme' ],
				[ 'Street Art', 'Street Art' ],
				[ 'Urban Art', 'Urban Art' ],
				[ 'Surrealism', 'Surrealisme' ],
				[ 'Symbolism', 'Symbolik' ],
				[ 'Synthetism', 'Syntetisme' ]
			],
			'medium'    => [
				[ 'Acrylic on Indian cotton', 'Akryl på indisk bomuld' ],
				[ 'Acrylic on canvas', 'Akryl på lærred' ],
				[ 'Acrylic on paper', 'Akryl på papir' ],
				[ 'Acrylic on plate', 'Akryl på plade' ],
				[ 'Watercolor on paper', 'Akvarel på papir' ],
				[ 'Own technique on canvas', 'Egen teknik på lærred' ],
				[ 'Own technique on the plate', 'Egen teknik på plade' ],
				[ 'Mixed technique (acrylic / chalk)', 'Mixet teknik (akryl/kridt)' ],
				[ 'Mixed technique (oil / chalk)', 'Mixet teknik (oile/kridt)' ],
				[ 'Mixed technology on canvas', 'Mixet teknik på lærred' ],
				[ 'Mixed technique on cardboard', 'Mixet teknik på pap' ],
				[ 'Oil and acrylic on canvas', 'Olie og akryl på lærred' ],
				[ 'Oil on canvas', 'Olie på lærred' ],
				[ 'Oil on plate', 'Olie på plade' ],
				[ 'Cotton', 'Bomuld' ],
				[ 'Glass', 'Glas' ],
				[ 'Tempered glass', 'Hærdet glas' ],
				[ 'Clay', 'Ler' ],
				[ 'Clay - chamotte', 'Ler - chamotte' ],
				[ 'Porcelain', 'Porcelæn' ],
				[ 'Satin', 'Satin' ],
				[ 'Silk', 'Silke' ],
				[ 'Crepe de Chine', 'Crepe de Chine' ],
				[ 'Batik', 'Batik' ],
				[ 'Mixed', 'Blandet' ],
				[ 'Burned at high temperature', 'brænt ved høj temperatur' ],
				[ 'Freehand', 'Frihånd' ],
				[ 'Fusion technique', 'Fusingteknik' ],
				[ 'Gutta', 'Gutta' ],
				[ 'Raku technology', 'Raku teknik' ],
				[ 'Salt effect', 'Salt effect' ],
				[ 'Shibori', 'Shibori' ],
				[ 'Own design', 'Eget design' ],
				[ 'Form', 'Form' ],
				[ 'Handmade', 'Håndlavet' ],
				[ 'Handpainted', 'Håndmalet' ],
				[ 'Hand-rolled edge', 'Håndrullet kant' ],
			],
			'theme'     => [
				[ 'Portraiture', 'Portraiture' ],
				[ 'Religion/Historical', 'Religion/Historisk' ],
				[ 'Landscape', 'Landskab' ],
				[ 'Still Life', 'Stilleben' ],
				[ 'Abstract/Figurative Art', 'Abstrakt/Figurativ kunst' ],
				[ 'Maritime', 'Maritime' ],
				[ 'Abstraction', 'Abstraction' ],
				[ 'Flowers', 'Blomster' ],
				[ 'Animals', 'Dyr' ],
				[ 'Fish', 'Fisk' ],
				[ 'Birds', 'Fugle' ],
				[ 'Human figures', 'Menneskelige figurer' ],
				[ 'Plants', 'Planter' ],
				[ 'Butterflies', 'Sommerfugle' ],
				[ 'Spirals', 'Spiraler' ],
				[ 'Without', 'Uden' ]
			],
			'color'     => [
				[ 'Yellow', 'Gule' ]
			],
		];

		foreach ( $translations as $medium => $trans ) {

			foreach ( $trans as $tran ) {
				$key = str_slug( $tran[0], '-' );

				DB::table( 'language_lines' )->insert( [
					'group' => $medium,
					'key'   => $key,
					'text'  => json_encode( [ 'en' => $tran[0], 'da' => $tran[1] ] ),
				] );
			}
		}
	}
}
