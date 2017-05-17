<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentsCreateRequest;
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
            'ok' => true,
            'view' => view('articles.partials.comments', compact('article'))->render()
        ];
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
        //
    }

    public function destroy()
    {

    }
}
