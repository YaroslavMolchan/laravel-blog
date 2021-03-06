<?php

namespace App\Criteria\Articles;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SearchCriteria
 * @property Request request
 * @package namespace App\Criteria;
 */
class SearchCriteria implements CriteriaInterface
{

    protected $query;

    public function __construct(string $query = null)
    {
        $this->query = $query;
    }

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
        if (!is_null($this->query)) {
            $model->where(function ($query) {
                $query->where('title', 'ilike', '%'.$this->query.'%')
                    ->orWhere('description', 'ilike', '%'.$this->query.'%')
                    ->orWhere('short_description', 'ilike', '%'.$this->query.'%');
            });
        }

        return $model;
    }
}
