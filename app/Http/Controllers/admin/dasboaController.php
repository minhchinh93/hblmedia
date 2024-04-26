<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductPngDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dasboaController extends Controller
{
    //
    public function showdasboa(Request $request)
    {
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $yes = Carbon::yesterday('Asia/Ho_Chi_Minh');
        $time = $dt->toDateString();
        $yesterday = $yes->toDateString();
        $totaDay = Product::where('created_at', 'LIKE', '%' . $time . '%')->count();

        $totaSusecDay = Product::where('created_at', 'LIKE', '%' . $time . '%')->where('status', 5)->count();
        $totalidea = Product::all()->count();
        $totalPNG = ProductPngDetails::all()->count();
        $totaldayPNG = ProductPngDetails::where('created_at', 'LIKE', '%' . $time . '%')->count();
        // $totaldayMockup = mocupProduct::where('update', 'LIKE', '%' . $time . '%')->count();
        $totalIdeamember = User::where('role', 2)->count();
        $totalDesigner = User::where('role', 1)->count();
        // $totalATM = bill::where('payment', 'ATM')->count();
        $Idea = User::join('products', 'products.id_idea', '=', 'users.id')
            ->select(DB::raw('COUNT(products.id_idea) as "sum",
            users.name as "name",
            users.email as "email",
            users.role as "role",
            users.deleted_at as "deleted_at",
            products.id_idea as "id"
            '
            ))
            ->orderBy('sum', 'DESC')
            ->groupBy('products.id_idea')
            ->get();

        if ($request->keyword1 != '') {
            $keyword1 = $request->keyword1;
            $keyword2 = $request->keyword2;
        } else {
            $keyword1 = $yesterday;
            $keyword2 = $yesterday;
        }

        $mocup = User::join('products', 'products.User_id', '=', 'users.id')
            ->join('mocup_products', 'mocup_products.product_id', '=', 'products.id')
            ->select(DB::raw('
            COUNT(mocup_products.id) as "mocup_products",
            users.name as "name",
            users.email as "email",
            users.role as "role",
            users.id as "idUser",
            users.deleted_at as "deleted_at",
            products.User_id as "id"
            '
            ))
            ->groupBy('idUser')
            ->whereBetween('mocup_products.updated_at', [$keyword1 . ' 00:00:00', $keyword2 . ' 23:59:59'])
            ->orderBy('idUser', 'DESC')
            ->get();

        $designer = User::join('products', 'products.User_id', '=', 'users.id')
            ->join('product_png_details', 'product_png_details.product_id', '=', 'products.id')
            ->select(DB::raw('COUNT(product_png_details.id) as "product_png_details",
            users.name as "name",
            users.email as "email",
            users.role as "role",
            users.id as "idUser",
            users.deleted_at as "deleted_at",
            products.User_id as "id"
            '))
            ->groupBy('idUser')
            ->whereBetween('product_png_details.updated_at', [$keyword1 . ' 00:00:00', $keyword2 . ' 23:59:59'])
            ->orderBy('idUser', 'DESC')
            ->get();

        return view('admin/dasboa/index'
            , [
                'shows' => $Idea,
                'designer' => $designer,
                'totalDesign' => $totalPNG,
                'totalIdea' => $totalidea,
                'totaDay' => $totaDay,
                'totaSusecDay' => $totaSusecDay,
                'totalDayDesigner' => $totaldayPNG,
                'totalIdeamember' => $totalIdeamember,
                'totalDesigner' => $totalDesigner,
                'mocup' => $mocup,

            ]
        );
    }
    public function DetailMember($id)
    {

        return view('admin/dasboa/chitiet',
        );
    }
}
