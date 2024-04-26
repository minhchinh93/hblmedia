<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPngDetails;
use Illuminate\Support\Facades\DB;

class detailOderController extends Controller
{
    //
    public function estydetail($name)
    {
        $showEsty = ProductPngDetails::join('products', 'product_png_details.product_id', '=', 'products.id')
        // INNER JOIN users ON products.id_idea = users.id
            ->join('users', 'products.User_id', '=', 'users.id')
            ->join('oder_details', 'oder_details.oder_sku', '=', 'product_png_details.Sku')
            ->select(DB::raw('
            users.name as "name",
            products.title as "title",
            product_png_details.ImagePngDetail as "ImagePngDetail",
            oder_details.Number_Items as "Number_Items",
            oder_details.order_Total as "Order_Total",
            oder_details.Sale_Date as "Sale_Date",
            oder_details.Date_Shipped as "Date_Shipped",
            oder_details.saller as "saller"
            '
            ))
            ->distinct()
            ->Where('saller', $name)
            ->paginate(8);

        return view('admin.detailOder.detailEsty', [
            'shows' => $showEsty,

        ]);
    }
    public function ebaydetail($name)
    {
        $showEbay = Product::join('product_png_details', 'product_png_details.product_id', '=', 'products.id')
            ->join('oder__ebays', 'oder__ebays.oder_Title', '=', 'products.title')
            ->join('users', 'products.User_id', '=', 'users.id')
            ->select(DB::raw('
        users.name as "name",
        products.title as "title",
        product_png_details.ImagePngDetail as "ImagePngDetail",
        oder__ebays.Number_Items as "Number_Items",
        oder__ebays.order_Total as "Order_Total",
        oder__ebays.Sale_Date as "Sale_Date",
        oder__ebays.Date_Shipped as "Date_Shipped",
        oder__ebays.saller as "saller"
        '
            ))
            ->distinct()
            ->Where('saller', $name)
        // ->groupBy('')
        // ->Where('product_png_details.Sku', 'like', "%{$keyword}%")
        // ->orWhere('title', 'like', "%{$keyword}%")
            ->paginate(8);
        return view('admin.detailOder.detailEbay', [
            'showEbay' => $showEbay,

        ]);
    }
}
