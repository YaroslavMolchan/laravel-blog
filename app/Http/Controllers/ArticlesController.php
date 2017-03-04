<?php

namespace App\Http\Controllers;

use App\Criteria\FilterCriteria;
use App\Criteria\SearchCriteria;
use App\Http\Requests\ArticlesCreateUpdateRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;


class ArticlesController extends Controller
{

    /**
     * @var ArticleRepository
     */
    private $articles;
    /**
     * @var CategoryRepository
     */
    private $categories;
    /**
     * @var TagRepository
     */
    private $tags;

    public function __construct(ArticleRepository $articles, CategoryRepository $categories, TagRepository $tags)
    {
        $this->articles = $articles;
        $this->categories = $categories;
        $this->tags = $tags;

        $this->middleware('auth')->only(['create', 'update']);
    }

    public function index(Request $request)
    {
        $articles = $this->articles->orderBy('published_at', 'DESC')->paginate(10);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $submitButtonText = 'Create';
        $categories = $this->categories->pluck('name', 'id');
        $tags = $this->tags->pluck('name', 'id');

        return view('articles.create', compact('submitButtonText', 'categories', 'tags'));
    }

    public function store(ArticlesCreateUpdateRequest $form)
    {
        $form->persist();

        return redirect()->route('articles.index');
    }

    public function show($id, $slug)
    {
        $article = $this->articles->find($id);

        $article->description = str_replace(
            ['<pre data-code="true" class="', '</pre>'], 
            ['<pre class="line-numbers"><code class="', '</code></pre>'], 
            $article->description
        );
        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = $this->articles->find($id);
        $article->tags_id = $article->tags()->pluck('id')->toArray();
        $submitButtonText = 'Update';
        $categories = $this->categories->pluck('name', 'id');
        $tags = $this->tags->pluck('name', 'id');

        return view('articles.edit', compact('submitButtonText', 'article', 'categories', 'tags'));
    }

    public function update(ArticlesCreateUpdateRequest $form, $id)
    {
        $form->persist($id);

        return redirect()->route('articles.show', ['id' => $id, 'slug' => $id]);
    }

    public function destroy($id)
    {
        $deleted = $this->articles->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Articles deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Articles deleted.');
    }
}
