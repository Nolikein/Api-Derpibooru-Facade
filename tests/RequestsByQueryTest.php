<?php

namespace Tests\DerpibooruApiFacade;

use Nolikein\ApiDerpibooruFacade\Models\Comment;
use Nolikein\ApiDerpibooruFacade\Models\Image;
use Nolikein\ApiDerpibooruFacade\Models\Post;
use Nolikein\ApiDerpibooruFacade\Models\Tag;
use Nolikein\ApiDerpibooruFacade\Requester;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Tests\TestCase;

class RequestsByQueryTest extends TestCase
{
    public function test_can_fetch_comment()
    {
        $requester = new Requester();
        $collection = $requester->getCommentsByQuery('image_id:1000000');
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $comment) {
            $this->assertInstanceOf(Comment::class, $comment);
        }

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.fetch_comments_by_query') . '?' . Arr::query([
            Requester::ARG_QUERY => 'image_id:1000000'
        ]);
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('comments.0.author'), $collection->first()->author);
    }

    public function test_can_fetch_galleries()
    {
        $requester = new Requester();
        $collection = $requester->getGalleriesByQuery('title:mean*');
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $comment) {
            $this->assertInstanceOf(Comment::class, $comment);
        }

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.fetch_galleries_by_query') . '?' . Arr::query([
            Requester::ARG_QUERY => 'title:mean*'
        ]);
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEmpty($response->json('galleries'));
        $this->assertEmpty($collection);
    }

    public function test_can_fetch_posts()
    {
        $requester = new Requester();
        $collection = $requester->getPostsByQuery('subject:time wasting thread');
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $post) {
            $this->assertInstanceOf(Post::class, $post);
        }

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.fetch_posts_by_query') . '?' . Arr::query([
            Requester::ARG_QUERY => 'subject:time wasting thread'
        ]);
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('posts.0.author'), $collection->first()->author);
    }

    public function test_can_fetch_images()
    {
        $requester = new Requester();
        $collection = $requester->getImagesByQuery('safe');
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $post) {
            $this->assertInstanceOf(Image::class, $post);
        }

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.fetch_images_by_query') . '?' . Arr::query([
            Requester::ARG_QUERY => 'safe'
        ]);
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('images.0.author'), $collection->first()->author);
    }

    public function test_can_fetch_images_all_fields()
    {
        $requester = new Requester();
        $collection = $requester->getImagesByQuery('safe', page: 1, perPage: 25, filterId: 1);
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $post) {
            $this->assertInstanceOf(Image::class, $post);
        }

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.fetch_images_by_query') . '?' . Arr::query([
            Requester::ARG_QUERY => 'safe'
        ]);
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('images.0.author'), $collection->first()->author);
    }

    public function test_can_fetch_tags()
    {
        $requester = new Requester();
        $collection = $requester->getTagsByQuery('analyzed_name:wing');
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $post) {
            $this->assertInstanceOf(Tag::class, $post);
        }

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.fetch_tags_by_query') . '?' . Arr::query([
            Requester::ARG_QUERY => 'analyzed_name:wing'
        ]);
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('tags.0.name'), $collection->first()->name);
    }
}
