<?php

namespace App\Http\Controllers\excel;

use App\Exports\ExportAmz;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class exportAmzController extends Controller
{
    //

    public function exportsamz($id)
    {
        return Excel::download(new ExportAmz($id), "hblmedia.xlsx");
    }
}
