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

    // public function addImage(Request $request, $id)
    // {
     
    //     // Kiểm tra xem có tệp hình ảnh được gửi lên không
    //     if ($request->hasFile('image')) {
    //         // Lặp qua mỗi file hình ảnh được gửi lên
    //         foreach ($request->file('image') as $image) {
    //             // Tạo tên tệp duy nhất
    //             $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                
    //             // Lưu trữ tệp vào thư mục public/images
    //             // Tạo dữ liệu hình ảnh để lưu vào cơ sở dữ liệu
    //             $dataImage = [
    //                 'product_id' => $id,
    //                 'ImageDetail' =>  $image->storeAs('images', $imageName), // Lưu tên tệp vào cơ sở dữ liệu
    //             ];
    
    //             // Tạo bản ghi mới trong bảng ProductDetails
    //             ProductDetails::create($dataImage);
    //         }
    //     }
    
    //     return redirect()->back();
    // }
    public function addImage(Request $request, $id)
{
    // Kiểm tra xem có tệp hình ảnh được gửi lên không
    if ($request->hasFile('image')) {
        // Lặp qua mỗi file hình ảnh được gửi lên
        foreach ($request->file('image') as $image) {
            // Tạo tên tệp duy nhất
            $imageName = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
            
            // Lưu trữ tệp lên S3
            $path = Storage::disk('s3')->putFileAs('images', $image, $imageName);
            
            // Kiểm tra xem việc lưu trữ đã thành công chưa
            if ($path) {
                // Tạo dữ liệu hình ảnh để lưu vào cơ sở dữ liệu
                $dataImage = [
                    'product_id' => $id,
                    'ImageDetail' => $path, // Lưu đường dẫn tới tệp trên S3 vào cơ sở dữ liệu
                ];
    
                // Tạo bản ghi mới trong bảng ProductDetails
                ProductDetails::create($dataImage);
            } else {
                // Xử lý lỗi nếu việc lưu trữ không thành công
                // Ví dụ: trả về thông báo lỗi cho người dùng
                return redirect()->back()->with('error', 'Failed to upload image to S3');
            }
        }
    }
    
    return redirect()->back();
}  

public function addPngDetailsIdea(Request $request, $id)
{
    try {
        $files = $request->file('image');
        $product = Product::findOrFail($id);

        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();

            // Lưu file hình ảnh lên S3 và lấy đường dẫn
            $imagePath = $file->storeAs('images', $product->Sku . '-' . $filename, 's3');

            $dataImage = [
                'product_id' => $id,
                'ImagePngDetail' => $imagePath,
                'Sku' => $product->Sku,
            ];

            ProductPngDetails::create($dataImage);
        }

        // Cập nhật trạng thái của sản phẩm
        $product->update(['status' => 5]);

        return redirect()->back();
    } catch (\Exception $e) {
        // Xử lý lỗi tại đây, có thể ghi log lỗi, thông báo cho người dùng, hoặc thực hiện các hành động cần thiết khác.
        return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm chi tiết hình ảnh. Vui lòng thử lại sau.');
    }
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

