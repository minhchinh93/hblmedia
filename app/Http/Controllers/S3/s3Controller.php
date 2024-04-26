<?php

namespace App\Http\Controllers\S3;

use App\Http\Controllers\Controller;
use App\Models\mocupProduct;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\ProductPngDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class s3Controller extends Controller
{

    public function addImage(Request $request, $id)
    {
     
        // Kiểm tra xem có tệp hình ảnh được gửi lên không
        if ($request->hasFile('image')) {
            // Lặp qua mỗi file hình ảnh được gửi lên
            foreach ($request->file('image') as $image) {
                // Tạo tên tệp duy nhất
                $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                
                // Lưu trữ tệp vào thư mục public/images
                // Tạo dữ liệu hình ảnh để lưu vào cơ sở dữ liệu
                $dataImage = [
                    'product_id' => $id,
                    'ImageDetail' =>  $image->storeAs('images', $imageName), // Lưu tên tệp vào cơ sở dữ liệu
                ];
    
                // Tạo bản ghi mới trong bảng ProductDetails
                ProductDetails::create($dataImage);
            }
        }
    
        return redirect()->back();
    }
    

    public function addPngDetailsIdea(Request $request, $id)
    {

        // dd($request->file('image'));

        $file = $request->file('image');
        $name = Product::where('id', $id)->first();

        foreach ($file as $image) {
            $str = $image->getClientOriginalName();
            // dd($str);
            // $filename = str_replace(' ', '-', $str);

            $dataImage = [
                'product_id' => $id,
                // 'ImagePngDetail' => Storage::disk('s3')->put('images', $name . '-' . $image),
                'ImagePngDetail' => $image->storeAs('images', $name->Sku . '-' . $str),
            ];
            // dd($dataImage);
            $datapng = ProductPngDetails::where('product_id', $id)->create($dataImage);
            $idPNG = $datapng->id;
            ProductPngDetails::where('id', $idPNG)->update([
                'Sku' => $name->Sku,
            ]);
        }
        Product::where('id', $id)->update(['status' => 5]);
        return redirect()->back();

    }
    public function deleteImage($id)
    {
        $imageName = ProductDetails::find($id)->ImageDetail; // this returns the file name stored in the DB
        Storage::disk('s3')->delete($imageName);
        ProductDetails::where('id', $id)->delete();
        return response()->json(null);

    }

    // làm lại
    // public function delete($id)
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
    public function delete($id)
{
    // Xóa tệp PNG liên quan đến sản phẩm
    $productPngDetails = ProductPngDetails::where('product_id', $id)->get();
    foreach ($productPngDetails as $detail) {
        $image = $detail->ImagePngDetail;
        Storage::delete('images/' . $image);
    }

    // Xóa tệp mocup liên quan đến sản phẩm
    $mocupProducts = MocupProduct::where('product_id', $id)->get();
    foreach ($mocupProducts as $mocup) {
        $image = $mocup->mocup;
        Storage::delete('images/' . $image);
    }

    // Xóa sản phẩm từ cơ sở dữ liệu
    Product::where('id', $id)->delete();

    // Chuyển hướng người dùng trở lại trang trước
    return redirect()->back();
}
//     public function Edit(Request $request, $id)
//     {
//         if ($request->size != "") {
//             $size = $request->size;
//         } else {
//             $size = null;
//         }
//         $images = "";
//         if ($request->image) {
//             $images = $request->file('image');
//             $data = [
//                 'id_type' => $request->type_id,
//                 'User_id' => $request->User_id,
//                 'id_idea' => Auth::user()->id,
//                 'image' => Storage::disk('s3')->put('images', $request->file('image')[0]),
//                 'title' => $request->title,
//                 'size_id' => $size,
//                 'description' => $request->description,

//             ];
//             Product::where('id', $id)->update($data);
//             ProductDetails::where('product_id', $id)->delete();
//             foreach ($request->file('image') as $image) {
//                 $dataImage = [
//                     'product_id' => $id,
//                     'ImageDetail' => Storage::disk('s3')->put('images', $image),
//                 ];
//                 ProductDetails::create($dataImage);
//             }
//         } else {
//             $data = [
//                 'id_type' => $request->type_id,
//                 'User_id' => $request->User_id,
//                 'id_idea' => Auth::user()->id,
//                 // 'image' => $request->file('image')[0]->store('images'),
//                 'title' => $request->title,
//                 'size_id' => $size,
//                 'description' => $request->description,

//             ];
//             Product::where('id', $id)->update($data);
//         }
//         return redirect()->back();
//     }
//     use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;

public function edit(Request $request, $id)
{
    $size = $request->size ?: null; // Sử dụng toán tử ba ngôi để kiểm tra và gán giá trị cho biến $size

    $images = $request->file('image');
    if ($images) {
        $product = Product::find($id);
        if ($product) {
            $product->id_type = $request->type_id;
            $product->User_id = $request->User_id;
            $product->id_idea = Auth::user()->id;
            $product->title = $request->title;
            $product->size_id = $size;
            $product->description = $request->description;

            // Xóa tất cả các bản ghi ProductDetails liên quan đến sản phẩm
            ProductDetails::where('product_id', $id)->delete();

            // Lặp qua các hình ảnh được gửi lên và lưu chúng vào thư mục lưu trữ
            foreach ($images as $image) {
                $imageName = $image->storeAs('images', $product->Sku . '-' . $product->id_type);
                // Tạo bản ghi mới trong bảng ProductDetails cho mỗi hình ảnh
                ProductDetails::create(['product_id' => $id, 'ImageDetail' => $imageName]);
            }

            // Lưu thông tin sản phẩm vào cơ sở dữ liệu
            $product->save();
        }
    } else {
        // Nếu không có hình ảnh được gửi lên, chỉ cập nhật thông tin sản phẩm
        Product::where('id', $id)->update([
            'id_type' => $request->type_id,
            'User_id' => $request->User_id,
            'id_idea' => Auth::user()->id,
            'title' => $request->title,
            'size_id' => $size,
            'description' => $request->description,
        ]);
    }

    // Chuyển hướng người dùng trở lại trang trước
    return redirect()->back();
}

    // public function addIdea(Request $request)
    // {

    //     if ($request->size != "") {
    //         $size = $request->size;
    //     } else {
    //         $size = null;
    //     }
    //     $images = "";
    //     if ($request->image) {
    //         $images = $request->file('image');
    //         $data = [
    //             'id_type' => $request->type_id,
    //             'User_id' => $request->User_id,
    //             'id_idea' => Auth::user()->id,
    //             'size_id' => $size,
    //             // 'image' => Storage::disk('s3')->put('images', $images[0]),
    //             'ImageDetail' => $images->storeAs('images', $name->Sku . '-' . $str),
    //             'description' => $request->description,
    //             'title' => $request->title,
    //             'Sku' => strtoupper(Str::random(12)),
    //         ];
    //         $productDtail = Product::create($data);
    //         foreach ($request->file('image') as $image) {
    //             $dataImage = [
    //                 'product_id' => $productDtail->id,
    //                 'ImageDetail' => $image->store('images'),
    //             ];
    //             ProductDetails::create($dataImage);
    //         }
    //     } else {
    //         $data = [
    //             'id_type' => $request->type_id,
    //             'User_id' => $request->User_id,
    //             'id_idea' => Auth::user()->id,
    //             'size_id' => $size,
    //             'description' => $request->description,
    //             'title' => $request->title,
    //             'Sku' => strtoupper(Str::random(12)),


    //         ];

    //         $productDtail = Product::create($data);
    //     }

    //     return redirect()->back();
    // }
    public function addIdea(Request $request)
{
    $size = $request->size ?? null; // Sử dụng toán tử nullish coalescing để xác định giá trị cho $size

    // Kiểm tra xem có hình ảnh được gửi lên không
    if ($request->hasFile('image')) {
        $images = $request->file('image');
        $data = [
            'id_type' => $request->type_id,
            'User_id' => $request->User_id,
            'id_idea' => Auth::user()->id,
            'size_id' => $size,
            'description' => $request->description,
            'title' => $request->title,
            'product_id' => 1,
            'Sku' => strtoupper(Str::random(12)),
        ];
        // Thay đổi phần gán giá trị cho biến $images
        $images = $request->file('image')[0];




        // Lưu đường dẫn của hình ảnh vào thư mục 'images' và lưu vào trường 'ImageDetail'
        $data['image'] = $images->storeAs('images', $data['Sku'] . '-' . $data['id_type']);
        // Tạo một bản ghi mới cho sản phẩm
        $productDetail = Product::create($data);

        // Tạo các chi tiết sản phẩm cho mỗi hình ảnh gửi lên
        foreach ($request->file('image') as $image) {
            $dataImage = [
                'product_id' => $productDetail->id,
                'ImageDetail' => $image->store('images'),
            ];
            ProductDetails::create($dataImage);
        }
    } else {
        // Nếu không có hình ảnh được gửi lên
        $data = [
            'id_type' => $request->type_id,
            'User_id' => $request->User_id,
            'id_idea' => Auth::user()->id,
            'size_id' => $size,
            'description' => $request->description,
            'title' => $request->title,
            'Sku' => strtoupper(Str::random(12)),
        ];

        // Tạo một bản ghi mới cho sản phẩm
        $productDetail = Product::create($data);
    }

    // Chuyển hướng ngược lại trang trước
    return redirect()->back();
}


}
