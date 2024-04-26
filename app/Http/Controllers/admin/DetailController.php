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

class DetailController extends Controller
{
    //
    public function DetailDesigner($id)
    {
        // dd($id);
        $report = Product::orderBy('updated_at', 'desc')->where('User_id', $id)->paginate(5);
        $totalPending = Product::orderBy('updated_at', 'desc')->where('User_id', $id)->where('status', 4)->count();
        $totalDone = Product::orderBy('updated_at', 'desc')->where('User_id', $id)->where('status', 5)->count();
        $totalNotSeen = Product::orderBy('updated_at', 'desc')->where('User_id', $id)->where('status', 1)->count();
        $totalNotReceived = Product::orderBy('updated_at', 'desc')->where('User_id', $id)->where('action', 2)->where('status', '<>', 5)->count();
        $totalPendingDS = Product::orderBy('updated_at', 'desc')->where('User_id', $id)->where('status', 3)->count();
        $showcornerstone = cornerstone::all();
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
        // dd($name[1][0]->name);
        return view('admin.deatailMember.designer',
            ['reports' => $report,
                'totalPending' => $totalPending,
                'totalDone' => $totalDone,
                'totalNotSeen' => $totalNotSeen,
                'totalprioritize' => $totalNotReceived,
                'totalPendingDS' => $totalPendingDS,
                'name' => $name,
                'showcornerstones' => $showcornerstone,
            ]);
    }

    public function DetailIdea(Request $request, $id)
    {

        Carbon::setLocale('vi');
        $designer = User::get()->where('role', 1);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;
        // dd($size[1]);

        $report = Product::orderBy('id', 'desc')->where('id_idea', $id)
        // ->Where('Sku', 'like', "%{$keyword}%")
        // ->Where('description', 'like', "%{$keyword}%")
        // ->orWhere('updated_at', 'like', "%{$keyword}%")
            ->paginate(15);
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
        $totalDone = Product::orderBy('id', 'desc')->where('id_idea', $id)->where('status', 5)->count();
        $totalPending = Product::orderBy('id', 'desc')->where('id_idea', $id)->where('status', 3)->count();
        $totalNotReceived = Product::orderBy('id', 'desc')->where('id_idea', $id)->where('status', 1)->count();
        $totalallidea = Product::orderBy('id', 'desc')->where('id_idea', $id)->count();
        return view('admin.deatailMember.idea',
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
                'id' => $id,
            ]);
    }

}
