<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Feed;

class LikesController extends Controller
{
    // ログインしていないときのリダイレクト
    public function __construct()
    {
        $this->middleware('auth')->except([]);
    }

    // like
    public function like(Request $request) {
        // dd($request->all());
        // likesテーブルを検索、なければ登録
        if ($request->btn == "like") {
            $like = Like::firstOrCreate([
                'user_id' => \Auth::user()->id,
                'feed_id' => $request->feed_id,
            ]);
            // ->withTrashed()
            // ->restore();
        }
        // deleted_at更新
        elseif ($request->btn == "unlike") {
            $like = Like::where([
                'user_id' => \Auth::user()->id,
                'feed_id' => $request->feed_id,
            ])
            ->delete();
        }
        // エラー
        else {

        }
        
        $likes_count = Like::where([
            'feed_id' => $request->feed_id,
        ])->count();

        $feed = Feed::findOrFail($request->feed_id);
        $feed->update([
            'likes_count' => $likes_count,
        ]);

        return redirect("/feeds/{$request->feed_id}");
    }
}
