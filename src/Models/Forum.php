<?php

namespace Nolikein\ApiDerpibooruFacade\Models;

use Illuminate\Database\Eloquent\Model;
use Nolikein\ApiDerpibooruFacade\Models\Serialize\HasDateFormatedForRFC3339;

class Forum extends Model
{
    use HasDateFormatedForRFC3339;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @see https://www.derpibooru.org/pages/api#filter-response
     */
    protected $fillable = [
        'name',
        'short_name',
        'description',
        'topic_count',
        'post_count'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'short_name' => 'string',
        'description' => 'string',
        'topic_count' => 'integer',
        'post_count' => 'integer'
    ];
}
