<?php

namespace App\Http\Controllers\S3;

use App\Http\Controllers\Controller;
use App\Models\mocupProduct;
use App\Models\Product;
use App\Models\ProductPngDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class s3DesignerController extends Controller
{
    //
    public function acceptDetail(Request $request, $id)
    {
        $image = "";
        if ($request->ImagePNG) {
            $image = $request->file('ImagePNG')[0];
        } else {
            $image = Product::find($id)->ImagePNG;
        }
        $approval = $request->approval;
        $ids = Product::find($id);
        $description = $ids->description;
        $name = $ids->user->name;
        Product::where('id', $id)->update([
            'ImagePNG' => Storage::disk('s3')->put('images', $request->file('image')),
            'status' => 3,
            'description' => $description . "</br> <b style= 'color:blue'>" . $name . "</b>:" . $approval,
        ]);
        mocupProduct::where('product_id', $id)->delete();
        foreach ($request->file('mocup') as $mocup) {
            $mocup = [
                'product_id' => $id,
                'mocup' => Storage::disk('s3')->put('images', $mocup),
            ];
            mocupProduct::create($mocup);
        }
        ProductPngDetails::where('product_id', $id)->delete();
        foreach ($request->file('ImagePNG') as $image) {
            $dataImage = [
                'product_id' => $id,
                'ImagePngDetail' => Storage::disk('s3')->put('images', $image),
            ];

            $datapng = ProductPngDetails::create($dataImage);
            $id = $datapng->id;
            $name = strtoupper(Str::random(4));
            $sku = $name . "-" . $id;

            ProductPngDetails::where('id', $id)->update([
                'Sku' => $sku,
            ]);
        }
        return redirect()->back();
    }
    public function addPngDetails(Request $request, $id)
    {

        $file = $request->file('image');
        $name = Product::where('id', $id)->first();
        foreach ($file as $image) {
            $str = $image->getClientOriginalName();
            $filename = str_replace(' ', '-', $str);
            // $name = strtoupper(Str::random(8));
            $filename = str_replace(' ', '-', $str);
            $dataImage = [
                'product_id' => $id,
                'ImagePngDetail' => $image->storeAs('images', $name->Sku . '-' . $filename),
            ];
            $datapng = ProductPngDetails::where('id', $id)->create($dataImage);
            $idPNG = $datapng->id;

            ProductPngDetails::where('id', $idPNG)->update([
                'Sku' => $name->Sku,
            ]);
        }
        Product::where('id', $id)->update(['status' => 3]);
        return redirect()->route('PendingDS');
    }

    // public function deleteMocupAll(Request $request, $id)
    // {
    //     $imageNames = mocupProduct::where('product_id', $id)->get();
    //     foreach ($imageNames as $imageName) {
    //         $image = $imageName->mocup;
    //         Storage::disk('s3')->delete($image);
    //     }
    //     mocupProduct::where('product_id', $id)->delete();
    //     return redirect()->back();
    // }
    public function deleteMocupAll(Request $request, $id)
    {
        $imageNames = mocupProduct::where('product_id', $id)->get();
        foreach ($imageNames as $imageName) {
            $image = $imageName->mocup;
            Storage::disk('s3')->delete($image);
        }
        mocupProduct::where('product_id', $id)->delete();
        return redirect()->back();
    }
    // public function deletePngAll(Request $request, $id)
    // {
    //     $imageNames = ProductPngDetails::where('product_id', $id)->get();
    //     foreach ($imageNames as $imageName) {
    //         $image = $imageName->ImagePngDetail;
    //         Storage::disk('s3')->delete($image);
    //     }

    //     ProductPngDetails::where('product_id', $id)->delete();
    //     return redirect()->back();
    // }
    public function deletePngAll(Request $request, $id)
    {
        $imageNames = ProductPngDetails::where('product_id', $id)->get();
        foreach ($imageNames as $imageName) {
            $image = $imageName->ImagePngDetail;
            Storage::disk('s3')->delete($image);
        }

        ProductPngDetails::where('product_id', $id)->delete();
        return redirect()->back();
    }
    // public function deletemocups($id)
    // {

    //     $imageName = mocupProduct::find($id)->mocup; // this returns the file name stored in the DB
    //     Storage::disk('s3')->delete($imageName);
    //     mocupProduct::where('id', $id)->delete();
    //     return response()->json(null);
    // }
    public function deletemocups($id)
    {

        $imageName = mocupProduct::find($id)->mocup; // this returns the file name stored in the DB
        Storage::disk('s3')->delete($imageName);
        mocupProduct::where('id', $id)->delete();
        return response()->json(null);
    }
    public function deleteProductPngDetails($id)
    {

        $imageName = ProductPngDetails::find($id)->ImagePngDetail; // this returns the file name stored in the DB
        Storage::disk('s3')->delete($imageName);
        ProductPngDetails::where('id', $id)->delete();
        return response()->json(null);
    }
    // public function deleteds($id)
    // {
    //     $ProductPngDetails = ProductPngDetails::where('product_id', $id)->get();
    //     foreach ($ProductPngDetails as $imageName) {
    //         $image = $imageName->ImagePngDetail;
    //         Storage::disk('s3')->delete($image);
    //     }
    //     $mocupProduct = mocupProduct::where('product_id', $id)->get();
    //     foreach ($mocupProduct as $imageName) {
    //         $image = $imageName->mocup;
    //         Storage::disk('s3')->delete($image);
    //     }
    //     Product::where('id', $id)->delete();
    //     return redirect()->back();
    // }
    public function deleteds($id)
    {
        $ProductPngDetails = ProductPngDetails::where('product_id', $id)->get();
        foreach ($ProductPngDetails as $imageName) {
            $image = $imageName->ImagePngDetail;
            Storage::disk('s3')->delete($image);
        }
        $mocupProduct = mocupProduct::where('product_id', $id)->get();
        foreach ($mocupProduct as $imageName) {
            $image = $imageName->mocup;
            Storage::disk('s3')->delete($image);
        }
        Product::where('id', $id)->delete();
        return redirect()->back();
    }
}
