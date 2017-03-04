<?php

namespace App\Criteria;

use App\Entities\Article;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FilterCriteria
 * @package namespace App\Criteria;
 */
class FilterCriteria implements CriteriaInterface
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
        if ($this->category_id) {
            $model->where('category_id', $this->category_id);
        }
//        $tag_id = request()->input('tag');
//        if ($tag_id) {
//            $model->where('tag_id', $tag_id);
//        }
        $model->where('status', Article::STATUS_PUBLISHED);
        return $model;
    }
}
