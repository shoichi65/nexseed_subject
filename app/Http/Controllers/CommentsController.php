<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Comment;

class CommentsController extends Controller
{
    // store
    public function store (Request $request) {

        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);

        // バリデーションチェックを行う
        if ($validator->fails()) {
            return redirect("/feeds/{$request->feed_id}")->withErrors($validator);
        }
        // dd($request->all());
        $comment = Comment::create([
            'user_id' => \Auth::user()->id,
            'feed_id' => $request->feed_id,
            'comment' => $request->comment,
        ]);

        return redirect("/feeds/{$request->feed_id}")->withErrors($validator);
    }


    // ajaxstore
    public function ajaxstore (Request $request) {

        $validator = Validator::make($request->all(), [
            'comment' => 'required',
        ]);

        // バリデーションチェックを行う
        if ($validator->fails()) {
            // return redirect("/feeds/{$request->feed_id}")->withErrors($validator);
            return; 
        }
        // dd($request->all());
        $comment = Comment::create([
            'user_id' => \Auth::user()->id,
            'feed_id' => $request->feed_id,
            'comment' => $request->comment,
        ]);
        // dd($comment);

        $result = '';
        $result .= '<blockquote id="comment-'.$comment->id.'">';
        $result .= '<p class="text-muted">';
        $result .= '<td>'.$comment->comment.'</td>';
        $result .= '</p>';
        $result .= '<small>';
        $result .= $comment->created_at;
        $result .= '<cite class="mt-5">'.$comment->user['name'].'</cite>';
        $result .= '</small>';
        $result .= '<a href="/comments/'.$comment->id.'" data-feed_id="'.$comment->feed['id'].'" data-comment_id="'.$comment->id.'" class="comment-delete">Delete</a>';
        $result .= '</blockquote>';

        return $result;
        // return redirect("/feeds/{$request->feed_id}")->withErrors($validator);
    }

    // destory
    public function destory(Request $request, $id) {
        // dd($request->all());
        Comment::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted!');

        return redirect("/feeds/{$request->feed_id}");
    }

    // ajaxdestory
    public function ajaxdestory(Request $request, $id) {
        // dd($request->all());
        Comment::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted!');

        return;
    }
}
