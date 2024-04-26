<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\cornerstone;
use App\Models\Product;
use App\Models\size;
use App\Models\type_product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    //
    public function home(Request $request)
    {
        // dd($request->type);
        Carbon::setLocale('vi');
        $designer = User::get()->where('role', 1);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;
        $showcornerstone = cornerstone::all();
        if ($request->type != null) {
            if ($keyword != "") {
                $report = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)
                    ->Where('status', '<>', "5")
                    ->Where('id_type', $request->type)
                    ->Where('title', 'like', "%{$keyword}%")
                    ->paginate(5);
                $report->appends(['keyword' => $keyword, 'type' => $request->type]);
            } else {
                $report = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)
                    ->Where('status', '<>', "5")
                    ->Where('id_type', $request->type)
                    ->paginate(7);
            }

        } else {
            if ($keyword != "") {
                $report = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)
                    ->Where('status', '<>', "5")
                    ->Where('title', 'like', "%{$keyword}%")
                    ->paginate(7);
                // $report->appends(['keyword' => $keyword]);
                $report->appends(['keyword' => $keyword, 'type' => $request->type]);
            } else {
                $report = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)
                    ->Where('status', '<>', "5")
                    ->paginate(7);
            }

        }

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
        // dd($report);
        // $showList = $report->cornerstones;

        // dd(count($report[0]->mocups));

        $totalDone = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 5)->count();
        $totalPending = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 3)->count();
        $totalNotReceived = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 1)->count();
        $totalallidea = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->count();
        return view('client.layout.home',
            ['designers' => $designer,
                'reports' => $report,
                'totalDone' => $totalDone,
                'totalPending' => $totalPending,
                'totalNotReceived' => $totalNotReceived,
                'type_products' => $type_product,
                'totalallidea' => $totalallidea,
                'times' => $time,
                'sizes' => $size,
                'showcornerstones' => $showcornerstone,
            ]);
    }
    public function allidea(Request $request)
    {
        Carbon::setLocale('vi');
        $designer = User::get()->where('role', 1);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;

        if ($request->type != null) {
            if ($keyword != "") {
                $report = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)
                    ->Where('id_type', $request->type)
                    ->Where('title', 'like', "%{$keyword}%")
                    ->orWhere('Sku', $keyword)

                    ->paginate(7);
                $report->appends(['keyword' => $keyword]);
            } else {
                $report = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)
                    ->Where('id_type', $request->type)
                    ->paginate(7);
            }

        } else {
            if ($keyword != "") {
                $report = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)
                    ->Where('title', 'like', "%{$keyword}%")
                    ->orWhere('Sku', "$keyword")

                    ->paginate(7);
                $report->appends(['keyword' => $keyword]);
            } else {
                $report = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)
                    ->paginate(7);
            }
            // dd($report);
        }
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
        // dd($report[0]->mocups);
        // dd(count($report[0]->mocups));
        $showcornerstone = cornerstone::all();
        $totalDone = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 5)->count();
        $totalPending = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 3)->count();
        $totalNotReceived = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 1)->count();
        $totalallidea = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->count();
        return view('client.layout.home',
            ['designers' => $designer,
                'reports' => $report,
                'totalDone' => $totalDone,
                'totalPending' => $totalPending,
                'totalallidea' => $totalallidea,
                'totalNotReceived' => $totalNotReceived,
                'type_products' => $type_product,
                'times' => $time,
                'sizes' => $size,
                'showcornerstones' => $showcornerstone,

            ]);
    }

    public function done(Request $request)
    {
        Carbon::setLocale('vi');
        $designer = User::get()->where('role', 1);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;
        $showcornerstone = cornerstone::all();
        $report = Product::orderBy('updated_at', 'desc')->Where('title', 'like', "%{$keyword}%")
            ->where('id_idea', Auth::user()->id)->where('status', 5)->paginate(5);
        if ($request->type != null) {
            $report = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)
                ->where('status', 5)
                ->Where('id_type', $request->type)
                ->paginate(7);
            $report->appends(['type' => $request->type]);
        } else {
            if ($keyword != "") {
                $report = Product::orderBy('updated_at', 'desc')->Where('title', 'like', "%{$keyword}%")
                    ->where('id_idea', Auth::user()->id)
                    ->where('status', 5)
                    ->paginate(7);
                $report->appends(['keyword' => $keyword]);
            } else {
                $report = Product::orderBy('updated_at', 'desc')
                    ->where('id_idea', Auth::user()->id)
                    ->where('status', 5)
                    ->paginate(7);
            }

        }
        if ($report->total() != 0) {
            foreach ($report as $billdd) {
                $dt[] = Carbon::create($billdd->updated_at);
            }

            foreach ($dt as $key) {
                $now = Carbon::now();
                $time[] = $key->diffForHumans($now);
            }
        } else {
            $time = '';
        }
        $designer = User::get()->where('role', 1);
        $totalDone = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 5)->count();
        $totalPending = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 3)->count();
        $totalNotReceived = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 1)->count();
        $totalallidea = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->count();
        return view('client.layout.home',
            ['designers' => $designer,
                'reports' => $report,
                'totalDone' => $totalDone,
                'totalallidea' => $totalallidea,
                'totalPending' => $totalPending,
                'totalNotReceived' => $totalNotReceived,
                'type_products' => $type_product,
                'sizes' => $size,
                'times' => $time,
                'showcornerstones' => $showcornerstone,

            ]);
    }

    public function Pending(Request $request)
    {
        $showcornerstone = cornerstone::all();
        $keyword = $request->keyword;
        $size = size::get();
        $type_product = type_product::get();
        $designer = User::get()->where('role', 1);
        $report = Product::orderBy('id', 'desc')->Where('title', 'like', "%{$keyword}%")
            ->where('id_idea', Auth::user()->id)->where('status', 3)->paginate(5);
        $totalPending = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 3)->count();
        return view('client.layout.home',
            ['designers' => $designer,
                'reports' => $report,
                'totalPending' => $totalPending,
                'type_products' => $type_product,
                'sizes' => $size,
                'showcornerstones' => $showcornerstone,

            ]);
    }
    public function NotReceived(Request $request)
    {
        $keyword = $request->keyword;
        $showcornerstone = cornerstone::all();
        $size = size::get();
        $type_product = type_product::get();
        $designer = User::get()->where('role', 1);
        $report = Product::orderBy('id', 'desc')->Where('title', 'like', "%{$keyword}%")
            ->where('id_idea', Auth::user()->id)->where('status', 1)->paginate(5);
        $totalNotReceived = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)->where('status', 1)->count();
        return view('client.layout.home',
            ['designers' => $designer,
                'reports' => $report,
                'totalNotReceived' => $totalNotReceived,
                'type_products' => $type_product,
                'sizes' => $size,
                'showcornerstones' => $showcornerstone,

            ]);
    }

    public function success($id)
    {
        Product::where('id', $id)->update(['status' => 5]);
        return redirect()->back();

    }
    public function approvalShow($id)
    {

        $ids = Product::find($id);
        return view('client.dasboa.approval', ['id' => $ids]);

    }
    public function approval(Request $request, $id)
    {
        $approval = $request->approval;
        $ids = Product::find($id);
        $description = $ids->description;
        $idr = $ids->id_idea;
        $name = User::find($idr)->name;
        Product::where('id', $id)->update(['description' => $description . "</br> <b style= 'color:black'> " . $name . "</b>:" . $approval, 'status' => 4]);
        return redirect()->back();

    }

    public function important($id)
    {
        Product::where('id', $id)->update(['action' => 2]);
        return redirect()->back();

    }
    public function showimage(Request $request)
    {
        dd($request->id);
        return redirect()->back();

    }
    public function EditShow($id)
    {
        $type_product = type_product::get();
        $designer = User::get()->where('role', 1);
        $show = Product::find($id);
        $size = size::get();

        return view('client.dasboa.edit',
            [
                'type_products' => $type_product,
                'designers' => $designer,
                'show' => $show,
                'sizes' => $size,
            ]);

    }
    public function comment(Request $request, $id)
    {
        $approval = $request->comment;
        $ids = Product::find($id);
        $description = $ids->description;
        $idr = $ids->id_idea;
        $name = User::find($idr)->name;
        Product::where('id', $id)->update(['description' => $description . "</br> <b style= 'color:black'> " . $name . "</b>:" . $approval]);
        return redirect()->back();

    }

    public function ajax($id)
    {
        $sizes = size::where('id_types', $id)->get();
        foreach ($sizes as $size) {
            echo "<option value='" . $size->id . "'>" . $size->name . "</option>";
        }

    }
    public function EditShowajax($id)
    {
        $sizes = size::where('id_types', $id)->get();
        // dd($sizes);
        foreach ($sizes as $size) {
            echo "<option value='" . $size->id . "'>" . $size->name . "</option>";

        }

    }

    public function dasboa()
    {
        if (Auth::check()) {
            return view('client.idea.index');
        } else {
            return redirect()->route('login');
        }
    }

    public function addSku(Request $request, $id)
    {
        if ($request->Sku) {
            Product::where('id', $id)->update(['Sku' => $request->Sku]);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
