<?php

namespace Nolikein\ApiDerpibooruFacade\Models;

use Illuminate\Database\Eloquent\Model;
use Nolikein\ApiDerpibooruFacade\Models\Serialize\HasDateFormatedForRFC3339;

class Post extends Model
{
    use HasDateFormatedForRFC3339;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @see https://www.derpibooru.org/pages/api#post-response
     */
    protected $fillable = [
        'author',
        'avatar',
        'body',
        'created_at',
        'edit_reason',
        'edited_at',
        'id',
        'updated_at',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'author' => 'string',
        'avatar' => 'string',
        'body' => 'string',
        'created_at' => 'datetime',
        'edit_reason' => 'string',
        'edited_at' => 'datetime',
        'id' => 'integer',
        'updated_at' => 'datetime',
        'user_id' => 'integer'
    ];
}
