<?php

class SupportMarkdownTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_post_content_support_markdown()
    {
        $importText = 'Un texto muy importante';

        $post=$this->createPost([
           'content' => "La primera parte del texto. **$importText**. La última parte del texto"
        ]);

        $this->visit($post->url)
             ->seeInElement('strong', $importText);
    }

    function test_the_code_in_the_post_is_escaped()
    {
        $xssAttack ="<script>alert('Malicious JS!')</script>";

        $post=$this->createPost([
            'content' => "`$xssAttack`. Texto normal"
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack)
            ->seeText('Texto normal')
            ->seeText($xssAttack);
    }

    function test_xss_attack()
    {
        $xssAttack ="<script>alert('Malicious JS!')</script>";

        $post=$this->createPost([
            'content' => "$xssAttack. Texto normal"
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack)
            ->seeText('Texto normal')
            ->seeText($xssAttack);
    }

    function test_xss_attack_with_html()
    {
        $xssAttack ="<img src='img.jpg'>";

        $post=$this->createPost([
            'content' => "$xssAttack. Texto normal"
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack);
    }

}
