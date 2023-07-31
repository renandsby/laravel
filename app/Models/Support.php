<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;


    // fala quais colunas podem ser gravadas no banco
    protected $fillable = [
        'subject',
        'body',
        'status'
    ];
}
