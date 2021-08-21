<?php

namespace Nolikein\ApiDerpibooruFacade\Models;

use Illuminate\Database\Eloquent\Model;
use Nolikein\ApiDerpibooruFacade\Models\Serialize\HasDateFormatedForRFC3339;
class Image extends Model
{
    use HasDateFormatedForRFC3339;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * @see https://derpibooru.org/pages/api#image-response
     */
    protected $fillable = [
        'animated',
        'aspect_ratio',
        'comment_count',
        'created_at',
        'deletion_reason',
        'are',
        'description',
        'downvotes',
        'duplicate_of',
        'duration',
        'faves',
        'first_seen_at',
        'format',
        'height',
        'hidden_from_users',
        'id',
        'intensities',
        'mime_type',
        'name',
        'orig_sha512_hash',
        'processed',
        'representations',
        'score',
        'sha512_hash',
        'size',
        'source_url',
        'spoilered',
        'tag_count',
        'tag_ids',
        'tags',
        'thumbnails_generated',
        'updated_at',
        'uploader',
        'uploader_id',
        'upvotes',
        'view_url',
        'width',
        'wilson_score'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'animated' => 'boolean',
        'aspect_ratio' => 'float',
        'comment_count' => 'integer',
        'created_at' => 'datetime',
        'deletion_reason' => 'string',
        'are' => 'string',
        'description' => 'string',
        'downvotes' => 'integer',
        'duplicate_of' => 'integer',
        'duration' => 'float',
        'faves' => 'integer',
        'first_seen_at' => 'datetime',
        'format' => 'string',
        'height' => 'integer',
        'hidden_from_users' => 'boolean',
        'id' => 'integer',
        'intensities' => 'object',
        'mime_type' => 'string',
        'name' => 'string',
        'orig_sha512_hash' => 'string',
        'processed' => 'boolean',
        'representations' => 'object',
        'score' => 'integer',
        'sha512_hash' => 'string',
        'size' => 'integer',
        'source_url' => 'string',
        'spoilered' => 'boolean',
        'tag_count' => 'integer',
        'tag_ids' => 'array',
        'tags' => 'array',
        'thumbnails_generated' => 'boolean',
        'updated_at' => 'datetime',
        'uploader' => 'string',
        'uploader_id' => 'integer',
        'upvotes' => 'integer',
        'view_url' => 'string',
        'width' => 'integer',
        'wilson_score' => 'float'
    ];
}
