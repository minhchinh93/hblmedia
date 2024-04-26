<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class docController extends Controller
{
    //

    public function showDoc(Request $request)
    {
        $report = Document::join('user_doccument', 'documents.id', '=', 'user_doccument.document_id')
            ->select(DB::raw('
COUNT(user_doccument.User_id),
documents.id as "id",
documents.title as "title",
documents.description as "description",
documents.file as "file",
documents.video as "video",
documents.action as "action",
documents.status as "status"
'
            ))
            ->groupBy('documents.id')
            ->Where('user_doccument.User_id', Auth::id())
        // ->Where('product_cornerstone.cornerstones_id', $request->cornerstone)
        // ->Where('title', 'like', "%{$keyword}%")
            ->paginate(5);
        // $show = Document::all();
        $user = User::all();
        return view('client.document.index', [
            'shows' => $report,
            'user' => $user,
        ]);
    }
    public function detailDoc($id)
    {

        $show = Document::find($id);

        return view('client.document.detail', ['show' => $show]);

    }
    public function deleteDoc($id)
    {
        $products = Document::where('id', $id)->get();
        foreach ($products as $product) {
            $product->user()->detach();
        }
        Document::find($id)->delete();
        return redirect()->route('showDoc');

    }
    public function editDoc($id)
    {

        $show = Document::find($id);
        return view('client.document.documentAdd');

    }
    public function accset($id)
    {

        $show = Document::find($id)->update(['action' => 2]);
        return redirect()->route('showDoc');

    }
    public function addlDoc()
    {
        return view('client.document.documentAdd');
    }
    public function storeAdd(Request $request)
    {
        if ($request->file) {
            $file = $request->file('file')->store('images');
        } else {
            $file = null;
        }
        if ($request->video) {
            $video = $request->file('video')->store('images');
        } else {
            $video = null;
        }
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'file' => $file,
            'video' => $video,
        ];
        $a = Document::create($data);
        $a->user()->sync([1, 49, Auth::id()]);
        return redirect()->route('showDoc');

    }
    public function documentAddUser(Request $request, $id)
    {
        $document = Document::find($id);
        $document->user()->attach($request->doccument);
        return redirect()->route('showDoc');
    }
}
