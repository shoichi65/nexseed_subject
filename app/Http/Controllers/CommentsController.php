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
        Comment::create([
            'user_id' => \Auth::user()->id,
            'feed_id' => $request->feed_id,
            'comment' => $request->comment,
        ]);

        return redirect("/feeds/{$request->feed_id}")->withErrors($validator);
    }

    // destory
    public function destory(Request $request, $id) {
        // dd($request->all());
        Comment::findOrFail($id)->delete();

        \Session::flash('flash_message', 'Deleted!');

        return redirect("/feeds/{$request->feed_id}");
    }
}
