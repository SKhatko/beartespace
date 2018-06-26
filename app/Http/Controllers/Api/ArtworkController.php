<?php

namespace App\Http\Controllers\Api;

use App\Artwork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtworkController extends Controller
{
	public function store( Request $request ) {

		$artwork = Artwork::updateOrCreate( ['id' => $request->input('id')], $request->all() );

		return ['status'=> 'success', 'message' => 'Saved', 'data' => $artwork];
	}

	public function uploadPhoto( Request $request, $id ) {

		if ( $request->file( 'file' ) ) {

			return $request->file( 'file' )->storeAs( '/public/artworks/' . $id, $request->file( 'file' )->getClientOriginalName() );
		}
	}

	public function uploadAdsImage(Request $request, $ad_id = 0){
		$user_id = 0;

		if (Auth::check()){
			$user_id = Auth::user()->id;
		}

		if ($request->hasFile('images')){
			$images = $request->file('images');
			foreach ($images as $image){

				// Validate right formats for images

				$file_base_name = str_replace('.'.$image->getClientOriginalExtension(), '', $image->getClientOriginalName());
				$resized = Image::make($image)->resize(640, null, function ($constraint) {
					$constraint->aspectRatio();
				})->stream();
				$resized_thumb = Image::make($image)->resize(320, 213)->stream();

				$image_name = strtolower(time().str_random(5).'-'.str_slug($file_base_name)).'.' . $image->getClientOriginalExtension();

				$imageFileName = 'uploads/images/'.$image_name;
				$imageThumbName = 'uploads/images/thumbs/'.$image_name;

				try{
					//Upload original image
					$is_uploaded = current_disk()->put($imageFileName, $resized->__toString(), 'public');

					if ($is_uploaded) {
						//Save image name into db
						$created_img_db = Media::create(['user_id' => $user_id, 'ad_id' => $ad_id, 'media_name'=>$image_name, 'type'=>'image', 'storage' => get_option('default_storage'), 'ref'=>'ad']);

						//upload thumb image
						current_disk()->put($imageThumbName, $resized_thumb->__toString(), 'public');
						$img_url = media_url($created_img_db, false);
					}
				} catch (\Exception $e){
					return redirect()->back()->withInput($request->input())->with('error', $e->getMessage()) ;
				}
			}
		}
	}

}
