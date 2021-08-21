<?php

namespace Nolikein\ApiDerpibooruFacade;

use Nolikein\ApiDerpibooruFacade\Models\Comment;
use Nolikein\ApiDerpibooruFacade\Models\Gallery;
use Nolikein\ApiDerpibooruFacade\Models\Image;
use Nolikein\ApiDerpibooruFacade\Models\Post;
use Nolikein\ApiDerpibooruFacade\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait HasRequestsByQuery
{
    /**
     * Fetch a collection of comments model by query
     * 
     * @param string $query The comment to search
     * @param string $authToken An optional authentication token. If omitted, no user will be authenticated. You can find your authentication token in your account settings.
     * @param int $page Controls the current page of the response, if the response is paginated. Empty values default to the first page.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getCommentsByQuery(string $query, ?string $authToken = null, ?int $page = null): Collection
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->fetchCommentsByQueryPath . '?' . Arr::query([
            Requester::ARG_QUERY => $query,
            Requester::ARG_AUTH_TOKEN => $authToken,
            Requester::ARG_PAGE => $page
        ]);

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new comment model collection
        $collection = new Collection();
        foreach ($response->json('comments') as $filter) {
            $collection->add(new Comment($filter));
        }

        return $collection;
    }

    /**
     * Fetch a collection of galleries model by query
     * 
     * @param string $query The gallery to search
     * @param string $authToken An optional authentication token. If omitted, no user will be authenticated. You can find your authentication token in your account settings.
     * @param int $page Controls the current page of the response, if the response is paginated. Empty values default to the first page.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getGalleriesByQuery(string $query, ?string $authToken = null, ?int $page = null): Collection
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->fetchGalleriesByQueryPath . '?' . Arr::query([
            Requester::ARG_QUERY => $query,
            Requester::ARG_AUTH_TOKEN => $authToken,
            Requester::ARG_PAGE => $page
        ]);

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new gallery model collection
        $collection = new Collection();
        foreach ($response->json('galleries') as $filter) {
            $collection->add(new Gallery($filter));
        }

        return $collection;
    }

    /**
     * Fetch a collection of posts model by query
     * 
     * @param string $query The post to search
     * @param string $authToken An optional authentication token. If omitted, no user will be authenticated. You can find your authentication token in your account settings.
     * @param int $page Controls the current page of the response, if the response is paginated. Empty values default to the first page.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getPostsByQuery(string $query, ?string $authToken = null, ?int $page = null): Collection
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->fetchPostsByQueryPath . '?' . Arr::query([
            Requester::ARG_QUERY => $query,
            Requester::ARG_AUTH_TOKEN => $authToken,
            Requester::ARG_PAGE => $page
        ]);

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new post model collection
        $collection = new Collection();
        foreach ($response->json('posts') as $post) {
            $collection->add(new Post($post));
        }

        return $collection;
    }

    /**
     * Fetch a collection of images model by query
     * 
     * @param string $query The image to search
     * @param string $authToken An optional authentication token. If omitted, no user will be authenticated. You can find your authentication token in your account settings.
     * @param int $page Controls the current page of the response, if the response is paginated. Empty values default to the first page.
     * @param int $perPage Controls the number of results per page, up to a limit of 50, if the response is paginated. The default is 25.
     * @param int $filterId Assuming the user can access the filter ID given by the parameter, overrides the current filter for this request. This is primarily useful for unauthenticated API access.
     * @param mixed $sortDirection The current sort direction, if the request is a search request.
     * @param mixed $sortField The current sort field, if the request is a search request.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getImagesByQuery(
        string $query,
        ?string $authToken = null,
        ?int $page = null,
        ?int $perPage = null,
        ?int $filterId = null,
        $sortDirection = null,
        $sortField = null
    ): Collection {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->fetchImagesByQueryPath . '?' . Arr::query([
            Requester::ARG_QUERY => $query,
            Requester::ARG_SORT_DIRECTION => $sortDirection,
            Requester::ARG_SORT_FIELD => $sortField,
            Requester::ARG_AUTH_TOKEN => $authToken,
            Requester::ARG_PAGE => $page,
            Requester::ARG_PER_PAGE => $perPage,
            Requester::ARG_FILTER_ID => $filterId
        ]);

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new image model collection
        $collection = new Collection();
        foreach ($response->json('images') as $image) {
            $collection->add(new Image($image));
        }

        return $collection;
    }

    /**
     * Fetch a collection of tags model by query
     * 
     * @param string $query The tag to search
     * @param int $page Controls the current page of the response, if the response is paginated. Empty values default to the first page.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getTagsByQuery(string $query, ?int $page = null): Collection
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->fetchTagsByQueryPath . '?' . Arr::query([
            Requester::ARG_QUERY => $query,
            Requester::ARG_PAGE => $page
        ]);

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new tag model collection
        $collection = new Collection();
        foreach ($response->json('tags') as $tag) {
            $collection->add(new Tag($tag));
        }

        return $collection;
    }
}
