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
    public function insertProduct(RequestValidation $request, array $files)
    {
        $product = Product::create($request->all());

        $this->syncCategory($product, $request->input('categories_list'));
        if(!($this->uploadFiles($files, $product))) {
            return response()->json([
                'file' => 'There was some problem with file uploading'
            ]);
        }
        return response()->json([
            'success' => 'Product was created successfully',
            'redirectTo' => '../products'
        ]);
    }

    /**
     * Insert into pivot table
     * @param Product $product
     * @param array $categories
     */
    private function syncCategory(Product $product, array $categories)
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
                $fileName = $file->getClientOriginalName();
                $photo = new Photo(['title' => $fileName]);
                $product->photos()->save($photo);
                $file->move($destinationPath, $fileName);

                //Imagick ??
//                $image = new \Imagick(asset('/assets/uploads/'.$fileName));
//                $cropWidth = $image->getImageWidth();
//                $cropHeight = $image->getImageHeight();
//                if($cropWidth > 1024 || $cropHeight > 768) {
//                    $image->thumbnailImage(800, 600);
//                    $image->writeImage(asset('/assets/uploads/'.$fileName));
//                }
                $uploadCount++;
            }
        }
        if($fileCount == $uploadCount) {
            return true;
        } else {
            return false;
        }
    }
}