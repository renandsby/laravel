<?php

namespace App\Models;

use App\Enuns\SupportStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function status(): Attribute
    {
        return Attribute::make(
            set: fn (SupportStatus $status) => $status->name,
        );
    }
}
