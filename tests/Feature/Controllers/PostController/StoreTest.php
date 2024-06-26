<?php

use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->validData = fn () => [
        'title' => 'Hello World',
        'topic_id' => Topic::factory()->create()->getKey(),
        'body' => 'Nostrud esse ex anim ea aute id qui nulla in ea occaecat. Sit nostrud dolore duis reprehenderit commodo cupidatat id id. Ad laboris et exercitation elit officia sit velit aliqua ex qui ad fugiat duis culpa cillum. Laboris mollit occaecat nulla tempor anim magna in veniam sunt excepteur exercitation eu anim. Excepteur enim laboris exercitation ad velit culpa tempor cillum in. Cillum nisi tempor mollit minim exercitation occaecat pariatur dolore aute laboris veniam ea magna veniam. Est in in commodo excepteur nulla laboris sunt deserunt nulla qui tempor exercitation sit voluptate commodo. Lorem veniam laborum ut cupidatat commodo aute voluptate excepteur cillum velit dolore fugiat.',
    ];
});

it('requires authentication', function () {
    post(route('posts.store'))->assertRedirect(route('login'));
});

it('stores a post', function () {
    $user = User::factory()->create();

    $data = value ($this->validData);

    actingAs($user)->post(route('posts.store'), $data);

    $this->assertDatabaseHas(Post::class, [
        ...$data,
        'user_id' => $user->id,
    ]);
});

it('redirects to the post show page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('posts.store'), value($this->validData))
        ->assertRedirect(Post::latest('id')->first()->showRoute());
});

it('requires valid data', function ($badData, array|string $errors) {
    actingAs(User::factory()->create())
        ->post(route('posts.store'), [...value($this->validData), ...$badData])
        ->assertInvalid($errors);
})->with([
    [['title' => null], 'title'],
    [['title' => true], 'title'],
    [['title' => 1], 'title'],
    [['title' => 1.5], 'title'],
    [['title' => str_repeat('a', 121)], 'title'],
    [['title' => str_repeat('a', 9)], 'title'],
    [['topic_id' => null], 'topic_id'],
    [['topic_id' => -1], 'topic_id'],
    [['body' => null], 'body'],
    [['body' => true], 'body'],
    [['body' => 1], 'body'],
    [['body' => 1.5], 'body'],
    [['body' => str_repeat('a', 10_001)], 'body'],
    [['body' => str_repeat('a', 99)], 'body'],
]);
