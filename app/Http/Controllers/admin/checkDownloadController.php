<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\checkDowload;
use App\Models\User;

class checkDownloadController extends Controller
{

    public function checkDownload()
    {
        $datas = checkDowload::orderBy('created_at', 'DESC')->paginate(100);
        return view('admin/checkDowload/index', [
            'datas' => $datas,
        ]);

    }

    public function checkdownloadClick($id)
    {
        $admin = auth()->user()->id;
        if ($admin != 1) {
            if ($id == 1) {
                $data = [
                    'User_id' => auth()->user()->id,
                    'statusRelative' => 'click vao 1 anh idea',
                ];

            } elseif ($id == 2) {
                $data = [
                    'User_id' => auth()->user()->id,
                    'statusRelative' => 'click vao 1 anh Mockup',
                ];

            } else {
                $data = [
                    'User_id' => auth()->user()->id,
                    'statusRelative' => 'click vao 1 anh PNG',
                ];

            }
            checkDowload::create($data);
        }
    }
}
