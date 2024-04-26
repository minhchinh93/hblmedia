<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\taskJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class craterJobController extends Controller
{
    //
    public function jobPublic(Request $request)
    {
        // dd($request->all());
        $data = [
            'User_id' => Auth::user()->id,
            'Conten' => $request->content,
            'action' => $request->option,
            'private' => 1,
            'note' => $request->note,
        ];
        taskJob::create($data);
        return redirect()->route('AadminHome');
    }
    public function jobPrivate(Request $request)
    {
        $data = [
            'User_id' => $request->User_id,
            'Conten' => $request->content,
            'action' => $request->option,
            'private' => 2,
            'note' => $request->note,
        ];
        taskJob::create($data);
        return redirect()->route('AadminHome');
    }
    public function deletejob($id)
    {
        if (taskJob::find($id) != null) {
            taskJob::find($id)->delete();
            return redirect()->route('AadminHome')->with('success', 'ban da xoa thanh cong');
        }
        return redirect()->route('AadminHome')->with('erros', 'job đã xóa');
    }
    public function updateJob($id)
    {
      
        if (taskJob::find($id) != null) {
            taskJob::find($id)->update(['status'=>2]);
            return redirect()->route('AadminHome')->with('success', 'ban da xoa thanh cong');
        }
        return redirect()->route('AadminHome')->with('erros', 'job đã xóa');
    }

}
