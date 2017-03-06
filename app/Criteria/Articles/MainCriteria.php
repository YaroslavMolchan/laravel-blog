<?php

namespace App\Criteria\Articles;

use App\Entities\Article;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MainCriteria
 * @package namespace App\Criteria;
 */
class MainCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('status', Article::STATUS_PUBLISHED);
        $model = $model->orderBy('published_at', 'DESC');
        $model = $model->withCount('comments');
        return $model;
    }
}
