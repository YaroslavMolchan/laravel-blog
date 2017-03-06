<?php

namespace App\Criteria\Articles;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SortByTagCriteria
 * @package namespace App\Criteria;
 */
class SortByTagCriteria implements CriteriaInterface
{
    /**
     * @author MY
     * @var
     */
    private $tag_id;

    /**
     * @author MY
     * FilterCriteria constructor.
     * @param $tag_id
     */
    public function __construct($tag_id = null)
    {
        $this->tag_id = $tag_id;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        //L5-Repository bag, need to return query to $model if i don`t use with or something like this
        if (!is_null($this->tag_id)) {
            $model = $model->whereHas('tags', function ($query) {
                $query->where('id', $this->tag_id);
            });
        }
        return $model;
    }
}
