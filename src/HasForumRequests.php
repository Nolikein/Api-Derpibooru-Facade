<?php

namespace Nolikein\ApiDerpibooruFacade;

use Nolikein\ApiDerpibooruFacade\Requester;
use Nolikein\ApiDerpibooruFacade\Models\Forum;
use Nolikein\ApiDerpibooruFacade\Models\Post;
use Nolikein\ApiDerpibooruFacade\Models\Topic;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait HasForumRequests
{
    /**
     * Fetch forum list in a model collection
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getForums(): Collection
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . $this->fetchForumListPath;

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new forum model collection
        $collection = new Collection();
        foreach ($response->json('forums') as $forum) {
            $collection->add(new Forum($forum));
        }

        return $collection;
    }

    /**
     * Fetch a forum in a model
     * 
     * @param string $forumShortName The forum to fetch by its short name
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\Forum
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getForum(string $forumShortName): Forum
    {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . Str::replace(':short_name', $forumShortName, $this->fetchForumByShortNamePath);

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new forum model
        return new Forum($response->json('forum'));
    }

    /**
     * Fetch topic list that that belongs to a forum in a model collection
     * 
     * @param string $forumShortName The forum short name which own the topic
     * @param int $page Controls the current page of the response, if the response is paginated. Empty values default to the first page.
     * @param int $perPage Controls the number of results per page, up to a limit of 50, if the response is paginated. The default is 25.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getTopics(string $forumShortName, ?int $page = null, ?int $perPage = null): Collection {
        // Construct the complete uri to fetch the model data
        $uri = $this->websiteUrl . Str::replace(':short_name', $forumShortName, $this->fetchTopicsByForumShortNamePath) . '?' . Arr::query([
            Requester::ARG_PAGE => $page,
            Requester::ARG_PER_PAGE => $perPage
        ]);

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new topic model collection
        $collection = new Collection();
        foreach ($response->json('topics') as $topic) {
            $collection->add(new Topic($topic));
        }

        return $collection;
    }

    /**
     * Fetch a topic in a model that belongs to a forum
     * 
     * @param string $shortName The forum to fetch by its short name
     * @param string $topicSlug The topic slug to get
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\Topic
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getTopic(string $forumShortName, string $topicSlug): Topic
    {
        // Construct the complete uri to fetch the model data
        $path = $this->fetchTopicBySlugPath;
        foreach ([
            ':short_name' => $forumShortName,
            ':topic_slug' => $topicSlug
        ] as $key => $value) {
            $path = Str::replace($key, $value, $path);
        }
        $uri = $this->websiteUrl . $path;

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new topic model
        return new Topic($response->json('topic'));
    }

    /**
     * Fetch posts list that that belongs to a topic that belongs to a forum in a model collection
     * 
     * @param string $shortName The forum short name which own the topic
     * @param string $topicSlug The topic slug to get
     * @param int $page Controls the current page of the response, if the response is paginated. Empty values default to the first page.
     * @param int $perPage Controls the number of results per page, up to a limit of 50, if the response is paginated. The default is 25.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getPostsFromTopic(
        string $forumShortName,
        string $topicSlug,
        int $page = null,
        int $perPage = null
    ): Collection {
        // Construct the complete uri to fetch the model data
        $path = $this->fetchPostListFromTopicPath;
        foreach ([
            ':short_name' => $forumShortName,
            ':topic_slug' => $topicSlug
        ] as $key => $value) {
            $path = Str::replace($key, $value, $path);
        }
        $uri = $this->websiteUrl . $path . '?' . Arr::query([
            Requester::ARG_PAGE => $page,
            Requester::ARG_PER_PAGE => $perPage
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
     * Fetch a post in a model that belongs to a topic that belongs to a forum
     * 
     * @param string $shortName The forum to fetch by its short name
     * @param string $topicSlug The topic slug to get
     * @param int $topicId The topic id to get
     * 
     * @return \Nolikein\ApiDerpibooruFacade\Models\Post
     * 
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function getPostFromTopic(string $forumShortName, string $topicSlug, int $topicId): Post
    {
        // Construct the complete uri to fetch the model data
        $path = $this->fetchPostFromTopicPath;
        foreach ([
            ':short_name' => $forumShortName,
            ':topic_slug' => $topicSlug,
            ':post_id' => $topicId
        ] as $key => $value) {
            $path = Str::replace($key, $value, $path);
        }
        $uri = $this->websiteUrl . $path;

        // Request the metadata
        $response = Http::get($uri);
        if ($response->failed()) {
            throw new HttpException("The fetching of the url $uri has encountered an error");
        }

        // Create and return a new topic model
        return new Post($response->json('post'));
    }
}
