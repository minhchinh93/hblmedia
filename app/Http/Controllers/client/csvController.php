<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\oder_Amz;
use App\Models\Oder_detail;
use App\Models\oder_Ebay;
use App\Models\Product;
use App\Models\ProductPngDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class csvController extends Controller
{
    //
    public function importCsv()
    {
        $show = ProductPngDetails::join('products', 'product_png_details.product_id', '=', 'products.id')
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
            ->Where('saller', Auth::user()->name)
            ->paginate(4);
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
            ->Where('saller', Auth::user()->name)
        // ->groupBy('')
        // ->Where('product_png_details.Sku', 'like', "%{$keyword}%")
        // ->orWhere('title', 'like', "%{$keyword}%")
            ->paginate(4);

        return view('client.checkOder.indexOder', [
            'shows' => $show,
            'showEbay' => $showEbay,
        ]);
    }
    public function postCsv(Request $request)
    {

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $location = 'uploads';
        $file->move($location, $filename);
        $filepath = public_path($location . "/" . $filename);
        // Reading file
        $file = fopen($filepath, "r");

        $filedata = fgetcsv($file, 1000, ',');

        $importData_arr = [];
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
            $num = count($filedata);
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);

        foreach ($importData_arr as $importData) {
            $insertData = [
                "Number_Items" => $importData[6],
                "Sale_Date" => $importData[0],
                "Order_Total" => $importData[23],
                "Date_Shipped" => $importData[8],
                "oder_sku" => $importData[35],
                "saller" => Auth::user()->name,
            ];
            Oder_detail::create($insertData);
        }
        return redirect()->back();
    }
    public function postCsvEbay(Request $request)
    {

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $location = 'uploads';
        $file->move($location, $filename);
        $filepath = public_path($location . "/" . $filename);
        // Reading file
        $file = fopen($filepath, "r");

        $filedata = fgetcsv($file, 1000, ',');

        $importData_arr = [];
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
            $num = count($filedata);
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);

        $v = 1;

        while ($v < (count($importData_arr) - 2)) {
            $v++;
            $str = $importData_arr[$v][23];
            $re = '/(.*)(\[.*\])/m';
            preg_match($re, $str, $matches);

            $Order_Total = str_replace('$', '', $importData_arr[$v][45]);
            if (preg_match($re, $str, $matches)) {
                $oder_Title = trim($matches[1]);
            } else {
                $oder_Title = null;
            }
            $insertData = [
                "Number_Items" => $importData_arr[$v][26],
                "Sale_Date" => $importData_arr[$v][49],
                "Order_Total" => is_numeric($Order_Total),
                "Date_Shipped" => $importData_arr[$v][50],
                "oder_Title" => $oder_Title,
                "saller" => Auth::user()->name,
            ];

            oder_Ebay::create($insertData);
            oder_Ebay::where('oder_Title', null)->delete();
        };
        return redirect()->back();
    }
    public function postCsvAmazon(Request $request)
    {

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $location = 'uploads';
        $file->move($location, $filename);
        $filepath = public_path($location . "/" . $filename);
        // Reading file
        $file = fopen($filepath, "r");
        $filedata = fgetcsv($file, 1000, ',');

        $importData_arr = [];
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
            $num = count($filedata);
            for ($c = 0; $c < $num; $c++) {
                $importData_arr[$i][] = $filedata[$c];
            }
            $i++;
        }
        fclose($file);

        foreach ($importData_arr as $importData) {
            if ($importData[12] != "") {
                $re = '/().*?(\s)/m';
                $str = $importData[12];
                preg_match_all($re, $str, $matches);
                $Sale_Date = $matches[0][0];
                $strr = $importData[3];
                preg_match_all($re, $strr, $matchess);
                $Date_Shipped = $matchess[0][0];
                $insertData = [
                    "Number_Items" => $importData[10],
                    "Sale_Date" => $Sale_Date,
                    "Order_Total" => $importData[11],
                    "Date_Shipped" => $Date_Shipped,
                    "saller" => Auth::user()->name,
                ];
            } else {
                $insertData = [
                    "Number_Items" => 0,
                    "Sale_Date" => 0,
                    "Order_Total" => 0,
                    "Date_Shipped" => 0,
                    "saller" => 0,
                ];
            }
            oder_Amz::create($insertData);
        }
        // oder_Amz::where('saller', 0)->delete();
        return redirect()->back();
    }
}
