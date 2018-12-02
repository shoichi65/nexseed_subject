<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Feed;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // user全件取得
        $users = User::paginate(10);
        // return view('admin');
        return view('admin.index', compact('users'));
    }

    /**
     * view.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        // feed数を取得
        $feeds_count = Feed::where('user_id', $id)->count();
        // feedを取得(deleteしたものも含む)
        $feeds = Feed::where('user_id', $id)->withTrashed()->paginate(10);

        return view('admin.view', compact('feeds_count', 'feeds'));
    }

    /**
     * destory.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxdestory(Request $request)
    {
        // feedを論理削除
        if ($request->btn == "valid") {
            $feed = Feed::find($request->feed_id)->delete();
        }
        // feedを未削除に戻す
        elseif ($request->btn == "invalid") {
            $feed = Feed::where('id', $request->feed_id)->restore();
        }
        // エラー
        else {

        }
        
        // return
        $result = '';
        if ($request->btn == "valid") {
            $result .= '<a href="/admin/feeds/'.$request->feed_id.'" class="btn btn-sm btn-danger feed-delete" data-btn="invalid" data-feed_id="'.$request->feed_id.'">Invalid</a>';
            return $result;
        }
        elseif ($request->btn == "invalid") {
            $result .= '<a href="/admin/feeds/'.$request->feed_id.'" class="btn btn-sm btn-success feed-delete" data-btn="valid" data-feed_id="'.$request->feed_id.'">Valid</a>';
            return $result;
        }
        else {

        }
    }
}
