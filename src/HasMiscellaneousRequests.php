<?php

namespace Nolikein\ApiDerpibooruFacade;

use Nolikein\ApiDerpibooruFacade\Models\Filter;
use Nolikein\ApiDerpibooruFacade\Models\Image;
use Nolikein\ApiDerpibooruFacade\Models\Oembed;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait HasMiscellaneousRequests
{
    /**
     * Fetch the featured image
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\Image
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getFeaturedImage(): Image
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->fetchFeaturedImagePath;

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new image model
        return new Image($response->json('image'));
    }

    /**
     * Fetch the filter list
     * 
     * @param int $page Controls the current page of the response, if the response is paginated. Empty values default to the first page.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getFilterList(?int $page = null): Collection
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->fetchFilterListPath . '?' . Arr::query([
            Requester::ARG_PAGE => $page
        ]);

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new filter model collection
        $collection = new Collection();
        foreach ($response->json('filters') as $filter) {
            $collection->add(new Filter($filter));
        }

        return $collection;
    }

    /**
     * Fetch the filter for a user set as token
     * 
     * @param $authToken An optional authentication token. If omitted, no user will be authenticated. You can find your authentication token in your account settings.
     * @param int $page Controls the current page of the response, if the response is paginated. Empty values default to the first page.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
     */
    public function getUserFilters(string $authToken, ?int $page = null): Collection
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->fetchUserFiltersPath . '?' . Arr::query([
            Requester::ARG_AUTH_TOKEN => $authToken,
            Requester::ARG_PAGE => $page
        ]);

        // Request the metadata
        $response = Http::get($uri);
        if ($response->status() === 403) {
            throw new AccessDeniedHttpException("The user auth token / key is missing or invalid");
        }
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new filter model collection
        $collection = new Collection();
        foreach ($response->json('filters') as $filter) {
            $collection->add(new Filter($filter));
        }

        return $collection;
    }

    /**
     * Fetch an oembed by url
     * 
     * @param string $url The url to do the oembed
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\Oembed
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getOembedByUrl(string $url): Oembed
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->fetchOembedByUrlPath . '?' . Arr::query([
            Requester::ARG_URL => $url
        ]);

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new oembed model
        return new Oembed($response->json());
    }

    /**
     * Do a reverse image search
     * 
     * @param string $url The image onto you realize the search
     * @param string $authToken An optional authentication token. If omitted, no user will be authenticated. You can find your authentication token in your account settings.
     * @param mixed $distance Need to define
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function doReverseImageSearchByUrl(string $url, ?string $authToken = null, $distance = null): Collection
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->doResearchImageSearchByUrlPath . '?' . Arr::query([
            Requester::ARG_URL => $url,
            Requester::ARG_AUTH_TOKEN => $authToken,
            Requester::ARG_DISTANCE => $distance
        ]);

        // Request the metadata
        $response = Http::post($uri);
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
}
