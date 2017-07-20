<?php

namespace App\Http\Controllers;

use App\Criteria\Articles\PublishedCriteria;
use App\Criteria\Articles\SortByCategoryCriteria;
use App\Criteria\FilterCriteria;
use App\Http\Requests\CategoriesUpdateRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    /**
     * @var CategoryRepository
     */
    protected $repository;
    /**
     * @author MY
     * @var ArticleRepository
     */
    private $articles;

    /**
     * @author MY
     * CategoriesController constructor.
     * @param CategoryRepository $repository
     * @param ArticleRepository $articles
     */
    public function __construct(CategoryRepository $repository, ArticleRepository $articles)
    {
        $this->repository = $repository;
        $this->articles = $articles;
        $this->middleware('auth')->only(['create', 'update']);
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
        $this->articles->pushCriteria(new SortByCategoryCriteria($id));
        $articles = $this->articles->paginate(10);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);

        return view('categories.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CategoriesUpdateRequest $request
     * @param  string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoriesUpdateRequest $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$id.'|max:55'
        ]);
        $this->repository->update(['name' => $request->name], $id);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Category deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Category deleted.');
    }
}
