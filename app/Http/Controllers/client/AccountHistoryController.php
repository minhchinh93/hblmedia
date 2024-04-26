<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountHistoryController extends Controller
{
    //
    public function index()
    {
        $table = User::join('bills', 'bills.id_User', '=', 'users.id')
            ->join('bill_detaills', 'bill_detaills.id_bill', '=', 'bills.id')
            ->join('type_products', 'bill_detaills.id_type_products', '=', 'type_products.id')
            ->select(DB::raw('
            type_products.name as "name",
            type_products.id as "id",
            bill_detaills.quantity as "qty",
            bill_detaills.price as "price",
            bills.total as "total",
            bills.date_order as "time"

        '))
            ->where('users.id', Auth::user()->id)
            ->get();

        return view('client.AccountHistory.index', ['tables' => $table]);
    }
    public function detailAccountHistory($id)
    {
        $chitiet = User::join('purchaseds', 'purchaseds.id_User', '=', 'users.id')
            ->join('products', 'products.id', '=', 'purchaseds.id_product')
            ->select(DB::raw('
        products.IdFB as "IdFB",
        products.password as "password",
        products.email as "email",
        products.passmail as "passmail",
        products.fa as "fa",
        products.status as "status",
        products.backup as "backup",
        products.change as "change"

    '))
            ->where('users.id', Auth::user()->id)
            ->where('products.id_type', $id)
            ->whereRaw('products.status IS NOT NULL')
            ->get();

        return view('client.AccountHistory.Detail', ['tables' => $chitiet]);

    }
}
