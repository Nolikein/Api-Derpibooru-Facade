<?php

namespace Nolikein\ApiDerpibooruFacade;

class Requester
{
    use HasRequestsById;
    use HasRequestsByQuery;
    use HasForumRequests;
    use HasMiscellaneousRequests;

    const ARG_PAGE = 'page';
    const ARG_PER_PAGE = 'per_page';
    const ARG_URL = 'url';
    const ARG_AUTH_TOKEN = 'key';
    const ARG_DISTANCE = 'distance';
    const ARG_FILTER_ID = 'filter_id';
    const ARG_QUERY = 'q';
    const ARG_SORT_FIELD = 'sf';
    const ARG_SORT_DIRECTION = 'sd';

    public function __construct(
        private string $websiteUrl = '',
        private string $fetchCommentPath = '',
        private string $fetchImagePath = '',
        private string $fetchTagPath = '',
        private string $fetchPostPath = '',
        private string $fetchUserPath = '',
        private string $fetchFilterPath = '',
        private string $fetchFeaturedImagePath = '',
        private string $fetchFilterListPath = '',
        private string $fetchUserFiltersPath = '',
        private string $fetchOembedByUrlPath = '',
        private string $fetchCommentsByQueryPath = '',
        private string $fetchGalleriesByQueryPath = '',
        private string $fetchImagesByQueryPath = '',
        private string $fetchTagsByQueryPath = '',
        private string $doResearchImageSearchByUrlPath = '',
        private string $fetchForumListPath = '',
        private string $fetchForumByShortNamePath = '',
        private string $fetchTopicsByForumShortNamePath = '',
        private string $fetchTopicBySlugPath = '',
        private string $fetchPostListFromTopicPath = '',
        private string $fetchPostFromTopicPath = ''
    ) {
        $this->websiteUrl = config('derpibooru_api.website_url', 'https://derpibooru.org');
        $this->fetchCommentPath = config('derpibooru_api.path.fetch_comment');
        $this->fetchImagePath = config('derpibooru_api.path.fetch_image');
        $this->fetchTagPath = config('derpibooru_api.path.fetch_tag');
        $this->fetchPostPath = config('derpibooru_api.path.fetch_post');
        $this->fetchUserPath = config('derpibooru_api.path.fetch_user');
        $this->fetchFilterPath = config('derpibooru_api.path.fetch_filter');
        $this->fetchFeaturedImagePath = config('derpibooru_api.path.fetch_featured_image');
        $this->fetchFilterListPath = config('derpibooru_api.path.fetch_filter_list');
        $this->fetchUserFiltersPath = config('derpibooru_api.path.fetch_user_filters');
        $this->fetchOembedByUrlPath = config('derpibooru_api.path.fetch_oembed_by_url');
        $this->fetchCommentsByQueryPath = config('derpibooru_api.path.fetch_comments_by_query');
        $this->fetchGalleriesByQueryPath = config('derpibooru_api.path.fetch_galleries_by_query');
        $this->fetchPostsByQueryPath = config('derpibooru_api.path.fetch_posts_by_query');
        $this->fetchImagesByQueryPath = config('derpibooru_api.path.fetch_images_by_query');
        $this->fetchTagsByQueryPath = config('derpibooru_api.path.fetch_tags_by_query');
        $this->doResearchImageSearchByUrlPath = config('derpibooru_api.path.do_reverse_image_search_by_url');
        $this->fetchForumListPath = config('derpibooru_api.path.fetch_forum_list');
        $this->fetchForumByShortNamePath = config('derpibooru_api.path.fetch_forum_by_short_name');
        $this->fetchTopicsByForumShortNamePath = config('derpibooru_api.path.fetch_topics_by_forum_short_name');
        $this->fetchTopicBySlugPath = config('derpibooru_api.path.fetch_topic_by_slug');
        $this->fetchPostListFromTopicPath = config('derpibooru_api.path.fetch_post_list_from_topic');
        $this->fetchPostFromTopicPath = config('derpibooru_api.path.fetch_post_from_topic');
    }
}
