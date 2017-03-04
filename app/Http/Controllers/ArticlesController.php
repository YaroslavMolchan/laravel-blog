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
    private $article;
    /**
     * @var CategoryRepository
     */
    private $category;
    /**
     * @var TagRepository
     */
    private $tag;

    public function __construct(ArticleRepository $article, CategoryRepository $category, TagRepository $tag)
    {
        $this->article = $article;
        $this->category = $category;
        $this->tag = $tag;

        $this->middleware('auth')->only(['create', 'update']);
    }

    public function index(Request $request)
    {
        $url = '/api/articles/';
        if ($request->input('query')) {
            $url = '/api/articles/?query=' . $request->input('query');
        }

        if ($request->is('api/*')) {
            $this->article->pushCriteria(FilterCriteria::class);
            $articles = $this->article->with(['comments'])->orderBy('created_at', 'DESC')->paginate(10);

            return response()->json([
                'data' => $articles,
            ]);
        }
        \JavaScript::put(['itemsUrl' => $url]);

        return view('articles.index');
    }

    public function search()
    {
        $this->article->pushCriteria(new SearchCriteria(request()->input('query')));
        $articles = $this->article->all();

        return response()->json([
            'data' => $articles,
        ]);
    }

    public function create()
    {
        $submitButtonText = 'Create';
        $categories = $this->category->pluck('name', 'id');
        $tags = $this->tag->pluck('name', 'id');

        return view('articles.create', compact('submitButtonText', 'categories', 'tags'));
    }

    public function store(ArticlesCreateUpdateRequest $form)
    {
        $form->persist();

        return redirect()->route('articles.index');
    }

    public function show($id, $slug)
    {
        $article = $this->article->find($id);
        if (is_null($article)) {
            abort(404, 'Запись не найдена.');
        }
//        PHP7 preg_match bag
//        $article->description = preg_replace_callback('/<pre class="(.+?)">((\s|.)*?)<\/pre>/m', function($matches){
//            return "<pre class=\"line-numbers\"><code class=\"$matches[1]\">$matches[2]</code></pre>";
//        }, $article->description);
        $article->description = str_replace(['<pre data-code="true" class="', '</pre>'], ['<pre class="line-numbers"><code class="', '</code></pre>'], $article->description);
        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = $this->article->find($id);
        $article->tags_id = $article->tags()->pluck('id')->toArray();
        $submitButtonText = 'Update';
        $categories = $this->category->pluck('name', 'id');
        $tags = $this->tag->pluck('name', 'id');

        return view('articles.edit', compact('submitButtonText', 'article', 'categories', 'tags'));
    }

    public function update(ArticlesCreateUpdateRequest $form, $id)
    {
        $form->persist($id);

        return redirect()->route('articles.show', ['id' => $id, 'slug' => $id]);
    }

    public function destroy($id)
    {
        $deleted = $this->article->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Articles deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Articles deleted.');
    }
}
