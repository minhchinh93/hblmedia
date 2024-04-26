<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\mocupProduct;
use App\Models\Product;
use App\Models\ProductPngDetails;
use App\Models\taskJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class adminHomeController extends Controller
{
    //
    public function home()
    {
        Carbon::setLocale('vi');
        $yes = Carbon::yesterday('Asia/Ho_Chi_Minh');
        $timess = $yes->toDateString();
        $toDayDateTimeString = $yes->toFormattedDateString();
        $report = Product::orderBy('id', 'desc')
            ->paginate(7);
        $user = User::paginate(6);
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
        // dd(count($mocup));
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
        // dd($str);
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

        // foreach ($totalPNG as $png) {
        //     $strss[] = $png->value;
        // }
        // $strpng = implode(", ", $strss);
        if ($report->total() != 0) {
            foreach ($report as $billdd) {
                $dt[] = Carbon::create($billdd->created_at);
            }

            foreach ($dt as $key) {
                $now = Carbon::now();
                $time[] = $key->diffForHumans($now);
            }
        } else {
            $time = '';

        }

        $Jobprivate = taskJob::where('private', 2)->orderBy('created_at', 'DESC')->get();
        $jobPublic = taskJob::where('private', 1)->orderBy('created_at', 'DESC')->get();
        $job = taskJob::orderBy('created_at', 'DESC')->paginate(5);

        return view('admin/home/index',
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
                'Jobprivates' => $Jobprivate,
                'jobPublics' => $jobPublic,
                'jobs' => $job,
                'time' => $time,
                'timess' => $toDayDateTimeString,

            ]);
    }
    public function showIdea()
    {
        User::find(1)->update(['payment' => 1]);
        return redirect()->route('AadminHome');
    }
    public function showPNG()
    {
        User::find(1)->update(['payment' => 2]);
        return redirect()->route('AadminHome');
    }
}
