<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PostCommentRequest;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = collect();
        $comments = Comment::all();
        $replies = CommentReply::all();

        foreach ($comments as $comment) {
            $collection->push($comment);
        }

        foreach ($replies as $reply) {
            $collection->push($reply);
        }
//        $comments = $comments->merge($replies)->sortBy('created_at')->reverse();
        $comments = $collection->sortBy('created_at')->reverse();

//        return $collection;
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCommentRequest $request)
    {
        if(Auth::check()) {
            $user = Auth::user();


            $data = [
                'post_id' => $request->post_id,
                'user_id' => $user->id,
                'email' => $user->email,
                'body' => $request->body,
            ];
            Comment::create($data);
            $request->session()->flash('comment_message', 'Your message has been submited and is waiting moderation');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->is_reply) {
            CommentReply::findOrFail($id)->update($request->all());
        } else {
            Comment::findOrFail($id)->update($request->all());
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if($request->is_reply) {
            CommentReply::findOrFail($id)->delete();
        } else {
            Comment::findOrFail($id)->delete();
        }
        return redirect()->back();
    }
}
