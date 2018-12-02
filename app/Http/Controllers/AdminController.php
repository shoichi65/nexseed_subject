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
        $users = User::all();
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
        // dd($id);
        $feeds_count = Feed::where('user_id', $id)->count();
        $feeds = Feed::where('user_id', $id)->withTrashed()->get();
        // dd($feeds->toSql());
        // $users = User::all();
        // return view('admin');
        return view('admin.view', compact('feeds_count', 'feeds'));
    }

    /**
     * destory.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxdestory(Request $request)
    {
        // dd($request->all());
        // likesテーブルを検索、なければ登録
        if ($request->btn == "valid") {
            $feed = Feed::find($request->feed_id)->delete();
        }
        // deleted_at更新
        elseif ($request->btn == "invalid") {
            $feed = Feed::where('id', $request->feed_id)->restore();
        }
        // エラー
        else {

        }
        
        // return
        $result = '';
        if ($request->btn == "valid") {
            // $result .= '<input type="hidden" name="btn" value="invalid">';
            // $result .= '<button class="btn btn-sm btn-danger">Invalid</button>';
            $result .= '<a href="/admin/feeds/'.$request->feed_id.'" class="btn btn-sm btn-danger feed-delete" data-btn="invalid" data-feed_id="'.$request->feed_id.'">Invalid</a>';
            return $result;
        }
        elseif ($request->btn == "invalid") {
            // $result .= '<input type="hidden" name="btn" value="valid">';
            // $result .= '<button class="btn btn-sm btn-success">Valid</button>';
            $result .= '<a href="/admin/feeds/'.$request->feed_id.'" class="btn btn-sm btn-success feed-delete" data-btn="valid" data-feed_id="'.$request->feed_id.'">Valid</a>';
            return $result;
        }
        else {

        }
    }
}
