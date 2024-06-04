<?php



it('can extract an article', function () {

    $response = $this->post('/extract', [
        'link' => 'https://www.bbc.com/news/world-europe-57786400',
    ]);

    dd($response->json());

    $response->assertStatus(200);

    $response->assertJsonStructure([
        'title' => 'string',
        'description' => 'string',
        'url' => 'string',
        'image' => 'string',
        'date' => 'string',
        'author' => 'string',
        'content' => 'string',
    ]);
});
