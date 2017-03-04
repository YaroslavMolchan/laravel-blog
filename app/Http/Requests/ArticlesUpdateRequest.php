<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\ArticleRepository;
use App\Repositories\TagRepository;

class ArticlesUpdateRequest extends FormRequest
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
        ];
    }

    public function persist($id) {
        $data = $this->all();
        $data['alias'] = str_slug($data['title']);
        $article = $this->article->update($data, $id);
        $tags_id = [];
        foreach ($this->tags_id as $id) {
            if (!ctype_digit($id)) {
                $id = $this->tag->create(['name' => $id])->id;
            }
            array_push($tags_id, $id);
        }
        $article->tags()->sync($tags_id);
    }
}
