<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {/*
        $request->validate([
            'project_id' => 'require|integer|exists:project,id',
            'name' => 'required|string|max:250',
            'email' => 'required|string|max:150',
            'message' => 'required|string',
        ],
        [
            'name.rerquired' => 'Il nome è obbligatorio',
            'name.string' => 'Il nome deve essere una stringa',
            'name.max' => 'Il nome non può avere più di 250 caratteri',
            'email.rerquired' => 'La email è obbligatorio',
            'email.string' => 'La email deve essere una stringa',
            'email.max' => 'La email non può avere più di 150 caratteri',
            'message.rerquired' => 'Il commento è obbligatorio',
            'message.string' => 'Il commento deve essere una stringa',

        ]);*/

        $comment = new Comment();
        $comment->fill($request->all());
        $comment->save();

        return response()->json([
            'success' => 'true'
        ]);
    }

    /**
     * Display the specified resource filtered by type_id).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCommentsByProject($project_id)
    {
        $comments = Comment::where('project_id', $project_id)
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);

        return response()->json($comments);
    }
}
