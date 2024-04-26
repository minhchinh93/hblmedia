<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\mocupProduct;
use App\Models\Product;
use App\Models\ProductPngDetails;
use App\Models\taskJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class indexController extends Controller
{
    //
    public function dasboa(Request $request)
    {
        if (Auth::check()) {
            {

                Carbon::setLocale('vi');
                $yes = Carbon::yesterday('Asia/Ho_Chi_Minh');
                $timess = $yes->toDateString();
                $toDayDateTimeString = $yes->toFormattedDateString();
                $report = Product::orderBy('id', 'desc')
                    ->paginate(7);
                $user = User::paginate(5);
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
                    ->where('products.created_at', 'LIKE', '%' . $timess . '%')
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
                    ->orderBy('idUser', 'DESC')
                    ->where('product_png_details.created_at', 'LIKE', '%' . $timess . '%')
                    ->get();
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
                    ->orderBy('idUser', 'DESC')
                    ->where('mocup_products.created_at', 'LIKE', '%' . $timess . '%')
                    ->get();

                $day = Carbon::now()->subDay(6);

                $totalidea = Product::where('created_at', '>=', $day)
                    ->groupBy('date')
                    ->orderBy('date', 'ASC')
                    ->get([
                        DB::raw('Date(created_at) as date'),
                        DB::raw('COUNT(*) as value'),
                    ]);
                // foreach ($totalidea as $idea) {
                //     $strs[] = $idea->value;
                // }
                // $str = implode(", ", $strs);
                // // dd($str);
                $totalPNG = ProductPngDetails::where('created_at', '>=', $day)
                    ->groupBy('date')
                    ->orderBy('date', 'ASC')
                    ->get([
                        DB::raw('Date(created_at) as date'),
                        DB::raw('COUNT(*) as value'),
                    ]);
                $totalMockup = mocupProduct::where('created_at', '>=', $day)
                    ->groupBy('date')
                    ->orderBy('date', 'ASC')
                    ->get([
                        DB::raw('Date(created_at) as date'),
                        DB::raw('COUNT(*) as value'),
                    ]);

                if ($report->total() != 0) {
                    foreach ($report as $billdd) {
                        $dt[] = Carbon::create($billdd->created_at);
                    }

                    foreach ($dt as $key) {
                        $now = Carbon::now();
                        $updated_at[] = $key->diffForHumans($now);
                    }
                } else {
                    $updated_at = '';

                }
                // dd($report);
                $job = taskJob::orderBy('created_at', 'DESC')->paginate(5);
                $dt = Carbon::now('Asia/Ho_Chi_Minh');
                $yes = Carbon::yesterday('Asia/Ho_Chi_Minh');
                $time = $dt->toDateString();
                $yesterday = $yes->toDateString();

                if ($request->keyword1 != '') {
                    $keyword1 = $request->keyword1;
                    $keyword2 = $request->keyword2;
                } else {
                    $keyword1 = $yesterday;
                    $keyword2 = $time;
                }
                $Ideatable = User::join('products', 'products.id_idea', '=', 'users.id')
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
                    ->where('products.id_idea', Auth::id())
                    ->whereBetween('products.updated_at', [$keyword1 . ' 00:00:00', $keyword2 . ' 23:59:59'])
                    ->get();

                return view('client/idea/index',
                    [
                        'shows' => $report,
                        'users' => $user,
                        'Idea' => $Idea,
                        'designer' => $designer,
                        'totalidea' => $totalidea,
                        'totalPNG' => $totalPNG,
                        'totalMockup' => $totalMockup,
                        // 'str' => $str,
                        // 'strpng' => $strpng,
                        'mocup' => $mocup,
                        'jobs' => $job,
                        // 'totalDesigner' => $totalDesigner,
                        'time' => $updated_at,
                        'timess' => $toDayDateTimeString,
                        'Ideatable' => $Ideatable,
                        'keyword1' => $keyword1,
                        'keyword2' => $keyword2,

                    ]);
            }
        } else {
            return redirect()->route('login');
        }
    }
}
