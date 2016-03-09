<?php


namespace Collectify\Tests\Unit;


use Collectify\Services\Dynamizer;

class DynamizerTest extends \PHPUnit_Framework_TestCase
{
    public function testIfDynamizerCanDynamize(){
        $view = '{{ var }}';
        $parameters = array('var' => 'category');
        $result = 'category';

        $dynamizer = new Dynamizer();
        $dynamizer->setView($view);
        $dynamizer->setParameters($parameters);
        $dynamizeView = $dynamizer->dynamize();

        $this->assertEquals($result, $dynamizeView);
    }

}