<?php

namespace Tests\DerpibooruApiFacade;

use Nolikein\ApiDerpibooruFacade\Models\Comment;
use Nolikein\ApiDerpibooruFacade\Models\Filter;
use Nolikein\ApiDerpibooruFacade\Models\Image;
use Nolikein\ApiDerpibooruFacade\Models\Post;
use Nolikein\ApiDerpibooruFacade\Models\Tag;
use Nolikein\ApiDerpibooruFacade\Models\User;
use Nolikein\ApiDerpibooruFacade\Requester;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class RequestsByIdTest extends TestCase
{
    public function test_can_fetch_comment()
    {
        $requester = new Requester();
        $comment = $requester->getCommentById(1000);
        $this->assertInstanceOf(Comment::class, $comment);

        $uri = config('derpibooru_api.website_url') . Str::replace(':comment_id', 1000, config('derpibooru_api.path.fetch_comment'));
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('comment.author'), $comment->author);
    }

    public function test_cannot_fetch_undefined_comment()
    {
        $requester = new Requester();
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage("the element -1 does not exists");
        $requester->getCommentById(-1);
    }

    public function test_can_fetch_image()
    {
        $requester = new Requester();
        $image = $requester->getImageById(1000);
        $this->assertInstanceOf(Image::class, $image);

        $uri = config('derpibooru_api.website_url') . Str::replace(':image_id', 1000, config('derpibooru_api.path.fetch_image'));
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('image.name'), $image->name);
    }

    public function test_cannot_fetch_undefined_image()
    {
        $requester = new Requester();
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage("the element -1 does not exists");
        $requester->getImageById(-1);
    }

    public function test_can_fetch_tag()
    {
        $requester = new Requester();
        $tag = $requester->getTagById(1000);
        $this->assertInstanceOf(Tag::class, $tag);

        $uri = config('derpibooru_api.website_url') . Str::replace(':tag_id', 1000, config('derpibooru_api.path.fetch_tag'));
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('tag.name'), $tag->name);
    }

    public function test_cannot_fetch_undefined_tag()
    {
        $requester = new Requester();
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage("the element -1 does not exists");
        $requester->getTagById(-1);
    }

    public function test_can_fetch_post()
    {
        $requester = new Requester();
        $post = $requester->getPostById(2730144);
        $this->assertInstanceOf(Post::class, $post);

        $uri = config('derpibooru_api.website_url') . Str::replace(':post_id', 2730144, config('derpibooru_api.path.fetch_post'));
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('post.avatar'), $post->avatar);
    }

    public function test_cannot_fetch_undefined_post()
    {
        $requester = new Requester();
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage("the element -1 does not exists");
        $requester->getPostById(-1);
    }

    public function test_can_fetch_user()
    {
        $requester = new Requester();
        $user = $requester->getUserById(216494);
        $this->assertInstanceOf(User::class, $user);

        $uri = config('derpibooru_api.website_url') . Str::replace(':user_id', 216494, config('derpibooru_api.path.fetch_user'));
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('user.name'), $user->name);
    }

    public function test_cannot_fetch_undefined_user()
    {
        $requester = new Requester();
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage("the element -1 does not exists");
        $requester->getPostById(-1);
    }

    public function test_can_fetch_filter()
    {
        $requester = new Requester();
        $filter = $requester->getFilterById(56027);
        $this->assertInstanceOf(Filter::class, $filter);

        $uri = config('derpibooru_api.website_url') . Str::replace(':filter_id', 56027, config('derpibooru_api.path.fetch_filter'));
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('filter.name'), $filter->name);
    }

    public function test_cannot_fetch_undefined_filter()
    {
        $requester = new Requester();
        $this->expectException(NotFoundHttpException::class);
        $this->expectExceptionMessage("the element -1 does not exists");
        $requester->getFilterById(-1);
    }
}
