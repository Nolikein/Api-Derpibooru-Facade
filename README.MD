# Api Derpibooru Facade (Laravel)

A librairy made for [Laravel](https://laravel.com) to communicate and modelize under models the [derpibooru's api](https://derpibooru.org/pages/api). Laravel is a php framework.

## How to install it

You should like to install it from composer, enter the bellow command line :

```bash
composer require nolikein/api-derpibooru-facade ^1.0.0
```

## Usage

First, create the class who allows you to do requests. The requester:

```php
use Nolikein\ApiDerpibooruFacade\Requester;

$requester = new Requester();
```

Then, an example of request:
```php
use Nolikein\ApiDerpibooruFacade\Models\Image;

/** @var Image $image A model who represent an image */
$image = $requester->getImageById(1);
dd($image->name);
```

But the class has many methods:
```php
# Basic requests by id
$requester->getCommentById(idComment: $id);
$requester->getImageById(idImage: $id);
$requester->getTagById(tagId: $id);
$requester->getPostById(postId: $id);
$requester->getUserById(userId: $id);
$requester->getFilterById(filterId: $filter_id, authToken: $key = null);

# Basic requests by query
$requester->getCommentsByQuery(query: $q, authToken: $key = null, page: $page = null);
$requester->getGalleriesByQuery(query: $q, authToken: $key = null, page: $page = null);
$requester->getPostsByQuery(query: $q, authToken: $key = null, page: $page = null);
$requester->getImagesByQuery(query: $q, authToken: $key = null, page: $page = null, perPage: $per_page = null, filterId: $filter_id = null, sortDirection: $sd = null, sortField: $sf = null);
$requester->getTagsByQuery(query: $q, page: $page = null);

# Forum requests
$requester->getForums();
$requester->getForum(forumShortName: $short_name);
$requester->getTopics(forumShortName: $short_name, page: $page = null, perPage: $per_page = null);
$requester->getTopic(forumShortName: $short_name, topicSlug: $slug);
$requester->getPostsFromTopic(forumShortName: $short_name, topicSlug: $slug, page: $page = null, perPage: $per_page = null);
$requester->getPostFromTopic(forumShortName: $short_name, topicSlug: $topic_slug, topicId: $post_id);

# Miscellaneous requests
$requester->getFeaturedImage();
$requester->getFilterList(page: $page = null);
$requester->getUserFilters(authToken: $key, page: $page = null);
$requester->getOembedByUrl(url: $url);
$requester->doReverseImageSearchByUrl(url: $url, authToken: $key = null, distance: $distance = null);
```

## Publish config file and tests
Run the following commands depending of your needs:
```bash
artisan vendor:publish --tag=api-derpibooru-facade-config
artisan vendor:publish --tag=api-derpibooru-facade-tests
```

## Licence

This librairy is under [MIT licence](https://opensource.org/licenses/MIT).