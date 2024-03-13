<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tuition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminTuitionCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = Comment::with(['tuition','user'])->orderby('id','DESC')->get();

        if($request->tuition_id && $request->tuition_id != null){
            $comments = $comments->where('tuition_id', $request->tuition_id);
        }

        return view('backend.comments.index', compact('comments'));
    }

    public function status(Request $request)
    {
        $comment = Comment::findOrFail($request->comment_id);

        if($comment->status ==0){
            $status = 1;
        }else{
            $status = 0;
        }
        $comment = Comment::findOrFail($comment->id);
        $comment->status = $status;
        $comment->save();
        return redirect()->route('tuition_comment.index')
            ->with('success','Comment Status changes successfully.');

    }

    public function verified(Request $request)
    {
        $comment = Comment::findOrFail($request->comment_id);

        if($comment->verified == 0){
            $verified = 1;
        }else{
            $verified = 0;
        }
        $comment = Comment::findOrFail($comment->id);
        $comment->verified = $verified;
        $comment->save();
        return redirect()->route('tuition_comment.index')
            ->with('success','Comment Status changes successfully.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tuition = null;
        $tuitions = null;

        if($request->tuition_id){
            $tuition = Tuition::findOrFail($request->tuition_id);
        }else{
            $tuitions = Tuition::select(['job_id','id'])->get();
        }

        $users = User::get();

        return view('backend.comments.create', compact(['users','tuition', 'tuitions']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'user_id' => ['required',Rule::exists('users','id')],
            'tuition_id' => ['required', Rule::exists('tuitions','id')],
            'status' => ['required', Rule::in('1','0')],
            'verified' => ['required', Rule::in('1','0')],
            'anonymous' => ['required', Rule::in('1','0')],
            'body' => ['required'],
        ]);

        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->tuition_id = $request->tuition_id;
        $comment->status = $request->status;
        $comment->verified = $request->verified;
        $comment->anonymous = $request->anonymous;
        $comment->body = $request->body;
        $comment->save();

        return back()->withSuccess('Comment Attached to the tuition');
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
        $comment = Comment::findOrFail($id);
        $tuitions = Tuition::select(['job_id','id'])->get();
        $users = User::get();

        return view('backend.comments.edit', compact(['users','comment', 'tuitions']));
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
        $this->validate($request,[
            'user_id' => ['required',Rule::exists('users','id')],
            'comment_id' => ['required', Rule::exists('comments','id')],
            'tuition_id' => ['required', Rule::exists('tuitions','id')],
            'status' => ['required', Rule::in('1','0')],
            'verified' => ['required', Rule::in('1','0')],
            'anonymous' => ['required', Rule::in('1','0')],
            'body' => ['required'],
        ]);

        $comment = Comment::findOrFail($request->comment_id);
        $comment->user_id = $request->user_id;
        $comment->tuition_id = $request->tuition_id;
        $comment->status = $request->status;
        $comment->verified = $request->verified;
        $comment->anonymous = $request->anonymous;
        $comment->body = $request->body;
        $comment->save();

        return back()->withSuccess('Comment Updated to the tuition');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment  = Comment::findOrFail($id);
        $comment->delete();
        return back()->withSuccess('Comment Deleted');
    }
}
