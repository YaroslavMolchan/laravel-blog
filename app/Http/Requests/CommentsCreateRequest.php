<?php

namespace App\Http\Requests;

use App\Repositories\ArticleRepository;
use Illuminate\Foundation\Http\FormRequest;

class CommentsCreateRequest extends FormRequest
{
    /**
     * @author MY
     * @var ArticleRepository
     */
    private $article;

    /**
     * @author MY
     * CommentsCreateRequest constructor.
     * @param ArticleRepository $article
     */
    public function __construct(ArticleRepository $article)
    {
        $this->article = $article;
        parent::__construct();
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
            'article_id' => 'required|exists:articles,id',
            'comment_id' => 'exists:articles_comments,id',
            'name' => 'required|min:2',
            'email' => 'required|email',
            'comment' => 'required',
        ];
    }

    public function persist() {
        $article = $this->article->find($this->article_id);
        $article->comments()->create([
            'name' => $this->name,
            'email' => $this->email,
            'comment' => $this->comment,
            'ip' => ip2long($this->ip()),
            'ua' => $this->header('User-Agent')
        ]);
        return $article;
    }
}
