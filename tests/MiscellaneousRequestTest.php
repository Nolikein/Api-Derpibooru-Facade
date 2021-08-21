<?php

namespace Tests\DerpibooruApiFacade;

use Nolikein\ApiDerpibooruFacade\Models\Filter;
use Nolikein\ApiDerpibooruFacade\Models\Image;
use Nolikein\ApiDerpibooruFacade\Models\Oembed;
use Nolikein\ApiDerpibooruFacade\Requester;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Tests\TestCase;

class MiscellaneousRequestTest extends TestCase
{
    public function test_can_fetch_featured_image()
    {
        $requester = new Requester();
        $image = $requester->getFeaturedImage();
        $this->assertInstanceOf(Image::class, $image);

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.fetch_featured_image');
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('image.source_url'), $image->source_url);
    }

    public function test_can_fetch_filter_list()
    {
        $requester = new Requester();
        $collection = $requester->getFilterList();
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $filter) {
            $this->assertInstanceOf(Filter::class, $filter);
        }

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.fetch_filter_list');
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('filters.0.name'), $collection->first()->name);
    }

    public function test_cannot_fetch_user_filter_list_without_key()
    {
        $requester = new Requester();

        $this->expectException(AccessDeniedHttpException::class);
        $this->expectExceptionMessage("The user auth token / key is missing or invalid");
        $requester->getUserFilters('invalid_key');
    }

    public function test_can_fetch_oembed_by_url()
    {
        $requester = new Requester();
        $oembed = $requester->getOembedByUrl('https://derpicdn.net/img/2012/1/2/3/full.png');
        $this->assertInstanceOf(Oembed::class, $oembed);

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.fetch_oembed_by_url') . '?' . Arr::query([
            Requester::ARG_URL => 'https://derpicdn.net/img/2012/1/2/3/full.png'
        ]);
        $response = Http::get($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('author_name'), $oembed->author_name);
    }

    public function test_can_do_reverse_image_search()
    {
        $requester = new Requester();
        $collection = $requester->doReverseImageSearchByUrl('https://derpicdn.net/img/2019/12/24/2228439/full.jpg');
        $this->assertInstanceOf(Collection::class, $collection);
        foreach ($collection as $image) {
            $this->assertInstanceOf(Image::class, $image);
        }

        $uri = config('derpibooru_api.website_url') . config('derpibooru_api.path.do_reverse_image_search_by_url') . '?' . Arr::query([
            Requester::ARG_URL => 'https://derpicdn.net/img/2019/12/24/2228439/full.jpg'
        ]);
        $response = Http::post($uri);
        $this->assertEquals(200, $response->status());
        $this->assertEquals($response->json('images.0.source_url'), $collection->first()->source_url);
    }
}
