<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;

class RechargeHistoryController extends Controller
{
    //
    public function RechargeHistory()
    {
        return view('client.RechargeHistory.index');
    }
}
