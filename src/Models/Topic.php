<?php

namespace Nolikein\ApiDerpibooruFacade\Models;

use Illuminate\Database\Eloquent\Model;
use Nolikein\ApiDerpibooruFacade\Models\Serialize\HasDateFormatedForRFC3339;

class Topic extends Model
{
    use HasDateFormatedForRFC3339;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @see https://www.derpibooru.org/pages/api#filter-response
     */
    protected $fillable = [
        'slug',
        'title',
        'post_count',
        'view_count',
        'sticky',
        'last_replied_to_at',
        'locked',
        'user_id',
        'author'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'slug' => 'string',
        'title' => 'string',
        'post_count' => 'integer',
        'view_count' => 'integer',
        'sticky' => 'boolean',
        'last_replied_to_at' => 'datetime',
        'locked' => 'boolean',
        'user_id' => 'integer',
        'author' => 'string'
    ];
}
