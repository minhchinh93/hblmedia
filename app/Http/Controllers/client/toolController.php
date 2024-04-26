<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\cornerstone;
use App\Models\Product;
use App\Models\ProductPngDetails;
use App\Models\size;
use App\Models\type_product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class toolController extends Controller
{
    //
    public function showTool(Request $request)
    {
        $show = cornerstone::all();
        $users = User::all();
        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $show = cornerstone::all();
        $times = $now->toDateString();
        $designer = User::get()->where('role', 2);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;

        if ($request->cornerstone != null) {
            if ($keyword != "") {

                $report = Product::join('product_cornerstone', 'product_cornerstone.id_product', '=', 'products.id')
                    ->select(DB::raw('
        COUNT(product_cornerstone.cornerstones_id),
        products.id as "id",
        products.id_type as "id_type",
        products.User_id as "User_id",
        products.id_idea as "id_idea",
        products.size_id as "size_id",
        products.title as "title",
        products.description as "description",
        products.ImagePNG as "ImagePNG",
        products.status as "status",
        products.action as "action",
        products.created_at as "created_at",
        products.updated_at as "updated_at"
        '
                    ))
                    ->groupBy('products.id')
                    ->Where('status', "5")
                    ->Where('product_cornerstone.cornerstones_id', $request->cornerstone)
                    ->Where('title', 'like', "%{$keyword}%")
                    ->paginate(10);
                $report->appends(['keyword' => $keyword, 'cornerstone' => $request->cornerstone]);
            } else {
                $report = Product::join('product_cornerstone', 'product_cornerstone.id_product', '=', 'products.id')
                    ->select(DB::raw('
        COUNT(product_cornerstone.cornerstones_id),
        products.id as "id",
        products.id_type as "id_type",
        products.User_id as "User_id",
        products.id_idea as "id_idea",
        products.size_id as "size_id",
        products.title as "title",
        products.description as "description",
        products.ImagePNG as "ImagePNG",
        products.status as "status",
        products.action as "action",
        products.created_at as "created_at",
        products.updated_at as "updated_at"
        '
                    ))
                    ->groupBy('products.id')
                    ->Where('status', "5")
                    ->Where('product_cornerstone.cornerstones_id', $request->cornerstone)
                // ->Where('title', 'like', "%{$keyword}%")
                    ->paginate(10);
            }

        } else {
            if ($keyword != "") {

                $report = Product::orderBy('updated_at', 'desc')
                    ->Where('status', "5")
                    ->Where('title', 'like', "%{$keyword}%")
                    ->paginate(10);
                $report->appends(['keyword' => $keyword]);
            } else {
                $report = Product::orderBy('updated_at', 'desc')
                    ->Where('status', "5")
                    ->paginate(10);}

        }
        {
            if ($report->total() > 0) {
                foreach ($report as $rep) {
                    $userIdeas[] = User::where('id', $rep->id_idea)->get();
                }
                foreach ($userIdeas as $userIdea) {
                    $name[] = $userIdea;
                }

            } else {
                $name = "";
            }
        }

        if ($report->total() != 0) {
            foreach ($report as $billdd) {
                $dt[] = Carbon::create($billdd->created_at);
            }

            foreach ($dt as $key) {
                $now = Carbon::now('Asia/Ho_Chi_Minh');
                $time[] = $key->diffForHumans($now);
            }
        } else {
            $time = '';

        }

        $totalDone = Product::orderBy('id', 'desc')->where('status', 5)->count();
        $totalPending = Product::orderBy('id', 'desc')->where('status', 3)->count();
        $totalNotReceived = Product::orderBy('id', 'desc')->where('status', 1)->count();
        $totalallidea = Product::orderBy('id', 'desc')->count();
        return view('client.dasboa.tool',
            ['designers' => $designer,
                'reports' => $report,
                'totalDone' => $totalDone,
                'totalPending' => $totalPending,
                'totalNotReceived' => $totalNotReceived,
                'type_products' => $type_product,
                'totalallidea' => $totalallidea,
                'times' => $time,
                'sizes' => $size,
                'name' => $name,
                'shows' => $show,
                'users' => $users,

            ]);
        // return view('client.dasboa.tool', [
        //     'shows' => $show,
        //     'users' => $users,
        // ]);
    }
    public function postTypeProduct(Request $request)
    {

        // $inputs = preg_split('/\r\n|\r|\n/', );

        $type = type_product::create($request->only('name'));

        $inputs = explode("|", $request->size);
        $i = 0;
        foreach ($inputs as $input) {
            size::create([
                'id_types' => $type->id,
                'name' => $inputs[$i++],

            ]);
        }

        return redirect()->route('home');

    }

    public function carbon()
    {
        $dt = Carbon::now();
        // echo $dt;
        // echo $dt->addDays(29);
        // echo $dt->addDay(1);
        echo $dt->subDay(1);
        // echo $dt->subDays(29);

    }
    public function Sku()
    {

        foreach (ProductPngDetails::all() as $skus) {
            $id = $skus->id;
            $name = strtoupper(Str::random(4));
            $sku = $name . "-" . $id;

            ProductPngDetails::where('id', $id)->update([
                'Sku' => $sku,
            ]);

        }
        print "ok";
    }
    public function cornerstone(Request $request)
    {

        cornerstone::create($request->only('name'));
        return redirect()->route('showtool');
    }
    public function cornerstoneProduct(Request $request, $id)
    {
        $product = Product::find($id);
        $product->cornerstones()->attach($request->cornerstone);
        return redirect()->back();
    }
    public function cornerstoneadd(Request $request)
    {
        $products = Product::where('id_idea', $request->users)->get();
        foreach ($products as $product) {
            $product->cornerstones()->attach($request->cornerstone);
        }

        return redirect()->route('home');
    }
    public function cornerstonedele(Request $request)
    {
        $products = Product::where('id_idea', $request->users)->get();
        foreach ($products as $product) {
            $product->cornerstones()->detach($request->cornerstone);
        }

        return redirect()->route('home');
    }
    public function showIdeaa()
    {
        User::find(1)->update(['payment' => 1]);
        return redirect()->back();
    }
    public function showPNGG()
    {
        User::find(1)->update(['payment' => 2]);
        return redirect()->back();
    }
    public function showMockup()
    {
        User::find(1)->update(['payment' => 3]);
        return redirect()->back();
    }
    public function addplasform(Request $request)
    {
        // dd($request->all());

        if ($request->check_box) {
            $products = Product::whereIn('id', $request->check_box)->get();
            foreach ($products as $product) {
                $product->cornerstones()->attach($request->plasform);
            }
        }
        return redirect()->back();
    }
    public function deleteplasform(Request $request)
    {
        // dd($request->all());

        if ($request->check_box) {
            $products = Product::whereIn('id', $request->check_box)->get();
            foreach ($products as $product) {
                $product->cornerstones()->detach($request->plasform);
            }
        }
        return redirect()->back();
    }

}
