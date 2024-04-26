<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\ProductPngDetails;
use App\Models\type_product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class finePngController extends Controller
{
    // SELECT
    // users.name as "name",
    // products.title as "title",
    // product_png_details.ImagePngDetail as "ImagePngDetail"
    // FROM product_png_details
    // INNER JOIN products ON product_png_details.product_id = products.id
    // INNER JOIN users ON products.id_idea = users.id
    public function findPNG(Request $request)
    {
        $keyword = $request->keyword;
        if ($request->keyword != null) {
            // $type = $request->type;
            $show = ProductPngDetails::join('products', 'product_png_details.product_id', '=', 'products.id')
                ->join('users', 'products.User_id', '=', 'users.id')
                ->leftJoin('type_products', 'type_products.id', '=', 'products.id_type')
                ->leftJoin('oder_details', 'oder_details.oder_sku', '=', 'product_png_details.Sku')
                ->select(DB::raw('
            users.name as "name",
            products.id_idea as "id_idea",
            products.title as "title",
            products.id as "id",
            type_products.id as "id_type",
            product_png_details.ImagePngDetail as "ImagePngDetail",
            product_png_details.Sku as "Sku",
            oder_details.Number_Items as "Number_Items",
            oder_details.order_Total as "Order_Total",
            oder_details.Sale_Date as "Sale_Date",
            oder_details.Date_Shipped as "Date_Shipped",
            oder_details.saller as "saller"
            '
                ))
            // ->Where('id_type', '=', $type)
                ->Where('product_png_details.Sku', 'like', "%{$keyword}%")
                ->orWhere('title', 'like', "%{$keyword}%")

                ->orderBy('product_png_details.created_at', 'DESC')
                ->paginate(24);

            $show->appends(['keyword' => $keyword]);
            // ->first();
        } else {
            $type = $request->type;
            $show = ProductPngDetails::join('products', 'product_png_details.product_id', '=', 'products.id')
                ->join('users', 'products.User_id', '=', 'users.id')
                ->leftJoin('type_products', 'type_products.id', '=', 'products.id_type')
                ->leftJoin('oder_details', 'oder_details.oder_sku', '=', 'product_png_details.Sku')
                ->select(DB::raw('
            users.name as "name",
            products.id_idea as "id_idea",
            products.title as "title",
            products.id as "id",
            type_products.id as "id_type",
            product_png_details.ImagePngDetail as "ImagePngDetail",
            product_png_details.Sku as "Sku",
            oder_details.Number_Items as "Number_Items",
            oder_details.order_Total as "Order_Total",
            oder_details.Sale_Date as "Sale_Date",
            oder_details.Date_Shipped as "Date_Shipped",
            oder_details.saller as "saller"
            '
                ))
                ->Where('id_type', '=', $type)
            // ->Where('product_png_details.Sku', 'like', "%{$keyword}%")
            // ->orWhere('title', 'like', "%{$keyword}%")

                ->orderBy('product_png_details.created_at', 'DESC')
                ->paginate(24);
            // ->first();
            $show->appends(['type' => $type]);

        }
        if ($show->total() > 0) {

            foreach ($show as $shows) {
                $User = User::where('id', $shows->id_idea)->first();
                if (empty($User)) {
                    $users = 'idea đã bị xóa';
                } else {
                    $users = $User->name;
                }
                $user[] = $users;
            }
        } else {
            $user = [];
        }
        $categories = type_product::get();
        return view('client.findPNG.indexPNG', [
            'shows' => $show,
            'categories' => $categories,
            'user' => $user,
        ]);
    }
}
