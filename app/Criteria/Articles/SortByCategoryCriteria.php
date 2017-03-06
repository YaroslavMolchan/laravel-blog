<?php

namespace App\Criteria\Articles;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SortByCategoryCriteria
 * @package namespace App\Criteria;
 */
class SortByCategoryCriteria implements CriteriaInterface
{
    /**
     * @author MY
     * @var
     */
    private $category_id;

    /**
     * @author MY
     * FilterCriteria constructor.
     * @param $category_id
     */
    public function __construct($category_id = null)
    {
        $this->category_id = $category_id;
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
        //L5-Repository bag, need to return query to $model if i don`t use with or something like this
        if (!is_null($this->category_id)) {
            $model = $model->where('category_id', $this->category_id);
        }
        return $model;
    }
}
