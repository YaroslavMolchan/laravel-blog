<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Article;

/**
 * Class ArticleTransformer
 * @package namespace App\Transformers;
 */
class ArticleTransformer extends TransformerAbstract
{

    /**
     * Transform the \Article entity
     * @param \Article $model
     *
     * @return array
     */
    public function transform(Article $model)
    {
        return [
            'id'         => (int) $model->id,
            'title' => $model->title,
            'alias' => $model->alias,
            'short_description' => $model->short_description,
            'commentsCount' => $model->comments()->count(),
            // 'publishedDate' => $model->published_at->format('m d, Y'),
            'publishedDate' => $model->created_at->format('M d, Y'),

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
