<?php

namespace App\Services;

use Illuminate\Http\Request as RequestValidation;
use App\Photo;
use App\Product;
class ProductFile {


    public function test()
    {
        return 1;
    }


    /**
     * Create new product and bind it to categories and photos
     * @param RequestValidation $request
     * @param array $files
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function insertProduct(RequestValidation $request, $files)
    {
        $product = Product::create($request->all());

        $this->syncCategory($product, $request->input('categories_list'));

        if ($files == null){
            $updateProductFirstFile = null;
        } else {
            if (!($this->uploadFiles($files, $product))) {
                return response()->json([
                    'file' => 'There was some problem with file uploading'
                ]);
            }

            $updateProductFirstFile = $product->photos()->first()->id;
        }

        $product->photo_id = $updateProductFirstFile;
        $product->save();

        return response()->json([
            'success' => 'Product was created successfully',
            'redirectTo' => '../products/edit/' . $product->id
        ]);
    }

    /**
     * Insert into pivot table
     * @param Product $product
     * @param array $categories
     */
    public function syncCategory(Product $product, array $categories)
    {
        $product->categories()->sync($categories);
    }

    /**
     * Validate and insert photos, associated with files
     * @param $files
     * @param $product
     * @return $this
     */
    private function uploadFiles($files, $product)
    {
        $fileCount = count($files);
        $uploadCount = 0;
        foreach ($files as $file) {
            $fileValidation = ['file' => $file];
            $rules = ['file' => 'required|image'];

            $validator = \Validator::make($fileValidation, $rules);

            if ($validator->passes()) {
                $destinationPath = public_path() . '/assets/uploads';
                $fileName = microtime(true) . md5($destinationPath);;
//                $photo = new Photo(['title' => $fileName]);
//                $product->photos()->save($photo);
                $pathFileTemp = $file->getRealPath();
//                $file->move($destinationPath, $fileName);
//
//
//                //crop the image to desired resolution
                $image = new \Imagick($pathFileTemp);
                $cropWidth = $image->getImageWidth();
                $cropHeight = $image->getImageHeight();
                $pathFile = $destinationPath . '/' . $fileName . '.' . $image->getImageFormat();

                if ($cropWidth > 1024 || $cropHeight > 768) {
                    $image->thumbnailImage(800, 600);
                }
                $image->writeImage($pathFile);
                $fileUrlPath = asset('assets/uploads/'. $fileName . '.' . $image->getImageFormat());
                $photo = new Photo(['title' => $fileUrlPath]);
                $product->photos()->save($photo);

                $uploadCount++;
            }
        }
        if ($fileCount == $uploadCount) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete files
     * @param $files
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function fileDelete($files)
    {
        foreach($files as $file) {
            $fileName = $file->title;
            $absoluteParse = parse_url($fileName);
            $absolutePath = $absoluteParse['path'];

            if (!unlink('/var/www/html/test1.com/public' . $absolutePath)) {
                return response()->json([
                    'error' => 'Some files wasn\'t  deleted, please do it manually'
                ]);
            };

        }
        return response()->json([
            'redirectTo' => '/admin/products'
        ]);
    }

    /**
     * Make targeted photo primary
     * @param $product
     * @param $targetPhoto
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function makePrimary($product, $targetPhoto)
    {
        $mainPhoto = Photo::where('id', '=', $product->photo_id)->first();
        $product->photo_id = $targetPhoto;
        $product->save();
        return response()->json([
            'old_main' => $mainPhoto->id
        ]);
    }

}