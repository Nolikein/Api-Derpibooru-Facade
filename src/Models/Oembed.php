<?php

namespace Nolikein\ApiDerpibooruFacade\Models;

use Illuminate\Database\Eloquent\Model;
use Nolikein\ApiDerpibooruFacade\Models\Serialize\HasDateFormatedForRFC3339;

class Oembed extends Model
{
    use HasDateFormatedForRFC3339;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @see https://www.derpibooru.org/pages/api#post-response
     */
    protected $fillable = [
        'author_name',
        'author_url',
        'cache_age',
        'derpibooru_comments',
        'derpibooru_id',
        'derpibooru_score',
        'derpibooru_tags',
        'provider_name',
        'provider_url',
        'title',
        'type',
        'version'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'author_name' => 'string',
        'author_url' => 'string',
        'cache_age' => 'integer',
        'derpibooru_comments' => 'integer',
        'derpibooru_id' => 'integer',
        'derpibooru_score' => 'integer',
        'derpibooru_tags' => 'array',
        'provider_name' => 'string',
        'provider_url' => 'string',
        'title' => 'string',
        'type' => 'string',
        'version' => 'string'
    ];
}
