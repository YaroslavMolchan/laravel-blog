<?php

namespace App\Criteria\Articles;

use App\Entities\Article;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PublishedCriteria
 * @package namespace App\Criteria;
 */
class PublishedCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param Builder $model
     * @param RepositoryInterface $repository
     *
     * @return Builder
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('status', Article::STATUS_PUBLISHED)
            ->orderBy('published_at', 'DESC')
            ->withCount('comments');
    }
}
