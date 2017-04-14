<?php
/**
 * Created by PhpStorm.
 * User: ANGGELA
 * Date: 14/04/2017
 * Time: 11:56
 */

class CreatePostsTest extends  FeatureTestCase
{
    public function test_a_user_create_a_post()
    {
        //con los datos que tenemos
        $title = 'Esta es una pregunta';
        $content='Este es un contenido';
        //usuario conectado
        $this->actingAs($user = $this->defaultUser());
        //usuario visita la ruta para crear un postt
        $this->visit(route('posts.create'))
             ->type($title,'title')
             ->type($content,'content')
             ->press('Publicar');

        //Deberíamos tener cambios en la base de datos
        $this->seeInDatabase('posts',[
           'title' => $title,
            'content' => $content,
            'pending' => true,
            'user_id' => $user->id,
        ]);
        //El usuario es redirigidos al detalle del posts
        $this->see($title);
    }

    public function test_creating_a_posts_authentication()
    {
        $this->visit(route('posts.create'))
             ->seePageIs(route('login'));
    }
}