<?php


class ExampleTest extends FeatureTestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    function test_basic_example()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Erick Cruz',
            'email' => 'erick@admin.com',
        ]);

        $this->actingAs($user,'api')
             ->visit('api/user')
             ->see('Erick Cruz')
            ->see('erick@admin.com');

    }
}
