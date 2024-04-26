<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\cornerstone;
use App\Models\Product;
use App\Models\size;
use App\Models\type_product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class totalController extends Controller
{
    //
    public function totalDesigner()
    {
        Carbon::setLocale('vi');
        $dt = Carbon::now('Asia/Ho_Chi_Minh');
        $time = $dt->toDateString();
        $report = Product::orderBy('updated_at', 'desc')->where('updated_at', 'LIKE', '%' . $time . '%')->paginate(10);
        $totalPending = Product::orderBy('id', 'desc')->where('updated_at', 'LIKE', '%' . $time . '%')->where('status', 4)->count();
        $totalDone = Product::orderBy('id', 'desc')->where('updated_at', 'LIKE', '%' . $time . '%')->where('status', 5)->count();
        $totalNotSeen = Product::orderBy('id', 'desc')->where('updated_at', 'LIKE', '%' . $time . '%')->where('status', 1)->count();
        $totalNotReceived = Product::orderBy('id', 'desc')->where('updated_at', 'LIKE', '%' . $time . '%')->where('action', 2)->where('status', '<>', 5)->count();
        $totalPendingDS = Product::orderBy('id', 'desc')->where('updated_at', 'LIKE', '%' . $time . '%')->where('status', 3)->count();
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
        // dd($report[0]->User->name);
        return view('admin.total.totalDesigner',
            ['reports' => $report,
                'totalPending' => $totalPending,
                'totalDone' => $totalDone,
                'totalNotSeen' => $totalNotSeen,
                'totalprioritize' => $totalNotReceived,
                'totalPendingDS' => $totalPendingDS,
            ]);
    }

    public function totalidea(Request $request)
    {

        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $times = $now->toDateString();
        $designer = User::get()->where('role', 2);
        $type_product = type_product::get();
        $size = size::get();
        $showcornerstone = cornerstone::all();
        $keyword = $request->keyword;

        if ($keyword != "") {
            $report = Product::orderBy('id', 'desc')->where('created_at', 'LIKE', '%' . $times . '%')
                ->Where('title', 'like', "%{$keyword}%")
                ->Where('description', 'like', "%{$keyword}%")
                ->paginate(10);
            $report->appends(['keyword' => $keyword]);
        } else {
            $report = Product::orderBy('id', 'desc')->where('created_at', 'LIKE', '%' . $times . '%')
                ->paginate(10);}

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
        // dd($time[4]);
        // dd(count($report[0]->mocups));

        $totalDone = Product::orderBy('created_at', 'desc')->where('created_at', 'LIKE', '%' . $times . '%')->where('status', 5)->count();
        $totalPending = Product::orderBy('updated_at', 'desc')->where('updated_at', 'LIKE', '%' . $times . '%')->where('status', 3)->count();
        $totalNotReceived = Product::orderBy('updated_at', 'desc')->where('updated_at', 'LIKE', '%' . $times . '%')->where('status', 1)->count();
        $totalallidea = Product::orderBy('updated_at', 'desc')->where('updated_at', 'LIKE', '%' . $times . '%')->count();
        return view('admin.total.totalidea',
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
                'showcornerstones' => $showcornerstone,

            ]);
    }
    public function totalall(Request $request)
    {

        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $show = cornerstone::all();
        $times = $now->toDateString();
        $designer = User::get()->where('role', 1);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;
        $showcornerstone = cornerstone::all();
        if ($request->cornerstone != null) {
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
                ->Where('product_cornerstone.cornerstones_id', $request->cornerstone)
                ->orWhere('title', 'like', "%{$keyword}%")
                ->paginate(100);

        } else {
            $report = Product::orderBy('updated_at', 'desc')
                ->Where('title', 'like', "%{$keyword}%")
                ->paginate(10);
        }

        // foreach ($report as $rep) {
        //     foreach ($rep->cornerstones as $corner) {
        //         $name[] = $corner->name;
        //     }
        // }

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
        // dd($time[4]);
        // dd(count($report[0]->mocups));

        $totalDone = Product::orderBy('id', 'desc')->where('status', 5)->count();
        $totalPending = Product::orderBy('id', 'desc')->where('status', 3)->count();
        $totalNotReceived = Product::orderBy('id', 'desc')->where('status', 1)->count();
        $totalallidea = Product::orderBy('id', 'desc')->count();
        return view('admin.total.totalidea',
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
                'showcornerstones' => $showcornerstone,
            ]);
    }
    public function totalPending(Request $request)
    {
        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $show = cornerstone::all();
        $times = $now->toDateString();
        $designer = User::get()->where('role', 2);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;
        $showcornerstone = cornerstone::all();
        if ($request->cornerstone != null) {
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
        products.updated_at as "updated_at",
        Product.status as "status"
        '
                ))
                ->groupBy('products.id')
                ->where('status', 3)
                ->Where('product_cornerstone.cornerstones_id', $request->cornerstone)
                ->orWhere('title', 'like', "%{$keyword}%")
                ->paginate(100);

        } else {
            $report = Product::orderBy('updated_at', 'desc')
                ->Where('title', 'like', "%{$keyword}%")
                ->where('status', 3)
                ->paginate(10);
        }

        // foreach ($report as $rep) {
        //     foreach ($rep->cornerstones as $corner) {
        //         $name[] = $corner->name;
        //     }
        // }

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
        // dd($time[4]);
        // dd(count($report[0]->mocups));

        $totalDone = Product::orderBy('id', 'desc')->where('status', 5)->count();
        $totalPending = Product::orderBy('id', 'desc')->where('status', 3)->count();
        $totalNotReceived = Product::orderBy('id', 'desc')->where('status', 1)->count();
        $totalallidea = Product::orderBy('id', 'desc')->count();
        return view('admin.total.totalidea',
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
                'showcornerstones' => $showcornerstone,
            ]);
    }
    public function totalNotReceived(Request $request)
    {
        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $show = cornerstone::all();
        $times = $now->toDateString();
        $designer = User::get()->where('role', 2);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;
        $showcornerstone = cornerstone::all();
        if ($request->cornerstone != null) {
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
        products.updated_at as "updated_at",
        Product.status as "status"
        '
                ))
                ->groupBy('products.id')
                ->where('status', 1)
                ->Where('product_cornerstone.cornerstones_id', $request->cornerstone)
                ->orWhere('title', 'like', "%{$keyword}%")
                ->paginate(100);

        } else {
            $report = Product::orderBy('updated_at', 'desc')
                ->Where('title', 'like', "%{$keyword}%")
                ->where('status', 1)
                ->paginate(10);
        }

        // foreach ($report as $rep) {
        //     foreach ($rep->cornerstones as $corner) {
        //         $name[] = $corner->name;
        //     }
        // }

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
        // dd($time[4]);
        // dd(count($report[0]->mocups));

        $totalDone = Product::orderBy('id', 'desc')->where('status', 5)->count();
        $totalPending = Product::orderBy('id', 'desc')->where('status', 3)->count();
        $totalNotReceived = Product::orderBy('id', 'desc')->where('status', 1)->count();
        $totalallidea = Product::orderBy('id', 'desc')->count();
        return view('admin.total.totalidea',
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
                'showcornerstones' => $showcornerstone,
            ]);
    }
    public function totalDone(Request $request)
    {
        Carbon::setLocale('vi');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $show = cornerstone::all();
        $times = $now->toDateString();
        $designer = User::get()->where('role', 2);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;
        $showcornerstone = cornerstone::all();
        if ($request->cornerstone != null) {
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
        products.updated_at as "updated_at",
        Product.status as "status"
        '
                ))
                ->groupBy('products.id')
                ->where('status', 5)
                ->Where('product_cornerstone.cornerstones_id', $request->cornerstone)
                ->orWhere('title', 'like', "%{$keyword}%")
                ->paginate(100);

        } else {
            $report = Product::orderBy('updated_at', 'desc')
                ->Where('title', 'like', "%{$keyword}%")
                ->where('status', 5)
                ->paginate(10);
        }

        // foreach ($report as $rep) {
        //     foreach ($rep->cornerstones as $corner) {
        //         $name[] = $corner->name;
        //     }
        // }

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
        // dd($time[4]);
        // dd(count($report[0]->mocups));

        $totalDone = Product::orderBy('id', 'desc')->where('status', 5)->count();
        $totalPending = Product::orderBy('id', 'desc')->where('status', 3)->count();
        $totalNotReceived = Product::orderBy('id', 'desc')->where('status', 1)->count();
        $totalallidea = Product::orderBy('id', 'desc')->count();
        return view('admin.total.totalidea',
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
                'showcornerstones' => $showcornerstone,
            ]);
    }
    public function EditShowajax($id)
    {
        $sizes = size::where('id_types', $id)->get();
        // dd($sizes);
        foreach ($sizes as $size) {
            echo "<option value='" . $size->id . "'>" . $size->name . "</option>";

        }

    }

}
