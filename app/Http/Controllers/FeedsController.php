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
        $this->middleware('auth')->except(['index', 'view']);
    }

    // index
    public function index() {
        $feeds = Feed::latest()->get();
        // dd(Feed::latest()->toSql());
        return view('feeds.index', compact('feeds'));
    }

    // view
    public function view($id) {
        $feed = Feed::findOrFail($id);
        $like_count = Like::where([
            'user_id' => \Auth::user()->id,
            'feed_id' => $id,
        ])
        ->count();
        $comments = Comment::where([
            'feed_id' => $id,
        ])
        ->latest()
        ->get();
        // dd($comments);
        return view('feeds.view', compact('feed','like_count', 'comments'));
    }

    // create
    public function create() {
        return view('feeds.create');
    }

    // store
    public function store(Request $request) {
        // dd($request->all());
        // dd($request->feed);
        $validator = Validator::make($request->all(), [
            'feed' => 'required',
        ]);

        // バリデーションチェックを行う
        if ($validator->fails()) {
            return redirect('/feeds/create')->withErrors($validator);
        }

        Feed::create([
            'user_id' => \Auth::user()->id,
            'feed' => $request->feed,
        ]);

        \Session::flash('flash_message', 'Created!');

        return redirect('/feeds/');
    }

    // edit
    public function edit($id) {
        // dd($id);
        $feed = Feed::findOrFail($id);
        return view('feeds.edit', compact('feed'));
    }

    // update
    public function update(Request $request, $id) {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'feed' => 'required',
        ]);

        // バリデーションチェックを行う
        if ($validator->fails()) {
            return redirect("/feeds/{$id}/edit")->withErrors($validator);
        }
        
        $feed = Feed::findOrFail($id);
        $feed->update([
            'feed' => $request->feed,
        ]);

        \Session::flash('flash_message', 'Updated!');
        
        return redirect("/feeds/{$id}");
    }

    // destory
    public function destory(Request $request, $id) {
        // dd($request->all());
        Feed::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted!');

        return redirect('/feeds/');
    }
}
