<?php
/**
 * Created by PhpStorm.
 * User: ANGGELA
 * Date: 14/04/2017
 * Time: 11:41
 */

use Illuminate\Foundation\Testing\DatabaseTransactions;

class FeatureTestCase extends TestCase
{
    use DatabaseTransactions;

    public function seeErrors(array $fiels)
    {
        foreach ($fiels as $name => $errors){
            foreach ((array) $errors as $message){
                $this->seeInElement(
                    "#field_{$name}.has-error .help-block",$message
                );
            }
        }

    }
}