<?php

declare(strict_types=1);

use Nca\Shortlink\Resolver\CallbackResolver;
use Nca\Shortlink\Resolver\ResolverCollection;
use PHPUnit\Framework\TestCase;

class ResolverCollectionTest extends TestCase
{
    public function testResolvesToNothingWithoutResolvers()
    {
        $collection = new ResolverCollection();
        $result = $collection->resolve('test-source');

        $this->assertNull($result);
    }

    public function testResolvesForInitiallyAddedResolvers()
    {
        $collection = new ResolverCollection(
            new CallbackResolver(function(string $source): ?string {
                if ($source === 'test-source') {
                    return 'test-destination';
                }

                return null;
            }),
            new CallbackResolver(function(string $source): ?string {
                if ($source === 'test-source2') {
                    return 'test-destination2';
                }

                return null;
            })
        );

        $result = $collection->resolve('test-source');
        $result2 = $collection->resolve('test-source2');

        $this->assertEquals('test-destination', $result);
        $this->assertEquals('test-destination2', $result2);
    }

    public function testResolvesForSubsequentlyAddedResolvers()
    {
        $collection = new ResolverCollection();
        $collection->add(new CallbackResolver(function(string $source): ?string {
            if ($source === 'test-source') {
                return 'test-destination';
            }

            return null;
        }));
        $collection->add(new CallbackResolver(function(string $source): ?string {
            if ($source === 'test-source2') {
                return 'test-destination2';
            }

            return null;
        }));

        $result = $collection->resolve('test-source');
        $result2 = $collection->resolve('test-source2');

        $this->assertEquals('test-destination', $result);
        $this->assertEquals('test-destination2', $result2);
    }

    public function testCallsAllResolversOnUnknownSource()
    {
        $nullResolver = $this->prophesize(CallbackResolver::class);
        $nullResolver->resolve('test-source')
            ->shouldBeCalledTimes(3)
            ->willReturn(null);

        $collection = new ResolverCollection($nullResolver->reveal(), $nullResolver->reveal(), $nullResolver->reveal());
        $collection->resolve('test-source');
    }

    public function testDoesNotCallAllResolversOnKnownSource()
    {
        $nullResolver = $this->prophesize(CallbackResolver::class);
        $nullResolver->resolve('test-source')
            ->shouldBeCalledTimes(1)
            ->willReturn(null);
        $valueResolver = $this->prophesize(CallbackResolver::class);
        $valueResolver->resolve('test-source')
            ->shouldBeCalledTimes(1)
            ->willReturn('test-destination');

        $collection = new ResolverCollection($nullResolver->reveal(), $valueResolver->reveal(), $nullResolver->reveal());
        $collection->resolve('test-source');
    }

    public function testFailsOnInvalidConstructorArguments()
    {
        $this->expectException(\TypeError::class);

        new ResolverCollection(new CallbackResolver(function() {}), null);
    }

    public function testFailsToAddInvalidResolver()
    {
        $this->expectException(\TypeError::class);

        $collection = new ResolverCollection();
        $collection->add(null);
    }
}
