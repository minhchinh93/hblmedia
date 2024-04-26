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

class UserController extends Controller
{
    //

    public function showUser(Request $request)
    {
        $keyword = $request->keyword;
        $shows = User::where('name', 'like', "%{$keyword}%")->paginate(40);
        if ($shows->total() > 0) {
            $total = $shows->total();
            $count = User::withTrashed()->count();
            $trackuser = User::onlyTrashed()->count();
            $activeruser = User::where('deleted_at', null)->count();
            return view('admin.users.index', ['shows' => $shows,
                'index' => $count,
                'trackuser' => $trackuser,
                'activeruser' => $activeruser])->with('success', "tim thay '.$total.' ban ghi");
        } else {
            return redirect()->back()->with('erros', 'khong tim thay ban ghi');
        }
    }
    public function findUser(Request $request)
    {
        $keyword = $request->keyword;
        $shows = User::where('role', $request->role)->where('name', 'like', "%{$keyword}%")->paginate(40);
        if ($shows->total() > 0) {
            $total = $shows->total();
            $count = User::withTrashed()->count();
            $trackuser = User::onlyTrashed()->count();
            $activeruser = User::where('deleted_at', null)->count();
            return view('admin.users.index', ['shows' => $shows,
                'index' => $count,
                'trackuser' => $trackuser,
                'activeruser' => $activeruser])->with('success', "tim thay '.$total.' ban ghi");
        } else {
            return redirect()->back()->with('erros', 'khong tim thay ban ghi');
        }
    }

    public function addList(Request $request)
    {
        return view('admin.users.add');
    }
    public function postList(Request $request)
    {
        User::create($request->only('name', 'email', 'password', 'role'));
        return redirect()->route('showUser')->with('success', 'bạn da them danh muc thanh cong');
    }
    public function editList($id)
    {
        $shows = User::find($id);
        return view('admin.users.edit', ['shows' => $shows]);
    }
    public function updatesuser(Request $request, $id)
    {

        $data = [
            'name' => $request->name,
            'role' => $request->role,
        ];
        User::where('id', $id)->update($data);
        return redirect()->route('showUser')->with('success', 'bạn da them danh muc thanh cong');
    }

    public function delete($id)
    {
        if (User::find($id) != null) {
            User::find($id)->delete();
            return redirect()->route('showUser')->with('success', 'ban da xoa thanh cong');
        }
        return redirect()->route('showUser')->with('erros', 'user đã xóa');
    }
    public function trackuser()
    {
        $shows = User::onlyTrashed()->paginate(10);
        $count = User::withTrashed()->count();
        $trackuser = User::onlyTrashed()->count();
        $activeruser = User::where('deleted_at', null)->count();
        return view('admin.users.index', ['shows' => $shows, 'index' => $count, 'trackuser' => $trackuser, 'activeruser' => $activeruser]);
    }
    public function activeruser()
    {
        $shows = User::where('deleted_at', null)->paginate(40);
        $count = User::withTrashed()->count();
        $trackuser = User::onlyTrashed()->count();
        $activeruser = User::where('deleted_at', null)->count();
        return view('admin.users.index', ['shows' => $shows, 'index' => $count, 'trackuser' => $trackuser, 'activeruser' => $activeruser]);

    }
    public function restoreUser($id)
    {
        User::withTrashed()->find($id)->restore();
        return redirect()->route('showUser')->with('success', 'ban da khoi phuc thanh cong');
    }
    public function action(Request $request)
    {
        $checklis = $request->checkbox;
        $action = $request->action;
        if ($checklis) {
            foreach ($checklis as $id) {
                if ($id == 1) {
                    return redirect()->route('showUser')->with('erros', 'ban khong the xoa chinh minh');
                }
            }
            if ($action) {
                if ($action == 'disabled') {
                    User::destroy($checklis);
                    return redirect()->route('showUser')->with('success', 'ban da xoa thanh cong');
                } elseif ($action == 'restore') {
                    User::withTrashed()->whereIn('id', $checklis)->restore();
                    return redirect()->route('showUser')->with('success', 'ban da khoi phuc thanh cong');
                } elseif ($action == 'delete') {
                    User::withTrashed()->whereIn('id', $checklis)->forceDelete();
                    return redirect()->route('showUser')->with('success', 'ban da xoa vinh vien');
                } else {
                    return redirect()->route('showUser')->with('erros', 'ban chua chon tac vu ');
                }

            }
        }

    }
    public function detailUser($id)
    {
        // dd($id);
        $report = Product::orderBy('updated_at', 'desc')->where('User_id', $id)->paginate(15);

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
        return view('admin.users.detailUser',
            ['reports' => $report,
                'totalPending' => $totalPending,
                'totalDone' => $totalDone,
                'totalNotSeen' => $totalNotSeen,
                'totalprioritize' => $totalNotReceived,
                'totalPendingDS' => $totalPendingDS,
                'name' => $name,
                'showcornerstones' => $showcornerstone,
                'id' => $id,
            ]);
    }
    public function detailUserdone($id)
    {
        // dd($id);
        $report = Product::orderBy('updated_at', 'desc')->where('User_id', $id)->where('status', 5)->paginate(15);
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
        return view('admin.users.detailUser',
            ['reports' => $report,
                'totalPending' => $totalPending,
                'totalDone' => $totalDone,
                'totalNotSeen' => $totalNotSeen,
                'totalprioritize' => $totalNotReceived,
                'totalPendingDS' => $totalPendingDS,
                'name' => $name,
                'showcornerstones' => $showcornerstone,
                'id' => $id,
            ]);
    }
    public function detailUserPending($id)
    {

        $report = Product::orderBy('updated_at', 'desc')->where('User_id', $id)->where('status', 3)->paginate(15);
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
        return view('admin.users.detailUser',
            ['reports' => $report,
                'totalPending' => $totalPending,
                'totalDone' => $totalDone,
                'totalNotSeen' => $totalNotSeen,
                'totalprioritize' => $totalNotReceived,
                'totalPendingDS' => $totalPendingDS,
                'name' => $name,
                'showcornerstones' => $showcornerstone,
                'id' => $id,
            ]);
    }
    public function detailUserIdea(Request $request, $id)
    {

        Carbon::setLocale('vi');
        $designer = User::get()->where('role', 1);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;
        // dd($size[1]);
        $report = Product::orderBy('id', 'desc')->where('id_idea', $id)
            ->Where('description', 'like', "%{$keyword}%")
        // ->orWhere('updated_at', 'like', "%{$keyword}%")
            ->paginate(5);
        $report->appends(['keyword' => $keyword]);

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
    public function detailUserIdeaDone(Request $request, $id)
    {

        Carbon::setLocale('vi');
        $designer = User::get()->where('role', 1);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;
        // dd($size[1]);
        $report = Product::orderBy('id', 'desc')->where('id_idea', $id)
            ->Where('description', 'like', "%{$keyword}%")
            ->where('status', 5)
        // ->orWhere('updated_at', 'like', "%{$keyword}%")
            ->paginate(5);
        $report->appends(['keyword' => $keyword]);

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
    public function detailUserIdeaPending(Request $request, $id)
    {

        Carbon::setLocale('vi');
        $designer = User::get()->where('role', 1);
        $type_product = type_product::get();
        $size = size::get();
        $keyword = $request->keyword;
        // dd($size[1]);
        $report = Product::orderBy('id', 'desc')->where('id_idea', $id)
            ->Where('description', 'like', "%{$keyword}%")
        // ->orWhere('updated_at', 'like', "%{$keyword}%")
            ->where('status', 3)
            ->paginate(15);
        $report->appends(['keyword' => $keyword]);

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
