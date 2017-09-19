<?php

namespace Nca\Shortlink\Resolver;

class ArrayResolver implements ResolverInterface
{
    /**
     * @var array
     */
    protected $array;

    /**
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * @inheritDoc
     */
    public function resolve(string $source): ?string
    {
        if (isset($this->array[$source]) && is_string($this->array[$source])) {
            return $this->array[$source];
        }

        return null;
    }
}
