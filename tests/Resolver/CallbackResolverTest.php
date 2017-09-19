<?php

declare(strict_types=1);

use Nca\Shortlink\Resolver\CallbackResolver;
use PHPUnit\Framework\TestCase;

class CallbackResolverTest extends TestCase
{
    public function testResolvesDestinationForKnownSource()
    {
        $resolveCallback = \Closure::fromCallable(array($this, 'resolveTestSourceToTestDestination'));
        $resolver = new CallbackResolver($resolveCallback);
        $result = $resolver->resolve('test-source');

        $this->assertEquals('test-destination', $result);
    }

    public function testResolvesToNullForUnknownSource()
    {
        $resolveCallback = \Closure::fromCallable(array($this, 'resolveTestSourceToTestDestination'));
        $resolver = new CallbackResolver($resolveCallback);
        $result = $resolver->resolve('test-source2');

        $this->assertNull($result);
    }

    public function testResolvesToNullOnException()
    {
        $resolver = new CallbackResolver(function() {
            throw new \RuntimeException();
        });
        $result = $resolver->resolve('test-destination');

        $this->assertNull($result);
    }

    public function testFailsOnInvalidNumberOfConstructorArguments()
    {
        $this->expectException(\ArgumentCountError::class);
        new CallbackResolver();
    }

    public function testFailsOnInvalidCallbackType()
    {
        $this->expectException(\TypeError::class);
        new CallbackResolver(null);
    }

    protected function resolveTestSourceToTestDestination(string $source): ?string
    {
        if ($source === 'test-source') {
            return 'test-destination';
        }

        return null;
    }
}
