<?php

namespace Nolikein\ApiDerpibooruFacade\Models;

use Illuminate\Database\Eloquent\Model;
use Nolikein\ApiDerpibooruFacade\Models\Serialize\HasDateFormatedForRFC3339;

class User extends Model
{
    use HasDateFormatedForRFC3339;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @see https://www.derpibooru.org/pages/api#user-response
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'role',
        'description',
        'avatar_url',
        'created_at',
        'comments_count',
        'uploads_count',
        'posts_count',
        'topics_count',
        'links',
        'awards'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'role' => 'string',
        'description' => 'string',
        'avatar_url' => 'string',
        'created_at' => 'datetime',
        'comments_count' => 'integer',
        'uploads_count' => 'integer',
        'posts_count' => 'integer',
        'topics_count' => 'integer',
        'links' => 'object',
        'awards' => 'object'
    ];
}
