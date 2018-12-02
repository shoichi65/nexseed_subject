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


    // ajaxLike
    public function ajaxLike(Request $request) {
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

        // return
        $result = '';
        if ($request->btn == "like") {
            // dd('like');
            // return 'hogehoge';
            $result .= '<input type="hidden" name="btn" value="unlike">';
            $result .= '<button class="btn btn-default">';
            $result .= '<i class="fa fa-star star"></i>';
            $result .= 'Cancel...(<span id="Likes_Count">'.$likes_count.'</span>)';
            $result .= '</button>';
            return $result;
        }
        elseif ($request->btn == "unlike") {
            // dd('unlike');
            $result .= '<input type="hidden" name="btn" value="like">';
            $result .= '<button class="btn btn-primary">';
            $result .= '<i class="fa fa-star solid"></i>';
            $result .= 'Good!(<span id="Likes_Count">'.$likes_count.'</span>)';
            $result .= '</button>';
            return $result;
        }
        else {

        }
        // return redirect("/feeds/{$request->feed_id}");
    }
}
