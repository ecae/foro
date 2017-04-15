<?php

class ShowPostTest extends FeatureTestCase
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
        $this->visit($post->url)
             ->seeInElement('h1',$post->title)
             ->see($post->content)
             ->see($user->name);
    }

    function tests_old_urls_are_redirected()
    {
        $user = $this->defaultUser();
        $post = factory(\App\Post::class)->make([
            'title' => 'Old Test ',
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New title']) ;

        $this->visit($url)
            ->seePageIs($post->url);
    }

/*
    function test_post_url_with_wrong_slugs_still_work()
    {
        $user = $this->defaultUser();
        $post = factory(\App\Post::class)->make([
            'title' => 'Old Test ',
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New title']) ;

        $this->visit($url)
             ->assertResponseStatus(200)
             ->see('New title');

    }
*/
}
