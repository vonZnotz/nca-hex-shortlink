<?php

declare(strict_types=1);

use Nca\Shortlink\Entity\Shortlink;
use PHPUnit\Framework\TestCase;

class ShortlinkTest extends TestCase
{
    public function testContainsValuesGivenInConstructor()
    {
        $testSource = 'test-source';
        $testDestination = 'test-destination';

        $entity = new Shortlink($testSource, $testDestination);
        $this->assertEquals($testSource, $entity->getSource());
        $this->assertEquals($testDestination, $entity->getDestination());
    }

    public function testFailsOnInvalidNumberOfConstructorArguments()
    {
        $this->expectException(\ArgumentCountError::class);
        new Shortlink();
    }

    public function testFailsOnInvalidSourceType()
    {
        $this->expectException(\TypeError::class);
        new Shortlink(null, 'test-destination');
    }

    public function testFailsOnInvalidDestinationType()
    {
        $this->expectException(\TypeError::class);
        new Shortlink('test-source', null);
    }
}
