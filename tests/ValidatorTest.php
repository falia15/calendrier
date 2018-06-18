<?php

use PHPUnit\Framework\TestCase;

class EventValidatorTest extends TestCase {

    public function testMinLenght() :void {
        $validator = new Calendar\EventValidator();
        $this->assertTrue($validator->minLenght('fffff'));

    }

    public function testMaxLenght() :void {
        $validator = new Calendar\EventValidator();
        $this->assertTrue($validator->maxLenght('fffff'));
        
    }







}