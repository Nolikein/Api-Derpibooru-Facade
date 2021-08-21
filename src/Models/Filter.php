<?php

namespace Nolikein\ApiDerpibooruFacade\Models;

use Illuminate\Database\Eloquent\Model;
use Nolikein\ApiDerpibooruFacade\Models\Serialize\HasDateFormatedForRFC3339;
class Filter extends Model
{
    use HasDateFormatedForRFC3339;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @see https://www.derpibooru.org/pages/api#filter-response
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'user_id',
        'user_count',
        'system',
        'public',
        'spoilered_tag_ids',
        'spoilered_complex',
        'hidden_tag_ids',
        'hidden_complex'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'user_id' => 'integer',
        'user_count' => 'integer',
        'system' => 'boolean',
        'public' => 'boolean',
        'spoilered_tag_ids' => 'array',
        'spoilered_complex' => 'string',
        'hidden_tag_ids' => 'array',
        'hidden_complex' => 'string'
    ];
}
