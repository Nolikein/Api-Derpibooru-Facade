<?php

namespace Nolikein\ApiDerpibooruFacade\Models;

use Illuminate\Database\Eloquent\Model;
use Nolikein\ApiDerpibooruFacade\Models\Serialize\HasDateFormatedForRFC3339;
class Tag extends Model
{
    use HasDateFormatedForRFC3339;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @see https://www.derpibooru.org/pages/api#tag-response
     */
    protected $fillable = [
        'aliased_tag',
        'aliases',
        'category',
        'description',
        'dnp_entries',
        'id',
        'images',
        'implied_by_tags',
        'implied_tags',
        'name',
        'name_in_namespace',
        'namespace',
        'short_description',
        'slug',
        'spoiler_image_uri'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'aliased_tag' => 'string',
        'aliases' => 'array',
        'category' => 'string',
        'description' => 'string',
        'dnp_entries' => 'array',
        'id' => 'integer',
        'images' => 'integer',
        'implied_by_tags' => 'array',
        'implied_tags' => 'array',
        'name' => 'string',
        'name_in_namespace' => 'string',
        'namespace' => 'string',
        'short_description' => 'string',
        'slug' => 'string',
        'spoiler_image_uri' => 'string'
    ];
}
