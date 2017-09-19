<?php

declare(strict_types=1);

use Nca\Shortlink\Resolver\ArrayResolver;
use PHPUnit\Framework\TestCase;

class ArrayResolverTest extends TestCase
{
    public function testResolvesDestinationForKnownSource()
    {
        $resolver = new ArrayResolver([
            'test-source' => 'test-destination',
        ]);
        $result = $resolver->resolve('test-source');

        $this->assertEquals('test-destination', $result);
    }

    public function testResolvesToNullForUnknownSource()
    {
        $resolver = new ArrayResolver([
            'test-source' => 'test-destination',
        ]);
        $result = $resolver->resolve('test-source2');

        $this->assertNull($result);
    }

    public function testFailsOnInvalidNumberOfConstructorArguments()
    {
        $this->expectException(\ArgumentCountError::class);
        new ArrayResolver();
    }

    public function testFailsOnInvalidArrayType()
    {
        $this->expectException(\TypeError::class);
        new ArrayResolver(null);
    }
}
