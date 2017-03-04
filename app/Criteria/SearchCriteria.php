<?php

namespace App\Criteria;

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
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (!is_null($this->query)) {
            $model = $model->search($this->query);
        }
        return $model;
    }
}
