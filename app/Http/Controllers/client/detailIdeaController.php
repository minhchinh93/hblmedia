<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\cornerstone;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class detailIdeaController extends Controller
{
    //
    public function showdetail($key1, $key2)
    {
        $report = Product::orderBy('id', 'desc')->where('id_idea', Auth::user()->id)
            ->whereBetween('updated_at', [$key1 . ' 00:00:00', $key2 . ' 23:59:59'])
            ->paginate(5);
        $showcornerstone = cornerstone::all();
        return view('client.detail.indexIdea',
            [
                'reports' => $report,
                'showcornerstones' => $showcornerstone,
            ]);
    }
}
