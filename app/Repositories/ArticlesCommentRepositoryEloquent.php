<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ArticlesCommentRepository;
use App\Entities\ArticlesComment;
use App\Validators\ArticlesCommentValidator;

/**
 * Class ArticlesCommentRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ArticlesCommentRepositoryEloquent extends BaseRepository implements ArticlesCommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ArticlesComment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
