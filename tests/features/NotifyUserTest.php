<?php

use App\Notifications\PostCommented;
use App\User;
use Illuminate\Support\Facades\Notification;

class NotifyUserTest extends FeatureTestCase
{
    public function test_the_subscribers_receive_a_notification_when_post_is_commented()
    {
        Notification::fake();

        $post = $this->createPost();

        $subscriber = factory(User::class)->create();

        $subscriber->subscribeTo($post);

        $writer = factory(User::class)->create();

        $writer->subscribeTo($post);

        $comment= $writer->comment($post, 'Un comentario cualquiera');

        Notification::assertSentTo($subscriber, PostCommented::class, function ($notification) use ($comment){
            return $notification->comment->id == $comment->id;
        });

        //al autor del commentario no se le envian notifiaciones
        Notification::assertNotSentTo($writer, PostCommented::class, function ($notification) use ($comment){
            return $notification->comment->id == $comment->id;
        });
    }
}
