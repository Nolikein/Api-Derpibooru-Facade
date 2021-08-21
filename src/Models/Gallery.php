<?php

namespace Nolikein\ApiDerpibooruFacade\Models;

use Illuminate\Database\Eloquent\Model;
use Nolikein\ApiDerpibooruFacade\Models\Serialize\HasDateFormatedForRFC3339;

class Gallery extends Model
{
    use HasDateFormatedForRFC3339;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @see https://www.derpibooru.org/pages/api#filter-response
     */
    protected $fillable = [
        'description',
        'id',
        'spoiler_warning',
        'thumbnail_id',
        'title',
        'user',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'description' => 'string',
        'id' => 'integer',
        'spoiler_warning' => 'string',
        'thumbnail_id' => 'integer',
        'title' => 'string',
        'user' => 'string',
        'user_id' => 'integer'
    ];
}
