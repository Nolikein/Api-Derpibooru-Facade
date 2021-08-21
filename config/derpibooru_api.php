<?php

return [
    'website_url' => 'https://derpibooru.org',

    'path' => [
        'fetch_image' => '/api/v1/json/images/:image_id',
        'fetch_comment' => '/api/v1/json/comments/:comment_id',
        'fetch_tag' => '/api/v1/json/tags/:tag_id',
        'fetch_post' => '/api/v1/json/posts/:post_id',
        'fetch_user' => '/api/v1/json/profiles/:user_id',
        'fetch_filter' => '/api/v1/json/filters/:filter_id',
        'fetch_featured_image' => '/api/v1/json/images/featured',
        'fetch_filter_list' => '/api/v1/json/filters/system',
        'fetch_user_filters' => '/api/v1/json/filters/user',
        'fetch_oembed_by_url' => '/api/v1/json/oembed',
        'fetch_comments_by_query' => '/api/v1/json/search/comments',
        'fetch_galleries_by_query' => '/api/v1/json/search/galleries',
        'fetch_posts_by_query' => '/api/v1/json/search/posts',
        'fetch_images_by_query' => '/api/v1/json/search/images',
        'fetch_tags_by_query' => '/api/v1/json/search/tags',
        'do_reverse_image_search_by_url' => '/api/v1/json/search/reverse',
        'fetch_forum_list' => '/api/v1/json/forums',
        'fetch_forum_by_short_name' => '/api/v1/json/forums/:short_name',
        'fetch_topics_by_forum_short_name' => '/api/v1/json/forums/:short_name/topics',
        'fetch_topic_by_slug' => '/api/v1/json/forums/:short_name/topics/:topic_slug',
        'fetch_post_list_from_topic' => '/api/v1/json/forums/:short_name/topics/:topic_slug/posts',
        'fetch_post_from_topic' => '/api/v1/json/forums/:short_name/topics/:topic_slug/posts/:post_id'
    ]
];
