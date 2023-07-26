<?php

namespace App\Repositories;

use App\Entities\Category;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * class DocumentRepository
 *
 * @package namespace App\Repositories;
 */
class DocumentRepository extends BaseRepository implements RepositoryInterface
{
    protected $fieldSearchable = [
        'nome' => 'like',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Document::class;
    }

    public function create (array $attributes)
    {
        return DB::transaction(function () use ($attributes) {

            $exercicio  = $attributes['exercicio'];
            $documentos = $attributes['documentos'];
            $user_id    = $attributes['user_id'];
            $document = [];
            foreach ($documentos as $documento){

                $category = Category::where(['name'=>$documento['categoria']])->first();

                if (!empty($category["id"])){

                    $attrs = [
                        'year' => $exercicio,
                        'category_id' => $category["id"],
                        'title' => $documento['titulo'],
                        'contents' => $documento['conteúdo'],
                        'user_id' => $user_id
                    ];

                    $document[] = parent::create($attrs);
                }else{
                    $document[] = [
                        'error' => "Documento não inserido para o título {$documento['titulo']}"
                    ];
                }
            }

            return $document;

        });
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
