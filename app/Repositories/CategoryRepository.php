<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Entities\Category;
use App\Validators\CategoryValidator;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepository extends BaseRepository implements RepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
