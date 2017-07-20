<?php

namespace App\Http\Controllers;

use App\Criteria\Articles\PublishedCriteria;
use App\Criteria\Articles\SortByTagCriteria;
use App\Repositories\ArticleRepository;

class TagsController extends Controller
{

    /**
     * @var ArticleRepository
     */
    protected $articles;

    public function __construct(ArticleRepository $articles)
    {
        $this->articles = $articles;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->articles->pushCriteria(PublishedCriteria::class);
        $this->articles->pushCriteria(new SortByTagCriteria($id));
        $articles = $this->articles->paginate(10);

        return view('articles.index', compact('articles'));
    }
}
