<?php

declare(strict_types=1);

use Nca\Shortlink\Entity\Shortlink;
use Nca\Shortlink\Resolver\ShortlinkResolver;
use PHPUnit\Framework\TestCase;

class ShortlinkResolverTest extends TestCase
{
    public function testResolvesDestinationForKnownSource()
    {
        $shortlink = new Shortlink('test-source', 'test-destination');
        $resolver = new ShortlinkResolver($shortlink);
        $result = $resolver->resolve('test-source');

        $this->assertEquals('test-destination', $result);
    }

    public function testResolvesToNullForUnknownSource()
    {
        $shortlink = new Shortlink('test-source', 'test-destination');
        $resolver = new ShortlinkResolver($shortlink);
        $result = $resolver->resolve('test-source2');

        $this->assertNull($result);
    }

    public function testFailsOnInvalidNumberOfConstructorArguments()
    {
        $this->expectException(\ArgumentCountError::class);
        new ShortlinkResolver();
    }

    public function testFailsOnInvalidShortlinkType()
    {
        $this->expectException(\TypeError::class);
        new ShortlinkResolver(null);
    }
}
