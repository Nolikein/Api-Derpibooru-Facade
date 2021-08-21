<?php

namespace Nolikein\ApiDerpibooruFacade;

use Illuminate\Support\Facades\Http;
use Nolikein\ApiDerpibooruFacade\Models\Comment;
use Nolikein\ApiDerpibooruFacade\Models\Filter;
use Nolikein\ApiDerpibooruFacade\Models\Image;
use Nolikein\ApiDerpibooruFacade\Models\Post;
use Nolikein\ApiDerpibooruFacade\Models\Tag;
use Nolikein\ApiDerpibooruFacade\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait HasRequestsById
{
    /**
     * Fetch a comment model from the derpibooru api
     * 
     * @param int $idComment The comment to fetch by id
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\Comment
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getCommentById(int $idComment): Comment
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . Str::replace(':comment_id', $idComment, $this->fetchCommentPath);

        // Request the metadata
        $response = Http::get($uri);
        if($response->status() === 404) {
            throw new NotFoundHttpException("the element $idComment does not exists");
        }
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new image model
        return new Comment($response->json('comment'));
    }

    /**
     * Fetch an image model from the derpibooru api
     * 
     * @param string $authToken An optional authentication token. If omitted, no user will be authenticated. You can find your authentication token in your account settings.
     * @param int $filterId Assuming the user can access the filter ID given by the parameter, overrides the current filter for this request. This is primarily useful for unauthenticated API access.
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\Image
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getImageById(int $idImage, string $authToken = null, int $filterId = null): Image
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . Str::replace(':image_id', $idImage, $this->fetchImagePath.'?'.Arr::query([
            Requester::ARG_AUTH_TOKEN => $authToken,
            Requester::ARG_FILTER_ID => $filterId
        ]));

        // Request the metadata
        $response = Http::get($uri);
        if($response->status() === 404) {
            throw new NotFoundHttpException("the element $idImage does not exists");
        }
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new image model
        return new Image($response->json('image'));
    }

    /**
     * Fetch a tag model from the derpibooru api
     * 
     * @param int $tagId The tag to fetch by id
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\Tag
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getTagById(int $tagId): Tag
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . Str::replace(':tag_id', $tagId, $this->fetchTagPath);

        // Request the metadata
        $response = Http::get($uri);
        if($response->status() === 404) {
            throw new NotFoundHttpException("the element $tagId does not exists");
        }
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new image model
        return new Tag($response->json('tag'));
    }

    /**
     * Fetch a post model from the derpibooru api
     * 
     * @param int $postId The post to fetch by id
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\Post
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getPostById(int $postId): Post
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . Str::replace(':post_id', $postId, $this->fetchPostPath);

        // Request the metadata
        $response = Http::get($uri);
        if($response->status() === 404) {
            throw new NotFoundHttpException("the element $postId does not exists");
        }
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new image model
        return new Post($response->json('post'));
    }

    /**
     * Fetch a user model from the derpibooru api
     * 
     * @param int $userId The user to fetch by id
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\User
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getUserById(int $userId): User
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . Str::replace(':user_id', $userId, $this->fetchUserPath);

        // Request the metadata
        $response = Http::get($uri);
        if($response->status() === 404) {
            throw new NotFoundHttpException("the element $userId does not exists");
        }
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new image model
        return new User($response->json('user'));
    }

    /**
     * Fetch a filter model from the derpibooru api
     * 
     * @param int $filterId The user to fetch by id
     * @param string $authToken An optional authentication token. If omitted, no user will be authenticated. You can find your authentication token in your account settings.
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\Filter
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getFilterById(int $filterId, string $authToken = null): Filter
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . Str::replace(':filter_id', $filterId, $this->fetchFilterPath.'?'.Arr::query([
            Requester::ARG_AUTH_TOKEN => $authToken
        ]));

        // Request the metadata
        $response = Http::get($uri);
        if($response->status() === 404) {
            throw new NotFoundHttpException("the element $filterId does not exists");
        }
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new image model
        return new Filter($response->json('filter'));
    }
}
