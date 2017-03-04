<?php

namespace  App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\TagRepository;

class SidebarDataService {
    /**
     * @author MY
     * @var CategoryRepository
     */
    private $categories;
    /**
     * @author MY
     * @var TagRepository
     */
    private $tags;

    /**
     * @author MY
     * SidebarDataService constructor.
     * @param CategoryRepository $categories
     * @param TagRepository $tags
     */
    public function __construct(CategoryRepository $categories, TagRepository $tags)
    {
        $this->categories = $categories;
        $this->tags = $tags;
    }

    public function categories()
    {
        return $this->categories->all();
    }

    public function tags()
    {
        return $this->tags->all();
    }
}