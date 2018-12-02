<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Feed;
use App\Like;
use App\Comment;

class FeedsController extends Controller
{
    // ログインしていないときのリダイレクト
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    // index
    public function index() {
        // feedを最新順に取得
        $feeds = Feed::latest()->paginate(10);

        return view('feeds.index', compact('feeds'));
    }

    // view
    public function view($id) {
        // feedを取得
        $feed = Feed::findOrFail($id);
        // like数を取得
        $like_count = Like::where([
            'user_id' => \Auth::user()->id,
            'feed_id' => $id,
        ])
        ->count();
        // commentを最新順に取得
        $comments = Comment::where([
            'feed_id' => $id,
        ])
        ->latest()
        ->paginate(10);
        
        return view('feeds.view', compact('feed','like_count', 'comments'));
    }

    // create
    public function create() {
        return view('feeds.create');
    }

    // store
    public function store(Request $request) {
        // feedのバリデーション
        $validator = Validator::make($request->all(), [
            'feed' => 'required',
        ]);

        // バリデーションチェックを行う
        if ($validator->fails()) {
            return redirect('/feeds/create')->withErrors($validator);
        }

        // feedを作成
        Feed::create([
            'user_id' => \Auth::user()->id,
            'feed' => $request->feed,
        ]);

        // フラッシュメッセージ
        \Session::flash('flash_message', 'Created!');

        return redirect('/feeds/');
    }

    // edit
    public function edit($id) {
        // feedを取得
        $feed = Feed::findOrFail($id);
        return view('feeds.edit', compact('feed'));
    }

    // update
    public function update(Request $request, $id) {
        // feedのバリデーション
        $validator = Validator::make($request->all(), [
            'feed' => 'required',
        ]);

        // バリデーションチェックを行う
        if ($validator->fails()) {
            return redirect("/feeds/{$id}/edit")->withErrors($validator);
        }
        
        // feedの更新
        $feed = Feed::findOrFail($id);
        $feed->update([
            'feed' => $request->feed,
        ]);

        // フラッシュメッセージ
        \Session::flash('flash_message', 'Updated!');
        
        return redirect("/feeds/{$id}");
    }

    // destory
    public function destory(Request $request, $id) {
        // feedの削除
        Feed::findOrFail($id)->delete();

        // フラッシュメッセージ
        \Session::flash('flash_message', 'Deleted!');

        return redirect('/feeds/');
    }
}