public function Edit(Request $request, $id)
{
    if ($request->size != "") {
        $size = $request->size;
    } else {
        $size = null;
    }
    $images = "";
    if ($request->image) {
        $images = $request->file('image');
        $data = [
            'id_type' => $request->type_id,
            'User_id' => $request->User_id,
            'id_idea' => Auth::user()->id,
            'image' => Storage::disk('s3')->put('images', $request->file('image')[0]),
            'title' => $request->title,
            'size_id' => $size,
            'description' => $request->description,

        ];
        Product::where('id', $id)->update($data);
        ProductDetails::where('product_id', $id)->delete();
        foreach ($request->file('image') as $image) {
            $dataImage = [
                'product_id' => $id,
                'ImageDetail' => Storage::disk('s3')->put('images', $image),
            ];
            ProductDetails::create($dataImage);
        }
    } else {
        $data = [
            'id_type' => $request->type_id,
            'User_id' => $request->User_id,
            'id_idea' => Auth::user()->id,
            // 'image' => $request->file('image')[0]->store('images'),
            'title' => $request->title,
            'size_id' => $size,
            'description' => $request->description,

        ];
        Product::where('id', $id)->update($data);
    }
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
//     public function addIdea(Request $request)
// {
//     $size = $request->size ?? null; // Sử dụng toán tử nullish coalescing để xác định giá trị cho $size

//     // Kiểm tra xem có hình ảnh được gửi lên không
//     if ($request->hasFile('image')) {
//         $images = $request->file('image');
//         $data = [
//             'id_type' => $request->type_id,
//             'User_id' => $request->User_id,
//             'id_idea' => Auth::user()->id,
//             'size_id' => $size,
//             'description' => $request->description,
//             'title' => $request->title,
//             'product_id' => 1,
//             'Sku' => strtoupper(Str::random(12)),
//         ];
//         // Thay đổi phần gán giá trị cho biến $images
//         $images = $request->file('image')[0];




//         // Lưu đường dẫn của hình ảnh vào thư mục 'images' và lưu vào trường 'ImageDetail'
//         $data['image'] = $images->storeAs('images', $data['Sku'] . '-' . $data['id_type']);
//         // Tạo một bản ghi mới cho sản phẩm
//         $productDetail = Product::create($data);

//         // Tạo các chi tiết sản phẩm cho mỗi hình ảnh gửi lên
//         foreach ($request->file('image') as $image) {
//             $dataImage = [
//                 'product_id' => $productDetail->id,
//                 'ImageDetail' => $image->store('images'),
//             ];
//             ProductDetails::create($dataImage);
//         }
//     } else {
//         // Nếu không có hình ảnh được gửi lên
//         $data = [
//             'id_type' => $request->type_id,
//             'User_id' => $request->User_id,
//             'id_idea' => Auth::user()->id,
//             'size_id' => $size,
//             'description' => $request->description,
//             'title' => $request->title,
//             'Sku' => strtoupper(Str::random(12)),
//         ];

//         // Tạo một bản ghi mới cho sản phẩm
//         $productDetail = Product::create($data);
//     }

//     // Chuyển hướng ngược lại trang trước
//     return redirect()->back();
// }

public function addIdea(Request $request)
{
    try {
        $size = $request->size != "" ? $request->size : null;

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
                'Sku' => $request->Sku ?? strtoupper(Str::random(12)),
            ];

            // Lưu hình ảnh chính vào Amazon S3 và lấy đường dẫn
            $mainImagePath = Storage::disk('s3')->put('images', $images[0]);
            $data['image'] = $mainImagePath;

            $productDetail = Product::create($data);

            foreach ($images as $image) {
                $dataImage = [
                    'product_id' => $productDetail->id,
                    'ImageDetail' => Storage::disk('s3')->put('images', $image),
                ];
                ProductDetails::create($dataImage);
            }
        } else {
            $data = [
                'id_type' => $request->type_id,
                'User_id' => $request->User_id,
                'id_idea' => Auth::user()->id,
                'size_id' => $size,
                'description' => $request->description,
                'title' => $request->title,
                'product_id' => 1,
                'Sku' => $request->Sku ?? strtoupper(Str::random(12)),
            ];

            $productDetail = Product::create($data);
        }

        return redirect()->back();
    } catch (\Exception $e) {
        // Xử lý lỗi tại đây, có thể ghi log lỗi, thông báo cho người dùng, hoặc thực hiện các hành động cần thiết khác.
        return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm ý tưởng. Vui lòng thử lại sau.');
    }

}
public function addmocupidea(Request $request, $id)
{
    foreach ($request->file('image') as $image) {
        $str = $image->getClientOriginalName();
        $filename = str_replace(' ', '-', $str);
        
        // Upload image to S3
        $path = Storage::disk('s3')->put('images', $image);

        $dataImage = [
            'product_id' => $id,
            'mocup' => $path,
        ];

        mocupProduct::create($dataImage);
    }
    return redirect()->back();
}
}