<?php


use App\Post;

class PostModelTest extends TestCase
{

    function test_add_a_title_generates_a_slug()
    {
        $post = new Post([
           'title' => 'como instalar Laravel'
        ]);

        $this->assertSame('como-instalar-laravel',$post->slug);
    }

    function test_editing_a_title_generates_a_slug()
    {
        $post = new Post([
            'title' => 'como instalar Laravel'
        ]);

        $post->title = 'como instalar Laravel 5.1 LTS';
        $this->assertSame('como-instalar-laravel-51-lts',$post->slug);
    }
}
