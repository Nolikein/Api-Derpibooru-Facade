<?php

namespace Tests\DerpibooruApiFacade;

use Nolikein\ApiDerpibooruFacade\Models\Forum;
use Nolikein\ApiDerpibooruFacade\Models\Post;
use Nolikein\ApiDerpibooruFacade\Models\Topic;
use Nolikein\ApiDerpibooruFacade\Requester;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class HasForumRequestsTest extends TestCase
{
    public function test_can_fetch_forums()
    {
        $requester = new Requester();
        $collection = $requester->getForums();
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $forum) {
            $this->assertInstanceOf(Forum::class, $forum);
        }

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.fetch_forum_list');
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('forums.0.name'), $collection->first()->name);
    }

    public function test_can_fetch_forum()
    {
        $requester = new Requester();
        $forum = $requester->getForum('dis');
        $this->assertInstanceOf(Forum::class, $forum);

        $uri = config('derpibooru_api.website_url') . Str::replace(':short_name', 'dis', config('derpibooru_api.path.fetch_forum_by_short_name'));
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('forum.name'), $forum->name);
    }

    public function test_can_fetch_topics()
    {
        $requester = new Requester();
        $collection = $requester->getTopics('dis');
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $topic) {
            $this->assertInstanceOf(Topic::class, $topic);
        }

        $uri = config('derpibooru_api.website_url') . Str::replace(':short_name', 'dis', config('derpibooru_api.path.fetch_topics_by_forum_short_name'));
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('topics.0.title'), $collection->first()->title);
    }

    public function test_can_fetch_topic()
    {
        $requester = new Requester();
        $topic = $requester->getTopic('dis', 'ask-the-mods-anything');
        $this->assertInstanceOf(Topic::class, $topic);

        $path = config('derpibooru_api.path.fetch_topic_by_slug');
        foreach ([
            ':short_name' => 'dis',
            ':topic_slug' => 'ask-the-mods-anything'
        ] as $key => $value) {
            $path = Str::replace($key, $value, $path);
        }
        $uri = config('derpibooru_api.website_url') . $path;
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('topic.name'), $topic->name);
    }

    public function test_can_fetch_posts_from_topic()
    {
        $requester = new Requester();
        $collection = $requester->getPostsFromTopic('dis', 'ask-the-mods-anything');
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $post) {
            $this->assertInstanceOf(Post::class, $post);
        }

        $path = config('derpibooru_api.path.fetch_post_list_from_topic');
        foreach ([
            ':short_name' => 'dis',
            ':topic_slug' => 'ask-the-mods-anything'
        ] as $key => $value) {
            $path = Str::replace($key, $value, $path);
        }
        $uri = config('derpibooru_api.website_url') . $path;
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('posts.0.author'), $collection->first()->author);
    }

    public function test_can_fetch_post_from_topic()
    {
        $requester = new Requester();
        $topic = $requester->getPostFromTopic('dis', 'ask-the-mods-anything', 2761095);
        $this->assertInstanceOf(Post::class, $topic);

        $path = config('derpibooru_api.path.fetch_post_from_topic');
        foreach ([
            ':short_name' => 'dis',
            ':topic_slug' => 'ask-the-mods-anything',
            ':post_id' => 2761095
        ] as $key => $value) {
            $path = Str::replace($key, $value, $path);
        }
        $uri = config('derpibooru_api.website_url') . $path;
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('post.author'), $topic->author);
    }
}
