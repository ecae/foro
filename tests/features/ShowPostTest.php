<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends TestCase
{
    function test_a_user_can_see_a_the_post_detail()
    {
        $user = $this->defaultUser([
            'name' => 'Erick Cruz'
        ]);
        $post = factory(\App\Post::class)->make([
            'title' => 'Este es el título del post',
            'content' => 'Este es el contenido del post'
        ]);

        $user->posts()->save($post);

        //when
        $this->visit(route('posts.show',$post))
             ->seeInElement('h1',$post->title)
             ->see($post->content)
             ->see($user->name);
    }
}
