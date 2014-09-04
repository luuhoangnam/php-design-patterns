<?php


use Nam\Monostate\Monostate;

class MonostateTest extends PHPUnit_Framework_TestCase
{

    public function testMonostate()
    {
        $firstObject  = new Monostate;
        $secondObject = new Monostate;

        $firstObject->setValue(10);
        $this->assertEquals(10, $firstObject->getValue());
        $this->assertEquals(10, $secondObject->getValue());
    }
}
 