<?php

namespace App\Http\Requests;

use App\Entities\Article;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;
use Illuminate\Support\Facades\Storage;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Orchestra\Imagine\Facade as Imagine;

class ArticlesCreateUpdateRequest extends FormRequest
{
    /**
     * @var ArticleRepository
     */
    protected $article;
    /**
     * @var TagRepository
     */
    private $tag;

    public function __construct(ArticleRepository $article, TagRepository $tag)
    {
        $this->article = $article;
        $this->tag = $tag;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'category_id' => 'required',
            'tags_id' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'image' => 'image'
        ];
    }

    public function persist($id = null) {
        $data = $this->all();
        $data['alias'] = str_slug($data['title']);
        if (isset($data['is_publish'])) {
            $data['status'] = Article::STATUS_PUBLISHED;
            $data['published_at'] = Carbon::now();
        }
        else {
            $data['status'] = Article::STATUS_DRAFT;
            $data['published_at'] = null;
        }
        if ($this->file('image')) {
            $data['image'] = $this->file('image')->store('articles');
            if (!empty($this->x1)) {
                $width  = $this->x2 - $this->x1;
                $height = $this->y2 - $this->y1;
                $size   = new Box($width, $height);
                $start   = new Point($this->x1, $this->y1);

                $path = storage_path('app/public/'.$data['image']);
                $image = Imagine::open($path);
                $image->crop($start, $size)->save($path);
            }
        }
        if (is_null($id)) {
            $article = request()->user()->articles()->create($data);
        }
        else {
            $article = $this->article->update($data, $id);
        }
        $tags_id = [];
        foreach ($this->tags_id as $id) {
            if (!ctype_digit($id)) {
                $id = $this->tag->updateOrCreate(['name' => $id])->id;
            }
            array_push($tags_id, $id);
        }
        $article->tags()->sync($tags_id);
    }
}
