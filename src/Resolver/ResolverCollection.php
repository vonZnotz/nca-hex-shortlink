<?php

declare(strict_types=1);

namespace Nca\Shortlink\Resolver;

class ResolverCollection implements ResolverInterface
{
    /**
     * @var ResolverInterface[]
     */
    protected $resolvers;

    /**
     * @param ResolverInterface[] ...$resolvers
     */
    public function __construct(ResolverInterface ...$resolvers)
    {
        $this->resolvers = $resolvers;
    }

    /**
     * @param ResolverInterface $resolver
     */
    public function add(ResolverInterface $resolver): void
    {
        $this->resolvers[] = $resolver;
    }

    /**
     * @inheritDoc
     */
    public function resolve(string $source): ?string
    {
        foreach ($this->resolvers as $resolver) {
            $destination = $resolver->resolve($source);

            if ($destination !== null) {
                return $destination;
            }
        }

        return null;
    }
}
