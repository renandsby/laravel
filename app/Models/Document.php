<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Document extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id',
        'title',
        'category_id',
        'user_id',
        'year',
        'contents'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
