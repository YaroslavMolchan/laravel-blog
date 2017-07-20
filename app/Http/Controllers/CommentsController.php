<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsCreateRequest;
use App\Repositories\ArticlesCommentRepository;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param CommentsCreateRequest $form
     * @return array
     */
    public function store(CommentsCreateRequest $form)
    {
        $article = $form->persist();

        return [
            'ok'   => true,
            'view' => view('articles.partials.comments', compact('article'))->render()
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(ArticlesCommentRepository $comments, $id)
    {
        if (!\Auth::check()) {
            throw new \Exception('Not allowed');
        }

        $result = $comments->delete($id);

        return [
            'ok' => $result
        ];
    }
}
